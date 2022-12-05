<?php
    
    include '../database/load.php';
    $tagid = $_POST['tagid'];
    $doorname = $_POST["doorname"];
    $capturedSecret = $_POST["secret"];
    $secret = "IG75HWfmWQfy4H";
    header('Content-type: application/json');
    // $jsonMessage->test ="test1";
    // $jsonMessage->test->testing ="test2";
    // $jsonMessage->test->testing->stilltesting ="test3";
    // $jsonMessage->test->testing->stilltesting[0] ="test4";

    if ($capturedSecret <> $secret){ //compare secret's found to see if we request came from known program or not.
        $jsonMessage->status = "Incorrect ID used. Stop.";
        $jsonMessage->message ="Don't give in you fools!";
        echo json_encode($jsonMessage);
    }else{ //continue on with the rests.
        $jsonMessage->status = "Correct ID used. Results processing.";
        #date and time inserted by the server
        $date   = date('Y-m-d H:i:s ');

        //build sql to use tagid to determine if valid user
        $rfidResults=find_rfid($tagid);
        if (empty($rfidResults)){       //used tag not found in the db
            $doorstatus = "Access Denied";
            $grant = false;
        }elseif(!empty($rfidResults)){
            $status = $rfidResults[0][5];   
            if ($status == 1){          //determine if user is valid for scanning RFID
                $doorstatus = "Access Granted";
                $userid = $rfidResults[0][0];
                $grant = true;
            }else{
                $userid = $rfidResults[0][0];
                $doorstatus = "Access Denied, User Not Active";
                $grant = false;
            }
        }
        //update rfidlog
        $result=updateAccessLog($tagid,$userid,$doorname,$doorstatus,$date);
        // This works for now. Need to find a way to test to ensure that the $result comes back false sometimes so we can test if that is functional and how to error recovery this.
        //response back to raspberry pi - Lock / Unlock
        if ($grant == true && $result == true){
            http_response_code(200); // response 200 could be a signal that you can unlock the door
            $jsonMessage->message ='Unlock the door!';
            echo json_encode($jsonMessage);
        }else{
            http_response_code(300); // response 300 could be a signal that access was denied. Don't unlock
            $jsonMessage->message ="Don't give in you fools!";
            echo json_encode($jsonMessage);
        }
    }
    // http_response_code(400);
    
?>