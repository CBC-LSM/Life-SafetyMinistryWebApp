<?php
error_reporting(E_ALL);

require('fpdf/fpdf.php');

require_once '../database/load.php';

if ($_FILES['incidentImage']['name']) {
    $photo = new Media();
    $photo->upload($_FILES['incidentImage']);
    
    if (!$photo->processIncidentImg()) {
        echo 'Error: Please upload a valid image file (JPEG, PNG, GIF).';
        exit;
    }
}else{
    $imageFullPath ='';
}


// Get form data
$incidentDate = $_POST['incidentDate'];
$incidentTime = $_POST['incidentTime'];
$incidentLocation = $_POST['incidentLocation'];
$incidentType = $_POST['incidentType'];
$reportWrittenBy = $_POST['reportWrittenBy'];
$reportTime = $_POST['reportTime'];
$personLastNames = $_POST['personLastName'];
$personFirstNames = $_POST['personFirstName'];
$personInvolvements = $_POST['personInvolvement'];
$emergencyContact = $_POST['emergencyContact']; //this isn't 100% correct. Need to update
$description = $_POST['description'];
$injuryDamage = $_POST['injuryDamage'];
$actionTaken = $_POST['actionTaken'];
$medicalSupplies = $_POST['medicalSupplies'];

// Generate a timestamp
$timestamp = date('YmdHis'); // Format: YearMonthDayHourMinuteSecond
$date = make_date();

// Create JSON data
$peopleInvolved = array();
for ($i = 0; $i < count($personLastNames); $i++) {
    $person = array(
        'LastName' => $personLastNames[$i],
        'FirstName' => $personFirstNames[$i],
        'Involvement' => $personInvolvements[$i]
    );
    $peopleInvolved[] = $person;
}

$jsonData = array(
    'IncidentDate' => $incidentDate,
    'IncidentTime' => $incidentTime,
    'IncidentLocation' => $incidentLocation,
    'IncidentType' => $incidentType,
    'ReportWrittenBy' => $reportWrittenBy,
    'ReportTime' => $reportTime,
    'PeopleInvolved' => $peopleInvolved,
    'EmergencyContact' => $emergencyContact,
    'Description' => $description,
    'InjuryDamage' => $injuryDamage,
    'ActionTaken' => $actionTaken,
    'MedicalSupplies' => $medicalSupplies,
    'ImageFilePath' => $imageFullPath // Assuming this is the full path to the uploaded image
);
// die(print_r($jsonData));

$jsonString = json_encode($jsonData);

// Find the first and last name of the victim or offender
$victimFirstName = null;
$victimLastName = null;
$offenderFirstName = null;
$offenderLastName = null;

for ($i = 0; $i < count($personInvolvements); $i++) {
    if ($personInvolvements[$i] === 'Victim') {
        $victimFirstName = $personFirstNames[$i];
        $victimLastName = $personLastNames[$i];
    } elseif ($personInvolvements[$i] === 'Offender') {
        $offenderFirstName = $personFirstNames[$i];
        $offenderLastName = $personLastNames[$i];
    }
}

// If both victim and offender exist, report only the victim's name
if ($victimFirstName && $victimLastName && $offenderFirstName && $offenderLastName) {
    $reportFirstName = $victimFirstName;
    $reportLastName = $victimLastName;
    $reporttype = 'Victim';
}elseif($victimFirstName && $victimLastName){
    $reportFirstName = $victimFirstName;
    $reportLastName = $victimLastName;
    $reporttype = 'Victim';
}elseif($offenderFirstName && $offenderLastName){
    $reportFirstName = $offenderFirstName;
    $reportLastName = $offenderLastName;
    $reporttype = 'Offender';
}

$filepath = 'incident_reports/CBC-LSM_IR-' . $timestamp . '.pdf';

// Prepare SQL statement for inserting JSON data
$sql = "INSERT INTO `IncidentReports` (`firstname`, `lastname`, `involvementtype`, `date`, `img`, `status`, `form_data`)";
$sql .= " VALUES ('{$reportFirstName}', '{$reportLastName}', '{$reporttype}', '{$date}', '{$imageFullPath}', 'Active','{$jsonString}')";

if ($db->query($sql)) {
    // Success
    echo "Success";
} else {
    // Failed
    echo "Failed";
}

// Redirect back to the index page
header('Location: index.php');
exit();
?>
