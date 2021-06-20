<?php
include 'includes/db.php';

$data = "PetitionNumber,County,Depot,Coordinator,Ambassador,Circulator,SignatureCount,ValidSignatureCount,";
$data .= "isCheckedIn,isNotarized,isValid,Comments,CreatedBy,CreatedOn,ModifiedBy,ModifiedOn\n";

$query = "SELECT ";
$query .= "p.PetitionNumber, ";
$query .= "p.County, ";
$query .= "d.name as Depot, ";
$query .= "CONCAT(pco.FirstName, ' ', pco.LastName) as Coordinator, ";
$query .= "CONCAT(pca.FirstName, ' ', pca.LastName) as Ambassador, ";
$query .= "CONCAT(pci.FirstName, ' ', pci.LastName) as Circulator, ";
$query .= "p.SignatureCount, ";
$query .= "p.ValidSignatureCount, ";
$query .= "p.isCheckedIn, ";
$query .= "p.isNotarized, ";
$query .= "p.isValid, ";
$query .= "p.Comments, ";
$query .= "uc.name as CreatedBy, ";
$query .= "p.CreatedOn, ";
$query .= "um.name as ModifiedBy, ";
$query .= "p.ModifiedOn ";
$query .= "FROM Petition p ";
$query .= "LEFT JOIN Depot d on d.ID = p.DepotID ";
$query .= "LEFT JOIN Person pco on pco.ID = p.CoordinatorID ";
$query .= "LEFT JOIN Person pca on pca.ID = p.AmbassadorID ";
$query .= "LEFT JOIN Person pci on pci.ID = p.CirculatorID ";
$query .= "JOIN User uc on uc.ID = p.CreatedBy ";
$query .= "JOIN User um on um.ID = p.ModifiedBy ";
$query .= "order by PetitionNumber";

global $connection;
$result = $connection->query($query);
if($result === FALSE) { 
    $data .= "ERROR: " . $connection->error;
} else {
    while($row = $result->fetch_array())
    {
        $data .= "\"".$row['PetitionNumber']."\",";
        $data .= "\"".$row['County']."\",";
        $data .= "\"".$row['Depot']."\",";
        $data .= "\"".$row['Coordinator']."\",";
        $data .= "\"".$row['Ambassador']."\",";
        $data .= "\"".$row['Circulator']."\",";
        $data .= $row['SignatureCount'].",";
        $data .= $row['ValidSignatureCount'].",";
        $data .= $row['isCheckedIn'].",";
        $data .= $row['isNotarized'].",";
        $data .= $row['isValid'].",";
        $data .= "\"".$row['Comments']."\",";
        $data .= "\"".$row['CreatedBy']."\",";
        $data .= "\"".$row['CreatedOn']."\",";
        $data .= "\"".$row['ModifiedBy']."\",";
        $data .= "\"".$row['ModifiedOn']."\"\n";
    }
}

header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="petitions.csv"');
echo $data; exit();

?>