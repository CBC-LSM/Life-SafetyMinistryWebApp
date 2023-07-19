<?php
error_reporting(E_ALL);

require('fpdf/fpdf.php');

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

// Create PDF
$pdf = new FPDF();
$pdf->AddPage();

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


// if (!is_dir('incident_reports')) {
//     mkdir('incident_reports'); // Create the directory if it doesn't exist
// }
// chmod('incident_reports', 0755); // Set directory permissions to 0755
echo 'hello';

// Generate a timestamp
$timestamp = date('YmdHis'); // Format: YearMonthDayHourMinuteSecond

// Save the PDF with timestamp in the file name
$pdf->Output('incident_reports/CBC-LSM_IR-' . $timestamp . '.pdf', 'F');

// Redirect back to the index page
header('Location: index.php');
exit();