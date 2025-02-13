<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $conn = db_connect();

    // Check if the email already exists
    $check_sql = "SELECT * FROM Users WHERE email = ?";
    $stmt_check = $conn->prepare($check_sql);
    $stmt_check->bind_param('s', $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $error_message = "Email already registered. Please <a href='login.php'>login</a>.";
    } else {
        $sql = "INSERT INTO Users (username, email, password_hash) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $username, $email, $password);

        if ($stmt->execute()) {
            header('Location: login.php?registered=true');
            exit;
        } else {
            $error_message = "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $stmt_check->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="register-container">
        <h1>Register</h1>

        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <label>Username: <input type="text" name="username" required></label><br>
            <label>Email: <input type="email" name="email" required></label><br>
            <label>Password: <input type="password" name="password" required></label><br>
            <input type="submit" value="Register">
        </form>

        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
