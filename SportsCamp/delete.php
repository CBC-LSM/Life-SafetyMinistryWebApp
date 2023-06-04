<?php 

require '../database/load.php';
include 'scSql.php';

$id = $_GET['id'];
//get all equipment ID's from status table
$results = findSCComponentStatusID($id)[0];
$radioID        = $results['radioID'];


// die();
changeSCStatus($radioID,"SCRadio","Checked In");

$deleteStatus = deleteSCEntry($id);

if (!$deleteStatus){
    echo "Error....";
}else{
    redirect('../SportsCamp/index.php', false);
}
