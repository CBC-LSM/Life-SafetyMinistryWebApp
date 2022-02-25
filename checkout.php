<?php 

require 'database/load.php';

$id = $_GET['id'];
// echo $id;
checkOut($id);
// $checkOUTstatus = updateStatusOut($id);
// // echo "check in status: ".$checkOUTstatus."<br>";

// $results = findComponentStatusID($id)[0];
// $radioID        = $results['radioID'];
// $dsmID          = $results['dsmID'];
// $flashlightID   = $results['flashlightID'];
// $tourniquetID   = $results['tourniquetID'];
// $ubID           = $results['ubID'];

// // echo "Radio ID: ".$radioID."<br>";
// // echo "DSM ID: ".$dsmID."<br>";
// // echo "Flashlight ID: ".$flashlightID."<br>";
// // echo "tourniquet ID: ".$tourniquetID."<br>";
// // echo "UB ID: ".$ubID."<br>";

// // die();
// changeStatus($radioID,"radio","Checked Out");
// if($dsmID){changeStatus($dsmID,"dsm","Checked Out");}
// if($flashlightID){changeStatus($flashlightID,"flashlights","Checked Out");}
// if($tourniquetID){changeStatus($tourniquetID,"tourniquets","Checked Out");}
// if($ubID){changeStatus($ubID,"ub","Checked Out");}


// if (!$checkOUTstatus){
//     echo "Error....";
// }else{
//     redirect('index.php', false);
// }
