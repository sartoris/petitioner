<?php
    include 'includes/db.php';

    function getBatchMinCheckoutNumber ($batchSelected) {
        global $connection;
        $statement = $connection->prepare("select min(PetitionNumber) from Petition where BulkCheckOutBy = 0 and Batch = ?");
        $statement->bind_param("s", $batchSelected);
        $statement->execute();
        $result = $statement->bind_result($value);
        if ($result == false) {
            echo "Error on bindig";
        } else if ($statement->fetch() == FALSE) {
            echo "Error on fetch";
        } else {
            echo $value;
        }
        $statement->close();
        $connection->close();        
    }

    function getPetition ($petitionNumber) {
        global $connection;
        $record = new stdClass();
        $query = 
            "SELECT 
                PetitionNumber,
                ID, 
                County,
                DepotID,
                CoordinatorID,
                AmbassadorID,
                CirculatorID,
                SignatureCount,
                ValidSignatureCount,
                isCheckedIn,
                isNotarized,
                isValid,
                Comments,
                PetitionName
            FROM `Petition` 
            where PetitionNumber = '" . $petitionNumber . "'";
        $result = $connection->query($query);
        if($result === FALSE) { 
            $record->ERROR = $connection->error;
        }
        else {
            while($row = mysqli_fetch_array($result))
            {
                if ($row[0] == $petitionNumber)
                    $record->id = $row[1];
                    $record->county = $row[2];
                    $record->depotID = $row[3];
                    $record->coordinatorID = $row[4];
                    $record->ambassadorID = $row[5];
                    $record->circulatorID = $row[6];
                    $record->signatureCount = $row[7];
                    $record->validSignatureCount = $row[8];
                    $record->isCheckedIn = $row[9];
                    $record->isNotarized = $row[10];
                    $record->isValid = $row[11];
                    $record->comments = $row[12];
                    $record->petitionName = $row[13];
            }
        }
        echo json_encode($record);
    }

    if (isset($_GET["batchSelected"]))
        getBatchMinCheckoutNumber($_GET["batchSelected"]);
    else if (isset($_GET["petitionNumber"]))
        getPetition($_GET["petitionNumber"]);

?>