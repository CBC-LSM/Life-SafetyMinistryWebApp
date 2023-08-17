<?php
require_once '../database/load.php';
$sql = "SELECT * FROM `IncidentReports`WHERE `id`=52";
    
$report = find_by_sql($sql);

$data = json_decode($report[0]['form_data']);
print_r($data);
// var_dump($data);
// echo "<br>hello<br>";
// echo $data->IncidentDate."<br>";
// var_dump($data->IncidentDate);
// $peopleinvolved = $data->PeopleInvolved;
// var_dump($peopleinvolved[0]);