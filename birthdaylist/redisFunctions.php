<?php
function addToRedis($checkInJSON){
    // global $checkInObj;
    global $redis;
    $checkInJSON = json_decode($checkInJSON,true);

    foreach($checkInJSON as $check){
        if (!is_null($check['id'])){
            // print_r($check);
            $id =$check['id'];
            $check = json_encode($check); 
            $redis->set($id,$check);
        }
    }
}