<?php

require_once '../database/load.php';

//Get the required information from the modal
$doorid = $_POST['doorid'];
$startday = $_POST['startday'];
$starttime = $_POST['startime'];
$endday = $_POST['endday'];
$endtime = $_POST['endtime'];
$action = $_POST['dooraction'];

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


//setup a post to DB with this information
$results = adddoorscheduletodb($doorid,$startday,$starttime,$endday,$endtime,$action);

echo "results: ".$results;



redirect('../doors/doors.php', false);