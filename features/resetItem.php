<?php 

require '../database/load.php';

$id = $_GET['id'];
// echo $id;
$checkintime   = "";
roverComplete($id,"roverchecklist","Not Complete",$checkintime);

redirect('../pages/rover.php', false);

