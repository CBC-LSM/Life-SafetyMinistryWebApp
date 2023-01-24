<?php

require_once 'common.php';
require_once 'pcoFunctions.php';
require_once 'redisFunctions.php';
require_once 'redisConnection.php';
// require_once 'redisdelete.php';
$next = " "; //setting up $next to not be null at first pass.
$checkInObj[] = new stdClass();//New Event (key) is being looped through so reset the object.
$integer = 0;
while(!is_null($next)){
    // die(print_r($URL));
    $next = pcoCall($URL);
    //This works to iterate through all the "current" check in datas
    //Add a redis comand that will add the "event id's" to a key
    foreach($includes as $included){
        if ($included["type"]=="Event"){
            $EventID = $included["id"];
            $EventName = $included['attributes']['name'];
            foreach($datas as $data){ 
                //here we will find who is associated to the found event (key)
                if ($data['relationships']['event']['data']['id']==$EventID){
                    $firstName = $data['attributes']['first_name'];
                    $lastName = $data['attributes']['last_name'];
                    $CheckInTime = $data['attributes']['created_at'];
                    $personalID = $data['relationships']['person']['data']['id'];
                    $emergencyContactName = $data['attributes']['emergency_contact_name'];
                    $emergencyContactNumber = $data['attributes']['emergency_contact_phone_number'];
                    $checkedOutTime = $data['attributes']['checked_out_at'];
                    //find personal attributes in the include section
                    foreach($includes as $included){
                        //Find attributes to the specific person found and then report the data.
                        if ($included['id']==$personalID){
                            $childStatus = $included['attributes']['child'];
                            $grade = $included['attributes']['grade'];
                            //report only if a child
                            if($childStatus && is_null($checkedOutTime)){
                                $checkInObj[$EventID]->name = $EventName;
                                $checkInObj[$EventID]->id = $EventID;
                                $checkInObj[$EventID]->date = $dateTimeUTC;
                                $checkInObj[$EventID]->data->$integer->first_name= $firstName;
                                $checkInObj[$EventID]->data->$integer->last_name=$lastName;
                                $checkInObj[$EventID]->data->$integer->emergency_contact_name = $emergencyContactName;
                                $checkInObj[$EventID]->data->$integer->emergency_contact_number = $emergencyContactNumber;
                                $checkInObj[$EventID]->data->$integer->check_in_time = $CheckInTime;
                                $checkInObj[$EventID]->data->$integer->check_out_time = $checkedOutTime;
                                $checkInObj[$EventID]->data->$integer->personal_id = $personalID;
                                $checkInObj[$EventID]->data->$integer->child_status = $childStatus;
                                $checkInObj[$EventID]->data->$integer->grade = $grade;
                                $checkInObj[$EventID]->data->$integer->EventID = $EventID;
                                $integer++;
                                // $checkInJSON = json_encode($checkInObj[$EventID]);
                                // $checkInJSON = json_decode($checkInJSON,true);
                                // print_r($checkInJSON);
                                // die();

                                //below is testing variable parsing only. Doesn't need to be in live code.
                                // echo "Event ID ".$EventID.", ";
                                // echo "Event Name: ".$EventName.", ";
                                // echo "First Name: ".$firstName." ",$lastName.", ";
                                // echo "Emergency Contact: ".$emergencyContactName.", ";
                                // echo "Emeergency Contact Number: ".$emergencyContactNumber.", ";
                                // echo "Check In Time: ".$CheckInTime.", ";
                                // echo "Check Out Time: ".$checkedOutTime.", ";
                                // echo "personal id: ".$personalID.", ";
                                // echo "Child Status: ".$childStatus.", ";
                                // echo "grade: ".$grade."<br>";
                                // echo "=============<br>";
                            }
                        }
                    }
                }
            
            }
            // $checkInJSON = json_encode($checkInObj);
            // addToRedis($checkInJSON);
            // $checkInJSON = json_decode($checkInJSON,true);
            // print_r($checkInJSON);
            // die();
            // echo "Event ID: ".$EventID."<br>";
            // addKeyStations($EventID);
        }
    }
    $URL = $next;
    // if(is_null($next)){
    //     break;
    // }else{
    //     $URL = $next;
    //     // echo $URL."<br>=============<br>";
    // }
}
$checkInJSON = json_encode($checkInObj);
// $checkInJSON = json_decode($checkInJSON,true);
// print_r($checkInJSON); 
// die();
addToRedis($checkInJSON);
echo "Complete......<br>";
// $checkInJSON = json_decode($checkInJSON,true);
// print_r($checkInJSON);  


// $arList = $redis->lrange('98681', 0 ,20); 
// // echo "Stored string in redis:: "; 
// print_r($arList); 