<?php 

$redis = new Redis(); 
$redis->connect('127.0.0.1', 6379); 
$arList = $redis->keys("*"); 


foreach($arList as $key){
    $redis -> del($key);
    //use this for testing code and seeing redis. Comment back so that this data isn't exposed.
}
echo "Delete Complete...";
?>