<?php
$pageName = "PDF Creation";

require_once '../../database/load.php';
require_once '../common.php';
require_once '../redisConnection.php';
require_once '../redisFunctions.php';
require_once '../pcoFunctions.php';
require_once '../eventIDs.php';
require_once 'pdfFunctions.php';

require('fpdf/fpdf.php');

//Get redis data
$checkInObj[] = new stdClass();//New Event (key) is being looped through so reset the object.
$keyValues = $arList = $redis->keys("*");

$keyValues = $mergedArray;
$currentDate = $dateTimeUTC;

// Get current year, month, and day
$year = date('Y');
$month = date('m');
$day = date('d');

foreach($keyValues as $key){
    //get and assign data value to $checkInObj[];<- like I did in the call function
    $ReJsonData = $redis->get($key);
    $ReJsonData = json_decode($ReJsonData,true);
    $dataDate = date('Y-m-d',strtotime($ReJsonData['date']));
    if ($currentDate == $dataDate && !is_null($key)){ //find current data only. For Today's eyes only
        $checkInObj[$key] = $ReJsonData;
    }
}
unset($checkInObj[0]);

// Check if a PDF file exists for the current date
$pdfFilePath = "checkindata_$year$month$day.pdf";
$data = $checkInObj;
// die(var_dump($data));
generatePDF($data, $pdfFilePath);
echo "Completed";

// // global $redis;
// $data = json_encode($data);
// // die(var_dump($data));
// $redis->set($pdfFilePath,$data);
// $data = $checkInObj;

// //pull the data from redis backup
// $key = $pdfFilePath;
// $ReJsonData = $redis->get($key);
// $ReJsonData = json_decode($ReJsonData,true);

// unset($ReJsonData[0]);
// if ($data == $ReJsonData){
//     echo "Hello....";
// }
// die(var_dump($ReJsonData));

?>
