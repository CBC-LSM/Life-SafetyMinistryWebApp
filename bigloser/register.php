<?php
session_start();

require_once('db_connection.php');

// Check if organization code is provided in the URL
if (isset($_GET['org'])) {
    $organizationCode = $_GET['org'];
} else {
    // Redirect to error page with message
    $errorMessage = "No organization code found.";
    header("Location: error.php?message=" . urlencode($errorMessage));
    exit();
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate user input to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Check if the username already exists
    $checkQuery = "SELECT * FROM users WHERE username = '$username' AND organization_code = '$organizationCode'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        // Username already exists, redirect with an error message
        $errorMessage = "Username already exists. Please choose another username.";
        header("Location: error.php?org=".$organizationCode."&message=" . urlencode($errorMessage));
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database with organization code
    $insertQuery = "INSERT INTO users (username, password, organization_code) VALUES ('$username', '$hashedPassword', '$organizationCode')";
    $conn->query($insertQuery);

    // Redirect to weight entry page
    $_SESSION['user_id'] = $conn->insert_id; // Set the session with the new user's ID
    header("Location: info.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Biggest Loser - Register</title>
</head>
<body>
    <div class="container">
        <h2>Biggest Loser Competition </h2>
        <h3> Competitions Starts Jan. 22nd until April 1st </h3>
        <p>Registering to: <?=$organizationCode;?></p>

        <form method="post" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="register">Register</button>
        </form>
    </div>
</body>
</html>
