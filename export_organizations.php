<?php
include 'includes/db.php';

$data = "Name,Contact,Formal Endorsement,Notes,";
$data .= "CreatedBy,CreatedOn,ModifiedBy,ModifiedOn\n";

$query = "SELECT ";
$query .= "o.Name, ";
$query .= "concat(c.FirstName, ' ', c.LastName) as Contact, ";
$query .= "o.Endorsement, ";
$query .= "o.Notes, ";
$query .= "uc.name as CreatedBy, ";
$query .= "o.CreatedOn, ";
$query .= "um.name as ModifiedBy, ";
$query .= "o.ModifiedOn ";
$query .= "FROM Organization o ";
$query .= "LEFT JOIN Person c on c.ID = o.ContactId ";
$query .= "LEFT JOIN User uc on uc.ID = o.CreatedBy ";
$query .= "LEFT JOIN User um on um.ID = o.ModifiedBy ";
$query .= "order by o.Name";

global $connection;
$result = $connection->query($query);
if($result === FALSE) { 
    $data .= "ERROR: " . $connection->error;
} else {
    while($row = $result->fetch_array())
    {
        $data .= "\"".$row['Name']."\",";
        $data .= "\"".$row['Contact']."\",";
        $data .= $row['Endorsement'].",";
        $data .= "\"".$row['Notes']."\",";
        $data .= "\"".$row['CreatedBy']."\",";
        $data .= "\"".$row['CreatedOn'].",\"";
        $data .= "\"".$row['ModifiedBy']."\",";
        $data .= "\"".$row['ModifiedOn']."\"\n";
    }
}

header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="organizations.csv"');
echo $data; exit();

?>