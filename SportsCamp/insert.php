<?php

include '../database/load.php';
include 'scSql.php';

$name = $_POST['name'];
$position =$_POST['position'];
$radio=$_POST['radio'];


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
changeSCStatus($radioID,"SCRadio","Checked Out");
$checkouttime   = date('Y-m-d H:i:s ');
//add this new data to the teamStatus table

$added = addSCGearStatus($nameID,$positionID,$radioID,$checkouttime);
