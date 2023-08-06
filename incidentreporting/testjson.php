<?php
$pageName = "Test Reports";

require_once '../database/load.php';
// include '../pages/header.php';

$id = 5;

$sql = "SELECT * FROM `IncidentReports` WHERE `id`={$id}";

$result = find_by_sql($sql);

die(print_r($result[0][8]));
?>