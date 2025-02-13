<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'webuser');
define('DB_PASS', 'p1r4sp');
define('DB_NAME', 'BibleReadingCatalog');

// Establish a connection to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
