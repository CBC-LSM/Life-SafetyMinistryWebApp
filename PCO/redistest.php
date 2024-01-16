<?php 
// require_once 'eventIDs.php';
// die(print_r($mergedArray));
$redis = new Redis(); 
$redis->connect('127.0.0.1', 6379); 
$arList = $redis->keys("*"); 
print_r($arList);

foreach($arList as $key){
    //use this for testing code and seeing redis. Comment back so that this data isn't exposed.
    $ReJsonData = $redis->get($key);
    $ReJsonData = json_decode($ReJsonData,true);
    print_r($ReJsonData);
}
?>