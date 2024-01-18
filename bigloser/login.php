<?php
session_start();
// // Hashing the password
// $plaintextPassword = "testpass";
// $hashedPassword = password_hash($plaintextPassword, PASSWORD_DEFAULT);

// echo "Hashed Password: " . $hashedPassword;
// die();
if (isset($_POST['login'])) {
    require_once('db_connection.php');

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Validate user input to prevent SQL injection (you can use prepared statements)
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    
    // Perform authentication
    $query = "SELECT id, password FROM users WHERE username = '$username'";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // Verify password
        if (password_verify($password, $hashedPassword)) {
            // Authentication successful
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            $error_message = "Incorrect password";
        }
    } else {
        $error_message = "User not found";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Biggest Loser - Login</title>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        
        <?php if (isset($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form method="post" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>
