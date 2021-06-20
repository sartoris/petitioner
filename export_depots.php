<?php
include 'includes/db.php';

$data = "Name,Street1,Street2,City,State,Zip,County,Phone,Email,";
$data .= "Hours,NotaryHours,Contact,";
$data .= "CheckOutPetitions,SubmitCompletedPetitions,NotaryAvailable,";
$data .= "Notes,InternalNotes,";
$data .= "CreatedBy,CreatedOn,ModifiedBy,ModifiedOn\n";

$query = "SELECT ";
$query .= "d.Name, ";
$query .= "d.Street1, ";
$query .= "d.Street2, ";
$query .= "d.City, ";
$query .= "d.State, ";
$query .= "d.Zip, ";
$query .= "d.County, ";
$query .= "d.Phone, ";
$query .= "d.email, ";
$query .= "d.Hours, ";
$query .= "d.NotaryHours, ";
$query .= "concat(c.FirstName, ' ', c.LastName) as Contact, ";
$query .= "d.CheckOutPetitions, ";
$query .= "d.SubmitCompletedPetitions, ";
$query .= "d.NotaryAvailable, ";
$query .= "d.Notes, ";
$query .= "d.InternalNotes, ";
$query .= "uc.name as CreatedBy, ";
$query .= "d.CreatedOn, ";
$query .= "um.name as ModifiedBy, ";
$query .= "d.ModifiedOn ";
$query .= "FROM Depot d ";
$query .= "LEFT JOIN Person c on c.ID = d.ContactId ";
$query .= "LEFT JOIN User uc on uc.ID = d.CreatedBy ";
$query .= "LEFT JOIN User um on um.ID = d.ModifiedBy ";
$query .= "order by Name";

global $connection;
$result = $connection->query($query);
if($result === FALSE) { 
    $data .= "ERROR: " . $connection->error;
} else {
    while($row = $result->fetch_array())
    {
        $data .= "\"".$row['Name']."\",";
        $data .= "\"".$row['Street1']."\",";
        $data .= "\"".$row['Street2']."\",";
        $data .= "\"".$row['City']."\",";
        $data .= "\"".$row['State']."\",";
        $data .= $row['Zip'].",";
        $data .= "\"".$row['County']."\",";
        $data .= "\"".$row['Phone']."\",";
        $data .= "\"".$row['email']."\",";
        $data .= "\"".$row['Hours']."\",";
        $data .= "\"".$row['NotaryHours']."\",";
        $data .= "\"".$row['Contact']."\",";
        $data .= $row['CheckOutPetitions'].",";
        $data .= $row['SubmitCompletedPetitions'].",";
        $data .= $row['NotaryAvailable'].",";
        $data .= "\"".$row['Notes']."\",";
        $data .= "\"".$row['InternalNotes']."\",";
        $data .= "\"".$row['CreatedBy']."\",";
        $data .= "\"".$row['CreatedOn'].",\"";
        $data .= "\"".$row['ModifiedBy']."\",";
        $data .= "\"".$row['ModifiedOn']."\"\n";
    }
}

header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="depots.csv"');
echo $data; exit();

?>