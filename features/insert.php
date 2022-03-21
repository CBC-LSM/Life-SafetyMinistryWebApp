<?php
/**
 * add_order.php
 *
 * @package default
 */

include '../database/load.php';

$name = $_POST['name'];
$position =$_POST['position'];
$radio=$_POST['radio'];
$dsm = $_POST['dsm'];
$flashlight = $_POST['flashlight'];
$tourniquet = $_POST['tourniquet'];
$utility_bag = $_POST['utility_bag'];

//used for testing only.
// $name       = "aTylerTest1";
// $position   = "Rover";
// $radio      = "Radio 1";
// $dsm        = "DSM 1";
// $flashlight = "Flashlight 1";
// $tourniquet = "Tourniquet 1";
// $utility_bag    = "UB 1";

// //check if name exists or not in Database. Add if it doesn't
$namecheck = nameCheck($name);
// echo $namecheck."<br>";
if (!$namecheck){
    //add name to database, return back id
    $nameID = addNameToTeamMembers($name);  
}else{
    $nameID =findNameID($name)[0][0];
    // echo "Name ID: ".$nameID."<br>";
}
//retrieve id for all components
$positionID     = findPositionID($position);
$radioID        = findRadioID($radio);
changeStatus($radioID,"radio","Checked Out");
$dsmID          = findDSMID($dsm);
if($dsmID){changeStatus($dsmID,"dsm","Checked Out");}
$flashlightID   = findFlashlightID($flashlight);
if($flashlightID){changeStatus($flashlightID,"flashlights","Checked Out");}
$tourniquetID   = findTourniquetID($tourniquet);
if($tourniquetID){changeStatus($tourniquetID,"tourniquets","Checked Out");}
$ubID           = findUbID($utility_bag);
if($ubID){changeStatus($ubID,"ub","Checked Out");}
$checkouttime   = date('Y-m-d H:i:s ');

//add this new data to the teamStatus table

$added = addTeamStatus($nameID,$positionID,$radioID,$dsmID,$flashlightID,$tourniquetID,$ubID,$checkouttime);


// used for testing only.

// echo "position ID: ".$positionID."<br>";
// echo "Radio ID: ".$radioID."<br>";
// echo "DSM ID: ".$dsmID."<br>";
// echo "Flashlight ID: ".$flashlightID."<br>";
// echo "Tourniquet ID: ".$tourniquetID."<br>";
// echo "Utitlity Bag ID: ".$ubID."<br>";