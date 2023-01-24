<?php
//Convert local time to UTC time to get accurate account
$dateTime = date("Y-m-d"); 
$newDateTime = new DateTime($dateTime); 
$newDateTime->setTimezone(new DateTimeZone("UTC")); 
$dateTimeUTC = $newDateTime->format("Y-m-d");
// $dateTimeUTC = "2023-01-22";
// echo "local: ".$dateTime."<br>";
// echo "UTC: ".$dateTimeUTC."<br>";

//Set up the API Call
$username = 'acb91b6afa5699d6740e5ac75c03859fa25e1100378afb94e4b67c4ebec33086';
$password = '31bcfe2689f4c3d24f8af1f51795236cab843e529c6fc6b93e019b78e101aa94';
// $URL="https://api.planningcenteronline.com/check-ins/v2/check_ins?where[created_at]=".$dateTimeUTC;
// $URL="https://api.planningcenteronline.com/check-ins/v2/check_ins/<checkin_id>/event_period";
$URL = "https://api.planningcenteronline.com/check-ins/v2/check_ins?include=event&where[created_at]=".$dateTimeUTC."&per_page=100";
// die(print_r($URL));
