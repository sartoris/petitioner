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
                LoginId,
                Name,
                Email,
                Password,
                Type
             FROM `User` 
             where 
                ID = ".$_GET["id"];
        $result = $connection->query($query);
        if($result === FALSE) { 
            $record->ERROR = $connection->error;
        }
        else {
            while($row = mysqli_fetch_array($result))
            {
                if ($row[0] == $_GET["id"])
                    $record->loginId = $row[1];
                    $record->name = $row[2];
                    $record->email = $row[3];
                    $record->password = $row[4];
                    $record->userType = $row[5];

            }
        }
        $JSON = json_encode($record);
    }
    echo $JSON;

?>