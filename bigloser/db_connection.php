<?php
// require_once('check_login.php');
// Replace these values with your actual database credentials
$servername = "localhost";
$username = "webuser";
$password = "p1r4sp";
$database = "biggestloser";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// die("hello");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
