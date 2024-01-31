<?php
session_start();
require_once('db_connection.php'); // Adjust the path as needed
include('header.php');

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

if (isset($_POST['create_event'])) {
    $orgCode = $_POST['org_code'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $adminUserId = $_SESSION['user_id'];

    // Insert event into the database
    $queryCreateEvent = "INSERT INTO events (org_code, start_date, end_date, admin_user_id) 
                         VALUES ('$orgCode', '$startDate', '$endDate', '$adminUserId')";
    
    if ($conn->query($queryCreateEvent) === TRUE) {
        echo "Event created successfully";
        header("Location: dashboard.php");
    } else {
        echo "Error creating event: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
</head>
<body>

<h2>Create Event</h2>

<form method="post" action="">
    <label for="org_code">Organization Code:</label>
    <input type="text" id="org_code" name="org_code" required>

    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" required>

    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" required>

    <button type="submit" name="create_event">Create Event</button>
</form>

</body>
</html>
