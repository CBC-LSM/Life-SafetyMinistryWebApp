<?php
$pageName = "Test Reports";

require_once '../database/load.php';
// include '../pages/header.php';

$id = 58;

$sql = "SELECT * FROM `IncidentReports` WHERE `id`={$id}";

$result = find_by_sql($sql);
$jsonString = $result[0]['form_data'];

$data = jsoncntrlerrorhandling($jsonString);

// var_dump($data);

//Testing to find people involved array
// $peopleinvolved = $data['PeopleInvolved'];
// print_r($peopleinvolved);

//Testing to find people involved array
$emergencyContact = $data['EmergencyContact'];
// print_r($emergencyContact);
$emergencyFirstName = $data['EmergencyContact']['emergencyFirst'];
$emergencyLastName = $data['EmergencyContact']['emergencyLast'];
$emergencyPhone = $data['EmergencyContact']['emergencyPhone'];

echo $emergencyFirstName;
// print_r($data);
// $date = $data->IncidentDate;
// $date = $data['IncidentDate'];
// $timeofincident= $data->IncidentTime;
// $timeofreport= $data->ReportTime;
// $locationofincident= $data->IncidentLocation;
// $typeofincident= $data->IncidentType;
// $reportwrittenby= $data->ReportWrittenBy;
// $peopleinvolved = $data->PeopleInvolved; // gonna take some work
// $emergencycontact; // need to work on this too (follow up on after fixing in the proces_form.php file first);
// $description = $data->Description;
// $injuryDamage = $data->InjuryDamage;
// $actionTaken = $data->ActionTaken;
// $medicalSupplies = $data->MedicalSupplies;

// echo "<br>Date: ".$date."<br> This works";

// // Your JSON data
// $jsonData = '{"IncidentDate":"2023-09-03","IncidentTime":"09:45","IncidentLocation":"Sanctuary (Stage Right)","IncidentType":"Pan Handling","ReportWrittenBy":"Tyler Moore","ReportTime":"12:22","PeopleInvolved":[{"LastName":"Williams","FirstName":"Thomas","Involvement":"Offender"},{"LastName":"Mounts","FirstName":"Eric","Involvement":"Victim"},{"LastName":"Cafferty","FirstName":"Brian","Involvement":"Safety"}],"EmergencyContact":null,"Description":"Thomas enters Lobby #5. Walks in and is able to engage immediately in conversation with Eric Mounts. They engage in discussion for a short time before 10:30 Service. He lives on 212 Young St In Cincy. He received $20 from Brian Cafferty for a ride to Tri-county. He needed the money quick as his bus was leaving in 15mins. Brian walked him out of Lobby #4. ","InjuryDamage":"na","ActionTaken":"Brian and Eric talked to him and he received $20 from Brian before leaving.","MedicalSupplies":"na","ImageFilePath":""}';

// // Decode the JSON data into an associative array
// $dataArray = json_decode($jsonData, true);

// // Access the "IncidentDate" value and assign it to a variable
// $date = $dataArray['IncidentDate'];

// // Now, $date contains the value of "IncidentDate"
// echo "<br>Date: ".$date;
?>