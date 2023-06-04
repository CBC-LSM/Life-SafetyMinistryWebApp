<?php 

require '../database/load.php';
require 'scSql.php';

$id = $_GET['id'];
// echo $id;
checkSCOut($id);
