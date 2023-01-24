<?php 
//Connecting to Redis server on localhost 
$redis = new Redis(); 
$redis->connect('127.0.0.1', 6379); 
// echo "Connection to server sucessfully"; 
// Get the stored keys and print it 
$arList = $redis->keys("*"); 
// echo "Stored keys in redis: "; 
// print_r($arList); 

// $test = $redis->get('120913');
// // echo "here";
// $test = json_decode($test,true);
// // var_dump($test);
// print_r($test);

foreach($arList as $key){
    // $ReJsonData = $redis->get($key);
    // $ReJsonData = stripslashes(html_entity_decode($ReJsonData));
    // print_r($ReJsonData);
    // header("Content-Type: application/json");
    // $ReJsonData = json_decode($ReJsonData,true);
    // $test = json_encode($test,JSON_PRETTY_PRINT);
    
    // print_r($ReJsonData);

    //if you want to see if the system is still running/updating like it should pcoCall.php is 
    //running every 30seconds on crontab -e. You can log into the terminal and run
    // cat /tmp/date.log. This will report back the latest run of the php script date/time only.
}
// $test = $redis->get('98681');
// $test = json_decode($test,true);
// print_r($test);
?>