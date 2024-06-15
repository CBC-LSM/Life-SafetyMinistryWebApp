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
        'name' => 'Eric Swinford',
        'position' => 'Safety',
        'radio' => 'Alpha 1'
    ],
    [
        'name' => 'Josh McCain',
        'position' => 'Safety',
        'radio' => 'Alpha 2'
    ] ,
    [
        'name' => 'Joey Carroll',
        'position' => 'Medical',
        'radio' => 'Medical 1'
    ],
    [
        'name' => 'Tim Peterson',
        'position' => 'Administration',
        'radio' => 'Radio 5'
    ],
    [
        'name' => 'Karen Linton',
        'position' => 'Arts/Crafts',
        'radio' => 'Lobby 1'
    ],
    [
        'name' => 'Daryl Smith',
        'position' => 'Latonia Terrace',
        'radio' => 'Radio 6'
    ],
    [
        'name' => 'Steve Martin',
        'position' => 'Latonia Elementary',
        'radio' => 'Radio 7'
    ],
    [
        'name' => 'Lora Ledford',
        'position' => 'Snacks',
        'radio' => 'Radio 8'
    ],
    [
        'name' => 'Communication Tester',
        'position' => 'Administration',
        'radio' => 'Radio 1'
    ],
    [
        'name' => 'Dustin Cain',
        'position' => 'Registration',
        'radio' => 'Radio 2'
    ],
    [
        'name' => 'Paula McNeill',
        'position' => 'Yellow Jackets',
        'radio' => 'Radio 3'
    ],
    [
        'name' => 'Liz Chiang',
        'position' => 'Red Hawks',
        'radio' => 'Lobby 2'
    ],
    [
        'name' => 'Cathi Faulkner',
        'position' => 'Blue Jays',
        'radio' => 'Lobby 4'
    ],
    [
        'name' => 'Maggie McCombie',
        'position' => 'Green Hornets',
        'radio' => 'Lobby 5'
    ],
    [
        'name' => 'Olivia Sena',
        'position' => 'Orange Tigers',
        'radio' => 'Office'
    ],
    [
        'name' => 'Ken Chard',
        'position' => 'Purple Panthers',
        'radio' => 'Parking 1'
    ],
    [
        'name' => 'Lauren Reiber',
        'position' => 'Cheering Cheetas',
        'radio' => 'Parking 2'
    ],
    [
        'name' => 'Aaron Steele',
        'position' => 'Archery Armadillos',
        'radio' => 'Alpha 3'
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