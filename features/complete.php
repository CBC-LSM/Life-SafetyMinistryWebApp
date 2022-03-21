<?php 

require '../database/load.php';

$id = $_GET['id'];
// echo $id;
$checkintime   = date('Y-m-d H:i:s');
roverComplete($id,"roverchecklist","Completed",$checkintime);

redirect('../pages/rover.php', false);

