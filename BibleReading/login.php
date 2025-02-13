<?php
session_start();
require_once 'db_connect.php';

$error_message = '';

// Connect to the database
$conn = db_connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['user_id'];

            // Capture IP address
            $ip_address = $_SERVER['REMOTE_ADDR'];

            // Log the login event in UserLoginLog with IP address
            $log_sql = "INSERT INTO UserLoginLog (user_id, login_timestamp, ip_address) VALUES (?, NOW(), ?)";
            $log_stmt = $conn->prepare($log_sql);
            $log_stmt->bind_param('is', $user['user_id'], $ip_address);
            $log_stmt->execute();
            $log_stmt->close();

            // Redirect to dashboard
            header('Location: dashboard.php');
            exit;
        } else {
            $error_message = "Invalid password!";
        }
    } else {
        $error_message = "No account found with that email.";
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mobile_optimized_style.css">
    <title>Login</title>
</head>
<body>

<div class="form-container">
    <h1>Login</h1>
    <?php if (!empty($error_message)): ?>
        <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label>Email:
            <input type="email" name="email" required>
        </label><br>
        <label>Password:
            <input type="password" name="password" required>
        </label><br>
        <input type="submit" value="Login" class="submit-button">
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
</div>

</body>
</html>
