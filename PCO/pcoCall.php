<?php

require_once '../database/load.php';
require_once 'common.php';
require_once 'pcoFunctions.php';
require_once 'redisFunctions.php';
require_once 'redisConnection.php';

$next = " "; //setting up $next to not be null at first pass.
$checkInObj[] = new stdClass();//New Event (key) is being looped through so reset the object.
$integer = 0;
while(!is_null($next)){
    // die(print_r($URL));
    $next = pcoCall($URL);
    //This works to iterate through all the "current" check in datas
    //Add a redis comand that will add the "event id's" to a key
    foreach($includes as $included){
        if ($included["type"]=="Location"){
            $LocationId = $included["id"];
            $LocationName = $included['attributes']['name'];
            foreach($datas as $data){ 
                //here we will find who is associated to the found event (key)
                if ($data['relationships']['locations']['data'][0]['id']==$LocationId){
                    $firstName = $data['attributes']['first_name'];
                    $lastName = $data['attributes']['last_name'];
                    $CheckInTime = $data['attributes']['created_at'];
                    $personalID = $data['relationships']['person']['data']['id'];
                    $emergencyContactName = $data['attributes']['emergency_contact_name'];
                    $emergencyContactNumber = $data['attributes']['emergency_contact_phone_number'];
                    $checkedOutTime = $data['attributes']['checked_out_at'];
                    $securityCode = $data['attributes']['security_code'];
                    //find personal attributes in the include section
                    foreach($includes as $included){
                        //Find attributes to the specific person found and then report the data.
                        if ($included['id']==$personalID){
                            $childStatus = $included['attributes']['child'];
                            $grade = $included['attributes']['grade'];
                            $birthdate = $included['attributes']['birthdate'];
                            //one day it may prove to be useful to put this into a function but I don't know if necessary right now.
                            $dob = new DateTime($birthdate);
                            $now = new DateTime();
                            $age = $now->diff($dob);
                            $age = $age->y;
                            //report only if a child
                            if($childStatus && is_null($checkedOutTime)){
                                $checkInObj[$LocationId]->name = $LocationName;
                                $checkInObj[$LocationId]->id = $LocationId;
                                $checkInObj[$LocationId]->date = $dateTimeUTC;
                                $checkInObj[$LocationId]->data->$integer->first_name= $firstName;
                                $checkInObj[$LocationId]->data->$integer->last_name=$lastName;
                                $checkInObj[$LocationId]->data->$integer->emergency_contact_name = $emergencyContactName;
                                $checkInObj[$LocationId]->data->$integer->emergency_contact_number = $emergencyContactNumber;
                                $checkInObj[$LocationId]->data->$integer->check_in_time = $CheckInTime;
                                $checkInObj[$LocationId]->data->$integer->check_out_time = $checkedOutTime;
                                $checkInObj[$LocationId]->data->$integer->personal_id = $personalID;
                                $checkInObj[$LocationId]->data->$integer->child_status = $childStatus;
                                $checkInObj[$LocationId]->data->$integer->grade = $grade;
                                $checkInObj[$LocationId]->data->$integer->age = $age;
                                $checkInObj[$LocationId]->data->$integer->security_code = $securityCode;
                                $checkInObj[$LocationId]->data->$integer->birthdate = $birthdate;
                                echo "done ".$integer."<br>";
                                $integer++;
                            }
                        }
                    }
                }
            
            }
        }
    }
    $URL = $next;
}
$checkInJSON = json_encode($checkInObj);
addToRedis($checkInJSON);
echo "Complete......<br>";