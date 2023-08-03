<?php
// Your PHP code to determine the $checkInObj
// This could be any logic to fetch or create the $checkInObj
require_once '../database/load.php';
require_once 'common.php';
// include '../pages/header.php';
require_once 'redisConnection.php';
require_once 'redisFunctions.php';
require_once 'pcoFunctions.php';
require_once 'eventIDs.php';
//Get redis data
$checkInObj[] = new stdClass();//New Event (key) is being looped through so reset the object.
$keyValues = $arList = $redis->keys("*");

$keyValues = $mergedArray;
$columnCount= 38;
$counter = 0;
$column1Header = TRUE;
$column1End;
$column2Header = TRUE;

$currentDate = date("Y-m-d");
// $dateTimeUTC = "2023-06-18";
$currentDate = $dateTimeUTC;
// echo $currentDate;
foreach($keyValues as $key){
    //get and assign data value to $checkInObj[];<- like I did in the call function
    $ReJsonData = $redis->get($key);
    $ReJsonData = json_decode($ReJsonData,true);
    $dataDate = date('Y-m-d',strtotime($ReJsonData['date']));
    if ($currentDate == $dataDate && !is_null($key)){ //find current data only. For Today's eyes only
        $checkInObj[$key] = $ReJsonData;
    }
}



// unfortunately this is necessary as it is auto added when the list is created above. Not sure how to fix permenately but this works in it's place, else
// you end up with a empty key set with no data in it.
unset($checkInObj[0]);

// Your PHP code to check if $checkInObj is empty and set the JavaScript variable accordingly
$isCheckInObjEmpty = empty($checkInObj) ? true : false;

// Return the $checkInObj as a JSON response
header('Content-Type: application/json');
echo json_encode(['isFilled' => !empty($checkInObj), 'checkInObj' => $checkInObj]);
