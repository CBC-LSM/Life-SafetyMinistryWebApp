<?php
/**
 * add_order.php
 *
 * @package default
 */

include 'database/load.php';

$id = $_POST['id'];

$name = $_POST['Edit-Name-Choice'];
$nameid = findNameID($name)[0][0];

if(is_numeric($_POST['position'])){$position =$_POST['position'];}else{$position = findPositionID($_POST['position']);}

if(is_numeric($_POST['radio'])){$radio=$_POST['radio'];}else{$radio = findRadioID($_POST['radio']);}

if(is_numeric($_POST['dsm'])){$dsm = $_POST['dsm'];}else{$dsm = findDSMID($_POST['dsm']);}

if(is_numeric($_POST['flashlight'])){$flashlight = $_POST['flashlight'];}else{$flashlight = findFlashlightID($_POST['flashlight']);}

if(is_numeric($_POST['tourniquet'])){$tourniquet = $_POST['tourniquet'];}else{$tourniquet = findTourniquetID($_POST['tourniquet']);}

if(is_numeric($_POST['utility_bag'])){$utility_bag = $_POST['utility_bag'];}else{$utility_bag = findUbID($_POST['utility_bag']);}

echo "ID: ".$id."<br>";
echo "name: ".$name."<br>";
echo "position ID: ".$position."<br>";
echo "Radio ID: ".$radio."<br>";
echo "DSM ID: ".$dsm."<br>";
echo "Flashlight ID: ".$flashlight."<br>";
echo "Tourniquet ID: ".$tourniquet."<br>";
echo "Utitlity Bag ID: ".$utility_bag."<br>";

$checkouttime   = date('Y-m-d H:i:s ');

$updated = editCheckOut($id,$nameid,$position,$radio,$dsm,$flashlight,$tourniquet,$utility_bag,$checkouttime);

changeStatus($radio,"radio","Checked Out");
if($dsm){changeStatus($dsm,"dsm","Checked Out");}
if($flashlight){changeStatus($flashlight,"flashlights","Checked Out");}
if($tourniquet){changeStatus($tourniquet,"tourniquets","Checked Out");}
if($utility_bag){changeStatus($utility_bag,"ub","Checked Out");}

echo "Updated Status: ".$updated."<br>";

redirect('index.php', false);
//items are updating. now need to write in the logic for checking out the "new" items. Also, need to re-direct back to home page after completed.
