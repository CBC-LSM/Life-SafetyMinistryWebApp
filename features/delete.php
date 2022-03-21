<?php 

require '../database/load.php';

$id = $_GET['id'];
//get all equipment ID's from status table
$results = findComponentStatusID($id)[0];
$radioID        = $results['radioID'];
$dsmID          = $results['dsmID'];
$flashlightID   = $results['flashlightID'];
$tourniquetID   = $results['tourniquetID'];
$ubID           = $results['ubID'];

echo "Radio ID: ".$radioID."<br>";
echo "DSM ID: ".$dsmID."<br>";
echo "Flashlight ID: ".$flashlightID."<br>";
echo "tourniquet ID: ".$tourniquetID."<br>";
echo "UB ID: ".$ubID."<br>";

// die();
changeStatus($radioID,"radio","Checked In");
if($dsmID){changeStatus($dsmID,"dsm","Checked In");}
if($flashlightID){changeStatus($flashlightID,"flashlights","Checked In");}
if($tourniquetID){changeStatus($tourniquetID,"tourniquets","Checked In");}
if($ubID){changeStatus($ubID,"ub","Checked In");}
// die(var_dump($results));
// echo $id;
$deleteStatus = deleteEntry($id);
// echo "check in status: ".$deleteStatus."<br>";



if (!$deleteStatus){
    echo "Error....";
}else{
    redirect('/', false);
}
