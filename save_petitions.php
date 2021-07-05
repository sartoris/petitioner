<?php
    session_start();
    if (!isset($_SESSION['timeout']) || $_SESSION['timeout'] < time()) {
        header('Location: login.php');
        exit();
    }
    include 'includes/db.php';

    function createBatch ($batch, $startingNumber, $endingNumber, $petitionName) {
        global $connection;
        for ($i = $startingNumber; $i <= $endingNumber; $i++) {
            $petitionid = $batch . sprintf("%04d", $i);
            $stmt = $connection->prepare("insert into Petition (
                Batch,
                PetitionNumber,
                PetitionName,
                CreatedBy,
                ModifiedBy
            ) values (?,?,?,?,?)");
            $stmt->bind_param("sssii", 
                $batch,
                $petitionid,
                $petitionName,
                $_SESSION["userid"],
                $_SESSION["userid"]
            );
            $result = $stmt->execute();
            if ($result === FALSE) {
                $_SESSION['errorMsg'] = $stmt->error;
                break;
            } else {
                $_SESSION['message'] = "Batch generated";
            }
        }
        $stmt->close();
        $connection->close();
        header('Location: '.$_SERVER["HTTP_REFERER"]);
        exit();
    }

    function checkoutPetitions($bulkList) {
        global $connection;
        if(isset($_POST["coordinatorid"])) {
            $checkOutToField = "CoordinatorID";
            $checkOutTo = $_POST["coordinatorid"];
        } else if(isset($_POST["depotid"])) {
            $checkOutToField = "DepotID";
            $checkOutTo = $_POST["depotid"];
        } else if(isset($_POST["ambassadorid"])) {
            $checkOutToField = "AmbassadorID";
            $checkOutTo = $_POST["ambassadorid"];
        } else if(isset($_POST["circulatorid"])) {
            $checkOutToField = "CirculatorID";
            $checkOutTo = $_POST["circulatorid"];
        }
        if($checkOutTo=="") {
            $_SESSION['errorMsg'] = "ERROR: No CheckOutTo is selected";
        } else {
            $stmt = $connection->prepare("update Petition set ".$checkOutToField." = ?,
            BulkCheckOutDate = CURRENT_TIMESTAMP,
            ModifiedOn = CURRENT_TIMESTAMP,
            BulkCheckOutBy = ?,
            ModifiedBy = ?
            where PetitionNumber = ?");
            if ($stmt === FALSE) {
                $_SESSION['errorMsg'] = $connection->error;
            } else {
                foreach ($bulkList as $petitionNumber) {
                    echo $petitionNumber;
                    $stmt->bind_param("iiis", 
                        $checkOutTo,
                        $_SESSION["userid"],
                        $_SESSION["userid"],
                        $petitionNumber
                    );
                    $result = $stmt->execute();
                    if($result === FALSE) { 
                        $_SESSION['errorMsg'] = $stmt->error;
                        break;
                    }
                }
                if(!isset($_SESSION['errorMsg'])) {
                    $_SESSION['message'] = "Petitions checked out";
                }
            }
        }
        $stmt->close();
        $connection->close();
        header('Location: '.$_SERVER["HTTP_REFERER"]);
        exit();
    }

    function refValues($arr){
        $refs = array();
        foreach($arr as $key => $value)
            $refs[$key] = &$arr[$key];
        return $refs;
    }

    function updatePetitions($petitionsList) {
        global $connection;
        $editCounty = isset($_POST["editCounty"])?1:0;
        $editDepotID = isset($_POST["editDepotID"])?1:0;
        $editCirculatorID = isset($_POST["editCirculatorID"])?1:0;
        $editSignatureCount = isset($_POST["editSignatureCount"])?1:0;
        $editValidSignatureCount = isset($_POST["editValidSignatureCount"])?1:0;
        $editCheckedIn = isset($_POST["editCheckedIn"])?1:0;
        $editNotarized = isset($_POST["editNotarized"])?1:0;
        $editValid = isset($_POST["editValid"])?1:0;
        $editComments = isset($_POST["editComments"])?1:0;
        $isCheckedIn = isset($_POST["isCheckedIn"])?1:0;
        $isNotarized = isset($_POST["isNotarized"])?1:0;
        $isValid = isset($_POST["isValid"])?1:0;
        $params = array();
        $params[0] = "";

        $query = "update Petition set ";
        if($editCounty) {
            $query = $query . "County = ?, ";
            $params[] = $_POST["county"];
            $params[0] = $params[0] . "s";
        }
        if($editDepotID) {
            $query = $query . "DepotID = ?, ";
            $params[] = $_POST["depotID"];
            $params[0] = $params[0] . "i";
        }
        if($editCirculatorID) {
            $query = $query . "CirculatorID = ?, ";
            $params[] = $_POST["circulatorID"];
            $params[0] = $params[0] . "i";
        }
        if($editSignatureCount) {
            $query = $query . "SignatureCount = ?, ";
            $params[] = $_POST["signatureCount"];
            $params[0] = $params[0] . "i";
        }
        if($editValidSignatureCount) {
            $query = $query . "ValidSignatureCount = ?, ";
            $params[] = $_POST["validSignatureCount"];
            $params[0] = $params[0] . "i";
        }
        if($editCheckedIn) {
            $query = $query . "isCheckedIn = ?, ";
            $params[] = $_POST["isCheckedIn"];
            $params[0] = $params[0] . "i";
        }
        if($editNotarized) {
            $query = $query . "isNotarized = ?, ";
            $params[] = $_POST["isNotarized"];
            $params[0] = $params[0] . "i";
        }
        if($editValid) {
            $query = $query . "isValid = ?, ";
            $params[] = $_POST["isValid"];
            $params[0] = $params[0] . "i";
        }
        if($editComments) {
            $query = $query . "Comments = ?, ";
            $params[] = $_POST["comments"];
            $params[0] = $params[0] . "s";
        }
        $query = $query . "ModifiedBy = ?, ";
        $params[] = $_SESSION["userid"];
        $params[0] = $params[0] . "is";
        $paramSize = strlen($params[0]);
        $query = $query . "ModifiedOn = CURRENT_TIMESTAMP where PetitionNumber = ?";
        $stmt = $connection->prepare($query);
        foreach ($petitionsList as $petitionNumber) {
            $params[$paramSize] = $petitionNumber;
            call_user_func_array(array($stmt, "bind_param"),refValues($params));
            $result = $stmt->execute();
            if($result === FALSE) { 
                echo "ERROR: " . $stmt->error;
                break;
            }
        }
        $stmt->close();
        $connection->close();
        if($result === TRUE) { 
            $index = strrpos($_SERVER['SCRIPT_URI'],'/') + 1;
            $url = substr($_SERVER['SCRIPT_URI'],0,$index) . $_POST["referrer"];
            header('Location: ' . $url . '?petitionNumbers=' . $_POST["petitionNumbers"]);
            exit();
        }
    }

    function updatePetition($petitionNumber) {
        global $connection;
        $isCheckedIn = isset($_POST["isCheckedIn"])?1:0;
        $isNotarized = isset($_POST["isNotarized"])?1:0;
        $isValid = isset($_POST["isValid"])?1:0;
        $stmt = $connection->prepare("update Petition set
            PetitionName = ?,
            County = ?,
            CirculatorID = ?,
            SignatureCount = ?,
            isCheckedIn = ?,
            Comments = ?,
            ModifiedBy = ?,
            ModifiedOn = CURRENT_TIMESTAMP where PetitionNumber = ?");
        $stmt->bind_param("ssiiisis", 
            $_POST["petitionName"],
            $_POST["county"],
            $_POST["circulatorID"],
            $_POST["signatureCount"],
            $isCheckedIn,
            $_POST["comments"],
            $_SESSION["userid"],
            $petitionNumber
        );
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
    }

    if (isset($_POST["batch"])) {
        createBatch($_POST["batch"], $_POST["startingNumber"], $_POST["endingNumber"], $_POST["petitionName"]);
    } else if (isset($_POST["bulkList"])) {
        $bulkList = explode(",",$_POST["bulkList"]);
        checkoutPetitions($bulkList);
    } else if(isset($_POST["petitionNumber"])) {
        updatePetition($_POST["petitionNumber"]);
    } else if(isset($_POST["petitionNumbers"])) {
        $petitionList = explode(",",$_POST["petitionList"]);
        updatePetitions($petitionList);
    }
    
?>
