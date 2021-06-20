<?php
    session_start();
    if (!isset($_SESSION['timeout']) || $_SESSION['timeout'] < time()) {
        header('Location: login.php');
    }
    include 'includes/db.php';

    $canText = isset($_POST["canText"])?1:0;
    $PC = isset($_POST["PC"])?1:0;
    $isCoordinator = isset($_POST["isCoordinator"])?1:0;
    $isAmbassador = isset($_POST["isAmbassador"])?1:0;
    $isPetitioner = isset($_POST["isPetitioner"])?1:0;
    $isDepotContact = isset($_POST["isDepotContact"])?1:0;
    $isNotary = isset($_POST["isNotary"])?1:0;
    $isPersonOfInterest = isset($_POST["isPersonOfInterest"])?1:0;
    $false = 0;

    if (empty($_POST["id"])) {
        $stmt = $connection->prepare("insert into Person (
            isPending,
            FirstName,
            LastName,
            Middle,
            Street1,
            Street2,
            City,
            State,
            Zip,
            County,
            Email,
            Phone,
            PhoneType,
            CanText,
            LegislativeDistrict,
            PC,
            CirculatorID,
            OrganizationID,
            HoursAvailable,
            isCoordinator,
            IsAmbassador,
            IsPetitioner,
            IsDepotcontact,
            DepotID,
            IsNotary,
            IsPersonOfInterest,
            Notes,
            CreatedBy,
            ModifiedBy
        ) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("issssssssssssisisisiiiiiiisii",
            $false,
            $_POST["firstName"],
            $_POST["lastName"],
            $_POST["initial"],
            $_POST["street1"],
            $_POST["street2"],
            $_POST["city"],
            $_POST["state"],
            $_POST["zip"],
            $_POST["county"],
            $_POST["email"],
            $_POST["phone"],
            $_POST["phonetype"],
            $canText,
            $_POST["legislativeDistrict"],
            $PC,
            $_POST["circulatorID"],
            $_POST["organizationID"],
            $_POST["hoursAvailable"],
            $isCoordinator,
            $isAmbassador,
            $isPetitioner,
            $isDepotContact,
            $_POST["depotID"],
            $isNotary,
            $isPersonOfInterest,
            $_POST["notes"],
            $_SESSION["userid"],
            $_SESSION["userid"]
        );
    } else {
        $stmt = $connection->prepare("select id from Person where id = ?");
        $stmt->bind_param("i", $_POST["id"]);
        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
        $stmt->close();
        if ($result == $_POST["id"]) {
            if (isset($_POST["delete"])) {
                $stmt = $connection->prepare("delete from Person where id = ?");
                $stmt->bind_param("i", $_POST["id"]);
            } else {
                $stmt = $connection->prepare("update Person set
                    isPending = 0,    
                    FirstName = ?,
                    LastName = ?,
                    Middle = ?,
                    Street1 = ?,
                    Street2 = ?,
                    City = ?,
                    State = ?,
                    Zip = ?,
                    County = ?,
                    Email = ?,
                    Phone = ?,
                    PhoneType = ?,
                    CanText = ?,
                    LegislativeDistrict = ?,
                    PC = ?,
                    CirculatorID = ?,
                    OrganizationID = ?,
                    HoursAvailable = ?,
                    isCoordinator = ?,
                    IsAmbassador = ?,
                    IsPetitioner = ?,
                    IsDepotcontact = ?,
                    DepotID = ?,
                    IsNotary = ?,
                    IsPersonOfInterest = ?,
                    Notes = ?,
                    ModifiedBy = ?,
                    ModifiedOn = CURRENT_TIMESTAMP where id = ?");
                $stmt->bind_param("ssssssssssssisisisiiiiiiisss", 
                    $_POST["firstName"],
                    $_POST["lastName"],
                    $_POST["initial"],
                    $_POST["street1"],
                    $_POST["street2"],
                    $_POST["city"],
                    $_POST["state"],
                    $_POST["zip"],
                    $_POST["county"],
                    $_POST["email"],
                    $_POST["phone"],
                    $_POST["phonetype"],
                    $canText,
                    $_POST["legislativeDistrict"],
                    $PC,
                    $_POST["circulatorID"],
                    $_POST["organizationID"],
                    $_POST["hoursAvailable"],
                    $isCoordinator,
                    $isAmbassador,
                    $isPetitioner,
                    $isDepotContact,
                    $_POST["depotID"],
                    $isNotary,
                    $isPersonOfInterest,
                    $_POST["notes"],
                    $_SESSION["userid"],
                    $_POST["id"]
                );
            }
        }
    }
    $result = $stmt->execute();
    if($result === FALSE) { 
        echo "ERROR: " . $stmt->error;
    }
    $stmt->close();
    $connection->close();

    if($result === TRUE) { 
        header('Location: '.$_SERVER["HTTP_REFERER"]);
        exit();
    }

?>