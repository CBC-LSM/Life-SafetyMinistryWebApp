<?php

function pcoCall($URL){
    global $username,$password,$datas,$includes;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$URL);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    $results=curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
    curl_close($ch);
    //put the results into a json so it can be iterated through.
    $results = json_decode($results,true);
    $datas = $results['data'];
    // print_r($datas);
    // die();
    $includes = $results['included'];
    // print_r($includes);
    // die();
    $next = $results['links']['next'];
    return $next;
}
function timeConvert($datetime){
    //Convert local server time (NYC) to UTC time to get accurate account
    $dateTime = $datetime; 
    $newDateTime = new DateTime($dateTime); 
    $newDateTime->setTimezone(new DateTimeZone("America/New_York")); 
    $dateTimeNYC = $newDateTime->format("H:i:s");
    return $dateTimeNYC;
}
function dayofweek($date){
    $day_of_week = date('l', strtotime($date));
    return $day_of_week;
}

