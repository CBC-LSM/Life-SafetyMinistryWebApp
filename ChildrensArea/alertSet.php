<?php

$servername = "localhost";
$username = "webuser";
$password = "p1r4sp";
$database = "gearpage";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// die("hello");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get parameters from _GET
$location = isset($_GET['location']) ? $_GET['location'] : '';
// die(print_r($location));
$status = "Alert!";

if ($location != '') {
    // Prepare and bind
    $stmt = $conn->prepare("UPDATE children_area_alerts SET status = ? WHERE location = ?");
    $stmt->bind_param("ss", $status, $location);

    // Execute the statement
    if ($stmt->execute()) {
        http_response_code(414);
        echo "Record updated successfully";
    } else {
        http_response_code(500);
        echo "Error updating record: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
} else {
    http_response_code(400);
    echo "Invalid input";
}

// Close connection
$conn->close();
?>
