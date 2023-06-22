<?php

include '../database/load.php';
include 'scSql.php';

$AutoFilldata = [
    [
        'name' => 'Abby Moore',
        'position' => 'Administration',
        'radio' => 'Radio 4'
    ],
    [
        'name' => 'Tyler Moore',
        'position' => 'Safety',
        'radio' => 'Rover 1'
    ],
    [
        'name' => 'Ray Gaskins',
        'position' => 'Safety',
        'radio' => 'Alpha 1'
    ],
    [
        'name' => 'Eric Swinford',
        'position' => 'Safety',
        'radio' => 'Alpha 2'
    ],
    [
        'name' => 'Michael Vaughn',
        'position' => 'Registration',
        'radio' => 'Lobby 5'
    ],
    [
        'name' => 'Beth Hickey',
        'position' => 'Medical',
        'radio' => 'Medical 1'
    ],
    [
        'name' => 'Jerry Bettner',
        'position' => 'Administration',
        'radio' => 'Radio 5'
    ],
    [
        'name' => '',
        'position' => 'Arts/Crafts',
        'radio' => 'Lobby 1'
    ],
    [
        'name' => '',
        'position' => 'Arts/Crafts',
        'radio' => 'Lobby 2'
    ],
    [
        'name' => '',
        'position' => 'Arts/Crafts',
        'radio' => 'Lobby 4'
    ],
    [
        'name' => 'Daryl Smith',
        'position' => 'Latonia Terrace',
        'radio' => 'Parking 2'
    ] 
    ,
    [
        'name' => 'Steve Martin',
        'position' => 'Latonia Elementary',
        'radio' => 'Radio 9'
    ]     
];

foreach ($AutoFilldata as $item) {

$name = $item['name'];
$position =$item['position'];
$radio=$item['radio'];

// //check if name exists or not in Database. Add if it doesn't
$namecheck = nameCheck($name);
// die(print_r($namecheck));
// echo $namecheck."<br>";
if (!$namecheck){
    //add name to database, return back id
    $nameID = addNameToTeamMembers($name);  
}else{
    $nameID =findNameID($name)[0][0];
    // echo "Name ID: ".$nameID."<br>";
}
//retrieve id for all components
$positionID     = findSCPositionID($position);
$radioID        = findSCRadioID($radio);
changeSCStatus($radioID,"SCRadio","Checked In");
$checkouttime   = date('Y-m-d H:i:s ');
//add this new data to the teamStatus table

$added = startSCGearStatus($nameID,$positionID,$radioID,$checkouttime);
    echo "Name: " . $item['name'] . "<br>";
    echo "Position: " . $item['position'] . "<br>";
    echo "Radio: " . $item['radio'] . "<br>";
    echo "<br>";
}