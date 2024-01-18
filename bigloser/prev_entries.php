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

$userId = $_SESSION['user_id'];

// Retrieve weight entries for the logged-in user
$queryEntries = "SELECT id, weight, entry_date FROM weight_entries WHERE user_id = '$userId' ORDER BY entry_date DESC";
$resultEntries = $conn->query($queryEntries);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Add your existing styles here -->

    <!-- Custom styles for mobile -->
    <style>
    
        @media (max-width: 350px) {
            body {
                padding-top: 0;
            }

            td.date {
                font-size: 12px;
            }
        }
    </style>

    <title>Biggest Loser - Previous Entries</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Previous Entries</h2>

        <div class="table-responsive">
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Weight</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $resultEntries->fetch_assoc()): ?>
                        <tr>
                            <td class="date"><?php echo date('m/d/y', strtotime($row['entry_date'])); ?></td>
                            <td><?php echo $row['weight']; ?> lbs</td>
                            <td>
                                <a href="edit_entry.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                                <a href="delete_entry.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this entry?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>
</html>
