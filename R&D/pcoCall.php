<?php

require_once '../database/load.php';
require_once 'common.php';
require_once 'pcoFunctions.php';
require_once 'redisFunctions.php';
require_once 'redisConnection.php';

$next = " "; //setting up $next to not be null at first pass.
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=file.csv");
header("Pragma: no-cache");
header("Expires: 0");
$data = array();
$header = array('Location Name', 'Location ID');
while(!is_null($next)){
    // die(print_r($URL));
    $next = pcoCall($URL);
    //This works to iterate through all the "current" check in datas
    //Add a redis comand that will add the "event id's" to a key
    foreach($includes as $included){
        if ($included["type"]=="Location"){
            $LocationId = $included["id"];
            $LocationName = $included['attributes']['name'];
            // echo $LocationName."\t".$LocationId."<br>";
            $data[]=array($LocationName,$LocationId);
        }
    }
    $URL = $next;
}

$fp = fopen('php://output', 'w');
fputcsv($fp, $header);
foreach ($data as $fields) {
    fputcsv($fp, $fields);
}
fclose($fp);
// $checkInJSON = json_encode($checkInObj);
// addToRedis($checkInJSON);
echo "Complete......<br>";