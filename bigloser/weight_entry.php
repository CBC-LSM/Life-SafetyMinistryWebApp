<?php
// require_once('check_login.php');
session_start();

require_once('db_connection.php');
include('header.php');

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

if (isset($_POST['submit_weight'])) {
    $weight = $_POST['weight'];
    $unit = $_POST['unit'];

    // Convert weight to pounds if the unit is kilograms
    if ($unit === 'kg') {
        $weight = $weight * 2.20462; // 1 kg = 2.20462 lbs
    }

    $userId = $_SESSION['user_id'];

    // Retrieve organization code of the logged-in user
    $queryOrg = "SELECT organization_code FROM users WHERE id = '$userId'";
    $resultOrg = $conn->query($queryOrg);

    if ($resultOrg->num_rows > 0) {
        $rowOrg = $resultOrg->fetch_assoc();
        $organizationCode = $rowOrg['organization_code'];

        // Insert the weight entry into the database with organization code
        $entryDate = date('Y-m-d'); // Assuming you want to store the entry date
        $query = "INSERT INTO weight_entries (user_id, organization_code, weight, entry_date) VALUES ('$userId', '$organizationCode', '$weight', '$entryDate')";
        $conn->query($query);
         // Redirect to the dashboard.php page
         header("Location: dashboard.php");
         exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Biggest Loser - Weight Entry</title>
</head>
<body>
    <div class="container">
        <h2>Weight Entry</h2>

        <form method="post" action="">
            <label for="weight">Weight:</label>
            <input type="number" id="weight" name="weight" step="0.1" required>

            <label for="unit">Unit:</label>
            <select id="unit" name="unit">
                <option value="lbs">Pounds (lbs)</option>
                <option value="kg">Kilograms (kg)</option>
            </select>

            <button type="submit" name="submit_weight">Submit Weight</button>
        </form>
    </div>
</body>
</html>
