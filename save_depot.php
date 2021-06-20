<?php
    session_start();
    if (!isset($_SESSION['timeout']) || $_SESSION['timeout'] < time()) {
        header('Location: login.php');
    }
    include 'includes/db.php';

    $checkOutPetitions = isset($_POST["checkOutPetitions"])?1:0;
    $submitCompletedPetitions = isset($_POST["submitCompletedPetitions"])?1:0;
    $notaryAvailable = isset($_POST["notaryAvailable"])?1:0;

    if (empty($_POST["id"])) {
        $stmt = $connection->prepare("insert into Depot (
            Name,
            Street1,
            Street2,
            City,
            State,
            Zip,
            County,
            Phone,
            Email,
            Hours,
            NotaryHours,
            ContactId,
            CheckOutPetitions,
            SubmitCompletedPetitions,
            NotaryAvailable,
            Notes,
            InternalNotes,
            CreatedBy,
            ModifiedBy
        ) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssssssiiiissii", 
            $_POST["name"],
            $_POST["street1"],
            $_POST["street2"],
            $_POST["city"],
            $_POST["state"],
            $_POST["zip"],
            $_POST["county"],
            $_POST["phone"],
            $_POST["email"],
            $_POST["hours"],
            $_POST["notaryHours"],
            $_POST["contactId"],
            $checkOutPetitions,
            $submitCompletedPetitions,
            $notaryAvailable,
            $_POST["notes"],
            $_POST["internalNotes"],
            $_SESSION["userid"],
            $_SESSION["userid"]
        );
    } else {
        $stmt = $connection->prepare("select id from Depot where id = ?");
        $stmt->bind_param("i", $_POST["id"]);
        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
        $stmt->close();
        if ($result == $_POST["id"]) {
            if (isset($_POST["delete"])) {
                $stmt = $connection->prepare("delete from Depot where id = ?");
                $stmt->bind_param("i", $_POST["id"]);
            } else {
                $stmt = $connection->prepare("update Depot set
                    Name = ?,
                    Street1 = ?,
                    Street2 = ?,
                    City = ?,
                    State = ?,
                    Zip = ?,
                    County = ?,
                    Phone = ?,
                    Email = ?,
                    Hours = ?,
                    NotaryHours = ?,
                    ContactId = ?,
                    CheckOutPetitions = ?,
                    SubmitCompletedPetitions = ?,
                    NotaryAvailable = ?,
                    Notes = ?,
                    InternalNotes = ?,
                    ModifiedBy = ?,
                    ModifiedOn = CURRENT_TIMESTAMP where id = ?");
                $stmt->bind_param("sssssssssssiiiissii", 
                    $_POST["name"],
                    $_POST["street1"],
                    $_POST["street2"],
                    $_POST["city"],
                    $_POST["state"],
                    $_POST["zip"],
                    $_POST["county"],
                    $_POST["phone"],
                    $_POST["email"],
                    $_POST["hours"],
                    $_POST["notaryHours"],
                    $_POST["contactId"],
                    $checkOutPetitions,
                    $submitCompletedPetitions,
                    $notaryAvailable,
                    $_POST["notes"],
                    $_POST["internalNotes"],
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
