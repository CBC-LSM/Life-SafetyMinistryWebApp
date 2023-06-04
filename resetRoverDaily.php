<?php 

require '/var/www/html/cbc-gear-page/database/load.php';


//get all rover list
//for loop through and set all id's status to Not Complete

$roverchecklist = roverchecklist();

// die(var_dump($roverchecklist));
foreach($roverchecklist as $checklist){
    $checkintime   = "";
    roverComplete($checklist['id'],"roverchecklist","Not Complete",$checkintime);
}


// redirect('rover.php', false);

