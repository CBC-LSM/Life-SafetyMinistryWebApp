<?php 

require '../database/load.php';
require 'scSql.php';

$id = $_GET['id'];
// echo $id;
$checkintime   = date('Y-m-d H:i:s');
checkSCin($id,$checkintime);

