<?php
function addToRedis($checkInJSON){
    // global $checkInObj;
    global $redis;
    $checkInJSON = json_decode($checkInJSON,true);
    // print_r($checkInJSON['98681']['id']);
    // die();
    foreach($checkInJSON as $check){
        if (!is_null($check['id'])){
            // print_r($check);
            $id =$check['id'];
            $check = json_encode($check); 
            $redis->set($id,$check);
        }
        // print_r($check['id']."<br>");
        // print_r($check);
        // die();
        // $redis->set($check['id'],$check);
    }
    // $redis->set($checkInObj->id,$checkInJSON);

    //Below if for testing only. The rest of this code is currently unnecessary, only for displaying results.
    // $test = $redis->get('120913');
    // $test = json_decode($test,true);

    // print_r($test);
    // var_dump($test);
    // echo "<br>";
    // echo $test->data;
    // die();
    
    // echo ($redis->exists('Test')) ? "Yes I hold a value<br>" : "please store a value in the message key>br>";
    // $redis->lpush($EventID,"name",); 
    // Get the stored data and print it 
}
// function buildObject(){
//     $checkInObj = new stdClass(); //need to build the array fresh from each new "event"
//     global $checkInObj;
//     for ($i=0;$i<10;$i++){
//         $integer = $i;
//         $checkInObj->name = "Test Sunday School Room";
//         $checkInObj->id = "123456789";
//         $checkInObj->data->$integer->first_name= "Tester";
//         $checkInObj->data->$integer->last_name="Moore";
//         $checkInObj->data->$integer->emergency_contact_name = "Rester Moore";
//         $checkInObj->data->$integer->emergency_contact_number = "555-867-5309";
//         $checkInObj->data->$integer->check_in_time = "2023-01-01";
//         $checkInObj->data->$integer->check_out_time = "2023-01-02";
//         $checkInObj->data->$integer->personal_id = "109876543".$i;
//         $checkInObj->data->$integer->child_status = "true";
//         $checkInObj->data->$integer->grade = "1";
//     }
//     $checkInJSON = json_encode($checkInObj);
//     return $checkInJSON;

// }