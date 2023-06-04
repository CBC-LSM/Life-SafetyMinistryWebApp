<?php 

require '../database/load.php';

$id = $_GET['id'];
// echo $id;
$checkintime   = date('Y-m-d H:i:s');
checkin($id,$checkintime);

