<?php

// Function to create folder structure for the given year, month, and day
function createFolderStructure($year, $month, $day)
{
    $folderPath = "../PDF";
    
    return $folderPath;
}

// Function to fetch data from Redis database
function fetchDataFromRedis()
{   
    global $checkInObj;
    // Implement logic to fetch data from Redis
    // Replace the following line with your actual data retrieval logic
    $data = "Sample data from Redis";
    $data = $checkInObj;
    return  $data;
}

function generatePDF($jsonData, $filePath)
{   

    $pdf = new FPDF();
    $pdf->AddPage();
    $i = 0;
    
    // Convert JSON data to an associative array

    foreach ($jsonData as $datas) {
        $className = $datas['name'];     

        // Set font for the new page based on the class name
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'Class: ' . $className, 0, 1, 'C'); // Centered title for the class
        
        // Header row
        $pdf->Cell(10, 8, ' ', 1,0, 'C');
        $pdf->Cell(40, 8, 'Name', 1,0, 'C');
        $pdf->Cell(60, 8, 'Emergency Contact Name', 1,0, 'C');
        $pdf->Cell(40, 8, 'Phone Number', 1,0, 'C');
        $pdf->Cell(20, 8, 'Found', 1, 0, 'C');
        $pdf->Ln(); // Move to the next line

        // Set font for the data rows
        $pdf->SetFont('Arial', '', 10);

        foreach($datas as $data){
            $event = $data;

            foreach($event as $checkin){
                if ($checkin['checkoutstatus']==0){
                    $i++;
                    $name = $checkin['first_name']." ".$checkin['last_name'];
                    $emContact = $checkin['emergency_contact_name'];
                    $phoneNumber = $checkin['emergency_contact_number'];

                    // Add a row to the table
                    $pdf->Cell(10, 7, $i, 1,0, 'C');
                    $pdf->Cell(40, 7, $name, 1);
                    $pdf->Cell(60, 7, $emContact, 1);
                    $pdf->Cell(40, 7, $phoneNumber, 1);
                    // Draw an empty square to represent the checkbox
                    $pdf->Cell(20, 7, '', 1);  
                    $pdf->Ln(); // Move to the next line
                }
            }
        }
        // die();
        $pdf->AddPage();
        $i = 0;
    }
    
    // Output the PDF to the specified file
    $pdf->Output($filePath, 'F');

    // echo "PDF created.\n";
}

// Function to compare data and update PDF if needed
function updatePDFIfNeeded($data, $existingFilePath)
{
    // Implement logic to compare data and update PDF if needed
    // Replace the following line with your actual comparison and update logic
    if ($data !== file_get_contents($existingFilePath)) {
        generatePDF($data, $existingFilePath);
        echo "PDF updated.\n";
    } else {
        echo "No changes in data. PDF not updated.\n";
    }
}