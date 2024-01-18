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

    // Retrieve weight entry for editing
    $queryEntry = "SELECT id, weight, entry_date FROM weight_entries WHERE id = '$entryId' AND user_id = '{$_SESSION['user_id']}'";
    $resultEntry = $conn->query($queryEntry);

    if ($resultEntry->num_rows === 0) {
        // Redirect to an error page or handle as needed
        header("Location: error.php");
        exit();
    }

    $row = $resultEntry->fetch_assoc();

    if (isset($_POST['submit_edit'])) {
        $newWeight = $_POST['new_weight'];

        // Update the weight entry in the database
        $queryUpdate = "UPDATE weight_entries SET weight = '$newWeight' WHERE id = '$entryId'";
        $conn->query($queryUpdate);

        // Redirect back to previous entries page
        header("Location: prev_entries.php");
        exit();
    }
} else {
    // Redirect to an error page or handle as needed
    header("Location: error.php");
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
    <title>Biggest Loser - Edit Entry</title>
</head>
<body>
    <div class="container">
        <h2>Edit Entry</h2>

        <form method="post" action="">
            <label for="new_weight">New Weight:</label>
            <input type="number" id="new_weight" name="new_weight" step="0.1" value="<?php echo $row['weight']; ?>" required>

            <button type="submit" name="submit_edit">Submit Edit</button>
        </form>
    </div>
</body>
</html>
