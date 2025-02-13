<?php
session_start();  // Start session to track user login

// Redirect to dashboard.php after successful login
header('Location: login.php');
?>
