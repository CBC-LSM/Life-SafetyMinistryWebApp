<?php

require_once '../database/load.php';

//Get the required information from the modal
$id = $_POST['id'];
$doorid = $_POST['doorid'.$id];
$startday = $_POST['editstartday'.$id];
$starttime = $_POST['editstartime'.$id];
$endday = $_POST['editendday'.$id];
$endtime = $_POST['editendtime'.$id];
$action = $_POST['editdooraction'.$id];
$alwayslocked = $_POST['editAlwaysLocked'.$id];

if ($alwayslocked){
    $startday = "Sunday";
    $starttime = "00:00:00";
    $endday     ="Saturday";
    $endtime    = "23:59:59";
    $action     = "Always Locked";
}
echo "id= ".$id;
echo "<br>";
echo "doorid= ".$doorid;
echo "<br>";
echo "start day= ".$startday;
echo "<br>";
echo "start time = ".$starttime;
echo "<br>";
echo "end day = ".$endday;
echo "<br>";
echo "end time = ".$endtime;
echo "<br>";
echo "action is = ".$action;
echo "<br>";
echo "Always Locked is = ".$alwayslocked;
echo "<br>";


//setup a post to DB with this information
$results = editdoorschedule($id,$doorid,$startday,$starttime,$endday,$endtime,$action);

// echo "results: ".$results;



redirect('../doors/doors.php', false);