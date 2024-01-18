<?php
// require_once('check_login.php');
session_start();
$pagetitle = "Dashboard";
require_once('db_connection.php');
include('header.php');

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

function weightStats($id){
    global $conn;
    // Retrieve weight entries for the logged-in user
    $queryEntries = "SELECT weight, entry_date FROM weight_entries WHERE user_id = '{$id}' ORDER BY entry_date";

    $resultEntries = $conn->query($queryEntries);

    // Create arrays to store data for the line graph
    $dates = [];
    $weights = [];

    while ($row = $resultEntries->fetch_assoc()) {
        $dates[] = date('Y-m-d', strtotime($row['entry_date'])); // Format date as 'YYYY-MM-DD'
        $weights[] = $row['weight'];
    }

    // Calculate Initial Weight
    $initialWeight = reset($weights);
    
    // Calculate Lbs Lost and Percentage of Weight Lost
    $lbsLost = $weights[0] - end($weights);
    $percentageLost = ($lbsLost / $weights[0]) * 100;
    // die($initialWeight);
    return [$initialWeight,$weights,$dates,$lbsLost,$percentageLost];
}

list($initialWeight,$weights,$dates,$lbsLost,$percentageLost) = weightStats($userId);

?>

<!DOCTYPE html>
<html lang="en">

<body>
    <div class="container">
        <h2>Dashboard</h2>
        <h3> Competitions Starts Jan. 22nd until April 1st </h3>
        <!-- Display weight statistics -->
        <h3>Your Stats!</h3>
        <!-- <p> Competitions Starts 1/22/24 until April 1st </p> -->
        <div class="weight-stats">
    <p>Initial Weight: <?php echo $initialWeight; ?> lbs</p>
    <p>Highest Weight: <?php echo max($weights); ?> lbs</p>
    <p>Lowest Weight: <?php echo min($weights); ?> lbs</p>
    <p>Current Weight: <?php echo end($weights); ?> lbs</p>
    <p>
        <?php
        // Display Lbs Lost
        if ($lbsLost < 0) {
            echo 'Gained ' . abs($lbsLost) . ' lbs';
        } else {
            echo 'Lost ' . $lbsLost . ' lbs';
        }
        ?>
    </p>
    <p>
        <?php
        // Display Percentage of Weight Lost
        if ($percentageLost < 0) {
            echo 'Gained ' . number_format(abs($percentageLost), 2) . '%';
        } else {
            echo 'Lost ' . number_format($percentageLost, 2) . '%';
        }
        ?>
    </p>
</div>


        <!-- Display line graph -->
        <h3>The Timeline</h3>
        <canvas id="weightChart" width="800" height="400"></canvas>

        <!-- Include Chart.js version 2.x with all controllers -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>



        <script>
            var ctx = document.getElementById('weightChart').getContext('2d');
            var weightChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($dates); ?>,
                    datasets: [{
                        label: 'Weight Progress',
                        data: <?php echo json_encode($weights); ?>,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        x: {
                            type: 'category', // Use category type for string labels
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Weight (lbs)'
                            }
                        }
                    }
                }
            });
        </script>

        <!-- Display horizontal bar graph for other participants -->
        <h3>The Competition</h3>
        <canvas id="participantsChart" width="800" height="400"></canvas>

        <script>
            var participantsCtx = document.getElementById('participantsChart').getContext('2d');

            // Fetch data for other participants in the same organization
            <?php
            $orgCode = ''; // Placeholder for organization code
            $participantUsernames = []; // Placeholder for username
            $participantLoss = [];// Placeholder for percentage loss
            // echo "Yo      ";
            // Retrieve the organization code of the logged-in user
            $queryOrgCode = "SELECT organization_code FROM users WHERE id = '$userId'";
            $resultOrgCode = $conn->query($queryOrgCode);

            if ($resultOrgCode && $resultOrgCode->num_rows > 0) {
                $rowOrgCode = $resultOrgCode->fetch_assoc();
                $orgCode = $rowOrgCode['organization_code'];
            }

            // Fetch data for other participants in the same organization
            $queryParticipants = "SELECT users.id,users.username FROM users WHERE users.organization_code = '$orgCode'";
            $resultParticipants = $conn->query($queryParticipants);
            // Check if there are any participants
            
            if ($resultParticipants->num_rows > 0) {
                // Fetch each row using a while loop
                while ($row = $resultParticipants->fetch_assoc()) {
                    // Access the ID of each participant
                    $participantId = $row['id'];

                    list($initialWeight,$weights,$dates,$lbsLost,$percentageLost) = weightStats($participantId);
                    if ($initialWeight>0){
                        $participantUsernames[] = $row['username'];
                        $participantLoss[] = $percentageLost;
                    }
                }
            }

            // while ($rowParticipant = $resultParticipants->fetch_assoc()) {
            //     $participantUsernames[] = $rowParticipant['username'];
            //     $participantWeights[] = $rowParticipant['weight'];
            // }
            ?>

            var participantsChart = new Chart(participantsCtx, {
                type: 'horizontalBar',
                data: {
                    labels: <?php echo json_encode($participantUsernames); ?>,
                    datasets: [{
                        label: 'Percentage of Weight Lost',
                        data: <?php echo json_encode($participantLoss); ?>,
                        backgroundColor: 'rgba(75, 192, 192, 0.8)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Percentage of Weight Lost'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Participants'
                            }
                        }
                    }
                }
            });
        </script>

    </div>
</body>

</html>
