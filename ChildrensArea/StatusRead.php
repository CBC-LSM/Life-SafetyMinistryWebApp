<?php
$servername = "localhost";
$username = "webuser";
$password = "p1r4sp";
$database = "gearpage";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the query
$sql = "SELECT Location FROM children_area_alerts WHERE Status = 'Alert!'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output locations in alert
    $alerts = [];
    while($row = $result->fetch_assoc()) {
        $alerts[] = $row["Location"];
    }
    http_response_code(200);
    echo json_encode($alerts); // Return as JSON array
} else {
    http_response_code(200);
    echo json_encode([]); // Return empty JSON array if no alerts
}

// Close connection
$conn->close();
?>
