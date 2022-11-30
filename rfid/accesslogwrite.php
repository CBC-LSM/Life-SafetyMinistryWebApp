<?php
    
    include '../database/load.php';
    $tagid = $_POST['tagid'];
    $doorname = $_POST["doorname"];

    #date and time inserted by the server
    $date   = date('Y-m-d H:i:s ');

    //build sql to use tagid to determine if valid user
    //if valid set validation bits appropritately to create log. Update response code back to raspberry pi.

    if ($valdiation == "True"){
        $status = "Access Granted";
    }else{
        $status = "Access Denied";
    }
 
    //update log
    $result =updateAccessLog($tagid,$userid,$doorname,$status,$date);

    //response back to raspberry pi - Lock / Unlock
    if ($result == true){
        http_response_code(200); // response 200 could be a signal that you can unlock the door
    }else{
        http_response_code(300); // response 300 could be a signal that access was denied. Don't unlock
    }
?>