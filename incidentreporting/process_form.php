<?php
error_reporting(E_ALL);

require('fpdf/fpdf.php');

require_once '../database/load.php';

$photo = new Media();
$photo->upload($_FILES['incidentImage']);

if (!$photo->processIncidentImg()) {
    echo $imageFullPath."<br>";
    echo 'Error: Please upload a valid image file (JPEG, PNG, GIF).';
    exit;
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
$emergencyContact = $_POST['emergencyContact'];
$description = $_POST['description'];
$injuryDamage = $_POST['injuryDamage'];
$actionTaken = $_POST['actionTaken'];
$medicalSupplies = $_POST['medicalSupplies'];

// Generate a timestamp
$timestamp = date('YmdHis'); // Format: YearMonthDayHourMinuteSecond
$date = make_date();

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
$filepath= 'incident_reports/CBC-LSM_IR-' . $timestamp . '.pdf';

// create a function to add to sql database.
// firstname - lastname - datetime - img - status - filepath
$sql = "INSERT INTO `IncidentReports` (`firstname`, `lastname`, `involvementtype`,`date`, `img`, `status`, `filepath`)";
$sql .= " values ('{$reportFirstName}','{$reportLastName}','{$reporttype}','{$date}','{$imageFullPath}','Active','{$filepath}')";

if ($db->query($sql)) {
    //sucess
    echo "Success";
} else {
    //failed
    echo "Failed";
}

// die();

// Create PDF
$pdf = new FPDF();
$pdf->AddPage();

//CBC Information
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Calvary Baptist Church ', 0, 1, 'C');
$pdf->Cell(0, 10, 'Life and Safety Ministry', 0, 1, 'C');
$pdf->Ln(2);

// Add content
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Incident Report', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Date of Incident: ' . $incidentDate, 0, 1);
$pdf->Cell(0, 10, 'Time of Incident: ' . $incidentTime, 0, 1);
$pdf->Cell(0, 10, 'Location of Incident: ' . $incidentLocation, 0, 1);
$pdf->Cell(0, 10, 'Type of Incident: ' . $incidentType, 0, 1);
$pdf->Cell(0, 10, 'Report written by: ' . $reportWrittenBy, 0, 1);
$pdf->Cell(0, 10, 'Time of Report: ' . $reportTime, 0, 1);
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'People Involved:', 0, 1);
$pdf->SetFont('Arial', '', 12);
for ($i = 0; $i < count($personLastNames); $i++) {
    $pdf->Cell(0, 10, 'Person ' . ($i + 1) . ':', 0, 1);
    $pdf->Cell(0, 10, 'Last Name: ' . $personLastNames[$i], 0, 1);
    $pdf->Cell(0, 10, 'First Name: ' . $personFirstNames[$i], 0, 1);
    $pdf->Cell(0, 10, 'Involvement: ' . $personInvolvements[$i], 0, 1);
    $pdf->Ln(5);
}
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Emergency Contact:', 0, 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Emergency Contact: ' . $emergencyContact, 0, 1);
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Description of Incident:', 0, 1);
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 10, $description, 0, 'J');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Describe any Injury or Damage to Property:', 0, 1);
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 10, $injuryDamage, 0, 'J');
$pdf->Ln(10);


$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'What Action Was Taken?', 0, 1);
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 10, $actionTaken, 0, 'J');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Were Any Medical Supplies Used? Describe.', 0, 1);
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 10, $medicalSupplies, 0, 'J');

//Add a page for incident pictures
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Incident Pictures', 0, 1, 'C');

// Add logo image
$pdf->Image($imageFullPath, 10, 60, 120); // Adjust the position as needed

// Save the PDF with timestamp in the file name
$pdf->Output($filepath, 'F');

// Redirect back to the index page
header('Location: index.php');
exit();