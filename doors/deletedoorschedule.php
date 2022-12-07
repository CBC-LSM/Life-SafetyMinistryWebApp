<?php

require_once '../database/load.php';
$id = $_GET['id'];

// echo "ID: ".$id;

$result = deleteschedule($id);

if ($result){
    $session->msg("s", "Schedule Has Been Deleted.");

}else{
    $session->msg("d", "Schedule Not Deleted.");
}

redirect('/doors/doors.php', false);














