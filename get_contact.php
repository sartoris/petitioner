<?php
    include 'includes/db.php';
    session_start();

    global $connection;
    $JSON = "";
    $record = new stdClass();
    $record->id = $_GET["id"];
    if($_GET["id"] <> 0) {
        $query = 
            "SELECT 
                ID, 
                LastName, 
                FirstName,
                Middle,
                Street1,
                Street2,
                City,
                State,
                County,
                Zip,
                Email,
                Phone,
                PhoneType,
                CanText,
                LegislativeDistrict,
                PC,
                Notes,
                CirculatorID,
                OrganizationId,
                HoursAvailable,
                isCoordinator,
                isAmbassador,
                isPetitioner,
                isDepotContact,
                DepotID,
                isNotary,
                isPersonOfInterest
             FROM `Person` 
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
                    $record->lastName = $row[$fieldIndex++];
                    $record->firstName = $row[$fieldIndex++];
                    $record->middle = $row[$fieldIndex++];
                    $record->street1 = $row[$fieldIndex++];
                    $record->street2 = $row[$fieldIndex++];
                    $record->city = $row[$fieldIndex++];
                    $record->state = $row[$fieldIndex++];
                    $record->county = $row[$fieldIndex++];
                    $record->zip = $row[$fieldIndex++];
                    $record->email = $row[$fieldIndex++];
                    $record->phone = $row[$fieldIndex++];
                    $record->phonetype = $row[$fieldIndex++];
                    $record->canText = $row[$fieldIndex++];
                    $record->legislativeDistrict = $row[$fieldIndex++];
                    $record->PC = $row[$fieldIndex++];
                    $record->notes = $row[$fieldIndex++];
                    $record->circulatorID = $row[$fieldIndex++];
                    $record->organizationID = $row[$fieldIndex++];
                    $record->hoursAvailable = $row[$fieldIndex++];
                    $record->isCoordinator = $row[$fieldIndex++];
                    $record->isAmbassador = $row[$fieldIndex++];
                    $record->isPetitioner = $row[$fieldIndex++];
                    $record->isDepotContact = $row[$fieldIndex++];
                    $record->depotID = $row[$fieldIndex++];
                    $record->isNotary = $row[$fieldIndex++];
                    $record->isPersonOfInterest = $row[$fieldIndex++];
            }
        }
        $JSON = json_encode($record);
    }
    echo $JSON;

?>