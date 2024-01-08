<?php
//Convert local time to UTC time to get accurate account
$dateTime = date("Y-m-d");
// print_r($dateTime);
// die(); 
// $newDateTime = new DateTime($dateTime); 
// $newDateTime->setTimezone(new DateTimeZone("UTC")); 
// $dateTimeUTC = $newDateTime->format("Y-m-d");

//use this to change the date for testing purposes only.

$dateTimeUTC = $dateTime;
// $dateTimeUTC = "2023-09-17";
//2023-12-17
//Set up the API Call
$username = 'acb91b6afa5699d6740e5ac75c03859fa25e1100378afb94e4b67c4ebec33086';
$password = '31bcfe2689f4c3d24f8af1f51795236cab843e529c6fc6b93e019b78e101aa94';
$URL = "https://api.planningcenteronline.com/check-ins/v2/check_ins?include=event,person,locations&where[created_at]=".$dateTimeUTC."&per_page=100";
// $APIURL = "https://api.planningcenteronline.com/check-ins/v2/check_ins?include=event,person,locations&where[created_at]=2023order=-checked_out_at";
// https://api.planningcenteronline.com/check-ins/v2/check_ins?include=event,person,locations&where[created_at]=2023-12-17&order=checked_out_at&per_page=100
//https://api.planningcenteronline.com/check-ins/v2/check_ins?include=event,person,locations&where[created_at]=2023-12-18
// $dateTimeUTC = $newDateTime->format("Y-m-d H:i:s");
// die(print_r($URL));
