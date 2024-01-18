<?php
// require_once('check_login.php');
session_start();

require_once('db_connection.php');

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $entryId = $_GET['id'];

    // Delete the weight entry from the database
    $queryDelete = "DELETE FROM weight_entries WHERE id = '$entryId' AND user_id = '{$_SESSION['user_id']}'";
    $conn->query($queryDelete);

    // Redirect back to previous entries page
    header("Location: prev_entries.php");
    exit();
} else {
    // Redirect to an error page or handle as needed
    header("Location: error.php");
    exit();
}

$conn->close();
?>
