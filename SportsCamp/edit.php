<?php

include '../database/load.php';
include 'scSql.php';

$id = $_POST['id'];

$name = $_POST['Edit-Name-Choice'];
$nameid = findNameID($name)[0][0];

if(is_numeric($_POST['position'])){$position =$_POST['position'];}else{$position = findSCPositionID($_POST['position']);}
if(is_numeric($_POST['radio'])){$radio=$_POST['radio'];}else{$radio = findSCRadioID($_POST['radio']);}


$checkouttime   = date('Y-m-d H:i:s ');

//Find previous entry and Check items in
$previousEntry = findSCComponentStatusID($id)[0];
// die(var_dump($previousEntry));
$previousRadioID      = $previousEntry['radioID'];


if ($previousRadioID != $radio){changeSCStatus($previousRadioID,"SCRadio","Checked In");}

$updated = editSCCheckOut($id,$nameid,$position,$radio,$checkouttime);

changeSCStatus($radio,"SCRadio","Checked Out");

// echo "Updated Status: ".$updated."<br>";

redirect('../SportsCamp/index.php', false);
