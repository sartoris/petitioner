<?php
include 'includes/db.php';

$data = "FirstName,Middle,LastName,Street1,Street2,City,State,Zip,";
$data .= "County,Phone,Email,CanText,LegislativeDistrict,CirculatorID,Organization,HoursAvailable,";
$data .= "isCoordinator,isAmbassador,isPetitioner,isNotary,isPersonOfInterest,";
$data .= "isDepotContact,Depot,Notes,";
$data .= "CreatedBy,CreatedOn,ModifiedBy,ModifiedOn\n";

$query = "SELECT ";
$query .= "p.FirstName, ";
$query .= "p.Middle, ";
$query .= "p.LastName, ";
$query .= "p.Street1, ";
$query .= "p.Street2, ";
$query .= "p.City, ";
$query .= "p.State, ";
$query .= "p.Zip, ";
$query .= "p.County, ";
$query .= "p.Phone, ";
$query .= "p.Email, ";
$query .= "p.CanText, ";
$query .= "p.LegislativeDistrict, ";
$query .= "p.CirculatorID, ";
$query .= "o.Name as Organization, ";
$query .= "p.HoursAvailable, ";
$query .= "p.isCoordinator, ";
$query .= "p.isAmbassador, ";
$query .= "p.isPetitioner, ";
$query .= "p.isNotary, ";
$query .= "p.isPersonOfInterest, ";
$query .= "p.isDepotContact, ";
$query .= "d.name as Depot, ";
$query .= "p.Notes, ";
$query .= "uc.name as CreatedBy, ";
$query .= "p.CreatedOn, ";
$query .= "um.name as ModifiedBy, ";
$query .= "p.ModifiedOn ";
$query .= "FROM Person p ";
$query .= "LEFT JOIN Depot d on d.ID = p.DepotID ";
$query .= "LEFT JOIN Organization o on o.ID = p.OrganizationID ";
$query .= "LEFT JOIN User uc on uc.ID = p.CreatedBy ";
$query .= "LEFT JOIN User um on um.ID = p.ModifiedBy ";
$query .= "WHERE isPending = 0 ";
$query .= "order by p.FirstName, p.LastName";

global $connection;
$result = $connection->query($query);
if($result === FALSE) { 
    $data .= "ERROR: " . $connection->error;
} else {
    while($row = $result->fetch_array())
    {
        $data .= "\"".$row['FirstName']."\",";
        $data .= "\"".$row['Middle']."\",";
        $data .= "\"".$row['LastName']."\",";
        $data .= "\"".$row['Street1']."\",";
        $data .= "\"".$row['Street2']."\",";
        $data .= "\"".$row['City']."\",";
        $data .= "\"".$row['State']."\",";
        $data .= $row['Zip'].",";
        $data .= "\"".$row['County']."\",";
        $data .= "\"".$row['Phone']."\",";
        $data .= "\"".$row['Email']."\",";
        $data .= $row['CanText'].",";
        $data .= $row['LegislativeDistrict'].",";
        $data .= $row['CirculatorID'].",";
        $data .= "\"".$row['Organization']."\",";
        $data .= "\"".$row['HoursAvailable']."\",";
        $data .= $row['isCoordinator'].",";
        $data .= $row['isAmbassador'].",";
        $data .= $row['isPetitioner'].",";
        $data .= $row['isNotary'].",";
        $data .= $row['isPersonOfInterest'].",";
        $data .= $row['isDepotContact'].",";
        $data .= "\"".$row['Depot']."\",";
        $data .= "\"".$row['Notes']."\",";
        $data .= "\"".$row['CreatedBy']."\",";
        $data .= "\"".$row['CreatedOn']."\",";
        $data .= "\"".$row['ModifiedBy']."\",";
        $data .= "\"".$row['ModifiedOn']."\"\n";
    }
}

header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="contacts.csv"');
echo $data; exit();

?>