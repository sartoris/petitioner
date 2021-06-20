<?php
    include 'includes/db.php';
    session_start();

    global $connection;
    $JSON = "id=0";
    $record = new stdClass();
    $record->id = $_GET["id"];
    if($_GET["id"] <> 0) {
        $query = 
            "SELECT 
                ID, 
                Name,
                ContactId,
                Endorsement,
                Notes
             FROM `Organization` 
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
                    $record->contactId = $row[$fieldIndex++];
                    $record->endorsement = $row[$fieldIndex++];
                    $record->notes = $row[$fieldIndex++];
            }
        }
        $JSON = json_encode($record);
    }
    echo $JSON;

?>