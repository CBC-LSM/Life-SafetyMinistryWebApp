<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$conn = db_connect();
$update_success = false;
$error_message = '';

// Fetch user settings (example for settings form)
$sql_user = "SELECT username, email FROM Users WHERE user_id = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param('i', $user_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();
$stmt_user->close();

// Handle form submission for copying progress from the previous year
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['copy_progress'])) {
    $last_year = date('Y') - 1;
    $current_year = date('Y');

    // Copy chapters from the last year to the current year
    $sql_copy = "INSERT INTO BibleReadingProgress (user_id, book, chapter, timestamp, is_usable)
                 SELECT user_id, book, chapter, NOW(), TRUE FROM BibleReadingProgress 
                 WHERE user_id = ? AND YEAR(timestamp) = ? AND is_usable = TRUE";
    $stmt_copy = $conn->prepare($sql_copy);
    $stmt_copy->bind_param('ii', $user_id, $last_year);
    if ($stmt_copy->execute()) {
        $update_success = true;
    } else {
        $error_message = "Failed to copy progress from last year.";
    }
    $stmt_copy->close();
}

// Handle form submission for marking the current year’s progress as unusable (soft delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['soft_delete'])) {
    $current_year = date('Y');

    // Update all Bible reading progress for the current year to mark it as unusable
    $sql_soft_delete = "UPDATE BibleReadingProgress SET is_usable = FALSE WHERE user_id = ? AND YEAR(timestamp) = ?";
    $stmt_soft_delete = $conn->prepare($sql_soft_delete);
    $stmt_soft_delete->bind_param('ii', $user_id, $current_year);
    
    if ($stmt_soft_delete->execute()) {
        $update_success = true;
    } else {
        $error_message = "Failed to mark current year's progress as unusable.";
    }
    $stmt_soft_delete->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Settings</title>
    <!-- Import Google Fonts for better typography -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Apply a universal font styling */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        /* General container styling */
        .container {
            max-width: 75%;
            margin: 20% auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        /* Form input styling */
        label {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
            color: #333;
            font-weight: bold; /* Added bold for labels */
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        /* Button container to align buttons horizontally */
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: 48%;
            font-family: 'Roboto', sans-serif;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Back button styling */
        .back-button {
            display: block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            font-family: 'Roboto', sans-serif;
        }

        .back-button:hover {
            background-color: #218838;
        }

        /* Success and error message styling */
        p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        p[style="color: green;"] {
            color: green;
            font-weight: bold;
        }

        p[style="color: red;"] {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Include header with hamburger menu -->
    <?php include 'header.php'; ?>

    <div class="container">
        <h1>Account Settings</h1>

        <?php if ($update_success): ?>
            <p style="color: green;">Your changes have been applied successfully.</p>
        <?php elseif ($error_message): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <!-- Account Settings Form -->
        <form method="POST" action="">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['username']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <!-- Button container to align buttons horizontally -->
            <div class="button-container">
                <input type="submit" name="copy_progress" value="Copy Previous Year’s Progress to Current Year">
                <input type="submit" name="soft_delete" value="Reset Current Year (Soft Delete)">
            </div>
        </form>

        <!-- Navigation buttons -->
        <a href="dashboard.php" class="back-button">Back to Dashboard</a>
    </div>

</body>
</html>
