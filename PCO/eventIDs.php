<?php

$current_time = strtotime(date('H:i:s'));
$cutoff_time = strtotime('10:30:00');

$SSid =array(
    'Baby Nursery'=>'1452290',
    'Toddler Nursery'=>'1452291',
    '2s and 3s'=>'1452296',
    '4s and 5s'=>'1452297',
    'K and 1st Grade'=>'1452295',
    '2nd and 3rd Grade'=>'1452293',
    '4th and 5th Grade'=>'1452294',
    'Jump Jr' => '233887',
    '7th Grade' => '233883',
    '8th Grade' => '233884',
    'Freshman' => '233871',
    'Sophomore' => '233872',
    'Juniors' => '233873',
    'Seniors' => '233874',
);

$WorshipHourid=array(
    'Baby Nursery'=>'1452290',
    'Toddler Nursery'=>'1452291',
    'Disciple Kids Worship Jr.' => '1452299',
    'Disciple Kids Worship' => '1452300'
);

$WednesdayNightId=array(
    'Summer CU' => '1351745',
    'Puggles' => '233759',
    'Wed Baby Nursery' => '261760',
    'Wed Toddler Nursery' => '261761',
    'Cubbies' => '233761',
    'Sparks' => '233760',
    'TNT' => '233762',
    'Ignite'=> '252325',
    'Connect'=> '252327',
    'Wed JUMP Jr.'=> '252328',
);
// Compare the current time with the cutoff time
if ($current_time > $cutoff_time) {
    // Do something if the current time is past 10:30 am
    // echo "It's past 10:30 am. Do something.";
    
    $mergedArray = $WorshipHourid + $WednesdayNightId;
} else {
    // Do something else if the current time is before 10:30 am
    $mergedArray = $SSid + $WednesdayNightId;
    // echo "It's before 10:30 am. Do something else.";
}

// $mergedArray = $SSid + $WorshipHourid + $WednesdayNightId;