<?php
    include 'includes/db.php';
    session_start();

    global $connection;
    $record = new stdClass();
    $record->id = $_GET["id"];
    if($_GET["id"] <> 0) {
        $query = 
            "SELECT 
                ID, 
                Name,
                Street1,
                Street2,
                City,
                State,
                County,
                Zip,
                Phone,
                Email,
                Hours,
                NotaryHours,
                ContactId,
                CheckOutPetitions,
                SubmitCompletedPetitions,
                NotaryAvailable,
                Notes,
                InternalNotes
             FROM `Depot` 
             where 
                ID = ".$_GET["id"];
        $result = $connection->query($query);
        if($result === FALSE) { 
            $record->ERROR = $connection->error;
        }
        else {
            while($row = mysqli_fetch_array($result))
            {
                $fieldIndex = 0;
                if ($row[$fieldIndex++] == $_GET["id"])
                    $record->name = $row[$fieldIndex++];
                    $record->street1 = $row[$fieldIndex++];
                    $record->street2 = $row[$fieldIndex++];
                    $record->city = $row[$fieldIndex++];
                    $record->state = $row[$fieldIndex++];
                    $record->county = $row[$fieldIndex++];
                    $record->zip = $row[$fieldIndex++];
                    $record->phone = $row[$fieldIndex++];
                    $record->email = $row[$fieldIndex++];
                    $record->hours = $row[$fieldIndex++];
                    $record->notaryHours = $row[$fieldIndex++];
                    $record->contactId = $row[$fieldIndex++];
                    $record->checkOutPetitions = $row[$fieldIndex++];
                    $record->submitCompletedPetitions = $row[$fieldIndex++];
                    $record->notaryAvailable = $row[$fieldIndex++];
                    $record->notes = $row[$fieldIndex++];
                    $record->internalNotes = $row[$fieldIndex++];
            }
        }
        $JSON = json_encode($record);
    }
    echo $JSON;

?>