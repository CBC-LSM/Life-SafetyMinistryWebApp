<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$conn = db_connect();
$user_id = $_SESSION['user_id'];
$current_year = date('Y');

// Fetch yearly progress from YearlyProgress table (including current year)
$sql = "
    SELECT year, percentage_read, total_chapters_read, total_chapters_in_bible 
    FROM YearlyProgress 
    WHERE user_id = ? 
    UNION 
    SELECT ?, 
           IFNULL(SUM(IF(is_usable = TRUE, 1, 0)) / 1189 * 100, 0) AS percentage_read, 
           COUNT(IF(is_usable = TRUE, 1, NULL)) AS total_chapters_read, 
           1189 AS total_chapters_in_bible 
    FROM BibleReadingProgress 
    WHERE user_id = ? AND YEAR(timestamp) = ? 
    ORDER BY year DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param('iiii', $user_id, $current_year, $user_id, $current_year);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Logs</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007BFF;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .back-button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #007BFF;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<!-- Include header with hamburger menu -->
<?php include 'header.php'; ?>
<div class="container">
    <h1>Yearly Bible Reading Progress</h1>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Percentage Read</th>
                    <th>Chapters Read</th>
                    <th>Total Chapters in Bible</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['year']); ?></td>
                    <td><?php echo htmlspecialchars($row['percentage_read']); ?>%</td>
                    <td><?php echo htmlspecialchars($row['total_chapters_read']); ?></td>
                    <td><?php echo htmlspecialchars($row['total_chapters_in_bible']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="text-align:center;">No yearly progress data available.</p>
    <?php endif; ?>

    <a href="dashboard.php" class="back-button">Back to Dashboard</a>
</div>

<?php
$stmt->close();
$conn->close();
?>

</body>
</html>
