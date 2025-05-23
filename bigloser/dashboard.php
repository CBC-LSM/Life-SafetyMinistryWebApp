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
$queryOrgCode = "SELECT organization_code FROM users WHERE id = '$userId'";
$resultOrgCode = $conn->query($queryOrgCode);

if ($resultOrgCode && $resultOrgCode->num_rows > 0) {
    $rowOrgCode = $resultOrgCode->fetch_assoc();
    $orgCode = $rowOrgCode['organization_code'];
}


$queryParticipants = "
    SELECT
        users.username,
        weight_entries.user_id,
        weight_entries.organization_code,
        MAX(weight_entries.weight) AS highest_weight,
        MIN(weight_entries.weight) AS lowest_weight,
        (SELECT weight FROM weight_entries WHERE user_id = users.id ORDER BY entry_date ASC LIMIT 1) AS initial_weight,
        (SELECT weight FROM weight_entries WHERE user_id = users.id ORDER BY entry_date DESC LIMIT 1) AS current_weight,
        (MIN(weight_entries.weight) - MAX(weight_entries.weight)) AS lbs_lost,
        ((MIN(weight_entries.weight) - MAX(weight_entries.weight)) / MIN(weight_entries.weight) * 100) AS percentage_lost
    FROM
        weight_entries
    JOIN
        users ON weight_entries.user_id = users.id
    WHERE
        users.organization_code = '{$orgCode}'
    GROUP BY
        weight_entries.user_id
    ORDER BY
        percentage_lost ASC,
        users.username ASC
";



$resultParticipants = $conn->query($queryParticipants);
// die(var_dump($resultParticipants));
// Check if there are any participants
if ($resultParticipants->num_rows > 0) {
    // Fetch each row using a while loop
    while ($row = $resultParticipants->fetch_assoc()) {
        // Check if the user_id matches
        if ($row['user_id'] == $userId) {
            // Found the matching user_id, you can access information here
            $initialWeight = $row['initial_weight'];
            $latestWeight = $row['current_weight'];
            $maxWeight = $row['highest_weight'];
            $lowWeight = $row['lowest_weight'];
            $lbsLost = $row['lbs_lost'];
            $percentageLost = $row['percentage_lost'];
            // Perform further actions or break the loop if needed
            break;
        }
    }
}

// Retrieve weight entries for the logged-in user
$queryEntries = "SELECT weight, entry_date FROM weight_entries WHERE user_id = '{$userId}' ORDER BY entry_date";

$resultEntries = $conn->query($queryEntries);

// Create arrays to store data for the line graph
$dates = [];
$weights = [];

while ($row = $resultEntries->fetch_assoc()) {
    $dates[] = date('Y-m-d', strtotime($row['entry_date'])); // Format date as 'YYYY-MM-DD'
    $weights[] = $row['weight'];
    }

if (isset($_POST['submit_weight'])) {
    // Process the submitted weight data
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
?>
<table class="stats_table">
        <tbody>
            <tr>
                    <div class="stats_container2">
                        <!-- <h2>Dashboard</h2> -->
                        <!-- <h3> Competitions Starts Jan. 22nd until April 1st </h3> -->
                        <!-- Display weight statistics -->
                        <h2>Your Stats!</h2>
                        <!-- <p> Competitions Starts 1/22/24 until April 1st </p> -->
                        <div class="weight-stats">
                            <p>Initial Weight: <?=$initialWeight; ?> lbs</p>
                            <p>Highest Weight: <?= $maxWeight; ?> lbs</p>
                            <p>Lowest Weight: <?=$lowWeight; ?> lbs</p>
                            <p>Current Weight: <?=$latestWeight; ?> lbs</p>
                            <p>
                                <?php
                                // Display Lbs Lost
                                if ($lbsLost >0) {
                                    echo 'Gained ' . abs($lbsLost) . ' lbs';
                                } else {
                                    echo 'Lost ' . abs($lbsLost) . ' lbs';
                                }
                                ?>
                            </p>
                            <p>
                                <?php
                                // Display Percentage of Weight Lost
                                if ($percentageLost > 0) {
                                    echo 'Gained ' . number_format(abs($percentageLost), 2) . '%';
                                } else {
                                    echo 'Lost ' . number_format(abs($percentageLost), 2) . '%';
                                }
                                ?>
                            </p>
                            <!-- Button to open the modal -->
                            <button class="submit-button" onclick="openWeightModal()">Add New Weight Entry</button>
                        </div>
                    </div>
            </tr>
            <tr>
                <div class="stats_container">
                    <div class="outline-box-with-margin">
                        <!-- Display line graph -->
                        <h2>Your Progress</h2>
                        <canvas id="weightChart" class="canvas-container"></canvas>

                        <!-- Include Chart.js version 2.x with all controllers -->
                        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>
                        <script>
                            var ctx = document.getElementById('weightChart').getContext('2d');
                            var weightChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: <?php echo json_encode($dates); ?>,
                                    datasets: [{
                                        label: 'Your Progress',
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
                                                text: 'Date',
                                                className: 'options-scales-x-title' // Apply the class for x-axis title
                                            }
                                        },
                                        y: {
                                            title: {
                                                display: true,
                                                text: 'Weight (lbs)',
                                                className: 'options-scales-y-title' // Apply the class for y-axis title
                                            }
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                    <div class="outline-box-with-margin">
                        <!-- Display horizontal bar graph for other participants -->
                        <h2>The Competition</h2>
                        <canvas id="participantsChart" class="canvas-container"></canvas>
                        <script>
                            var participantsCtx = document.getElementById('participantsChart').getContext('2d');

                            // Fetch data for other participants in the same organization
                            <?php
                            
                            $resultParticipants = $conn->query($queryParticipants);
                            if ($resultParticipants->num_rows > 0) {
                                // Fetch each row using a while loop
                                while ($row = $resultParticipants->fetch_assoc()) {
                                    // Access the ID of each participant
                                    $participantId = $row['user_id'];

                                    // list($initialWeight,$weights,$dates,$lbsLost,$percentageLost) = weightStats($participantId);
                                    if ($initialWeight>0){
                                        $participantUsernames[] = $row['username'];
                                        $participantLoss[] = round($row['percentage_lost'], 3);
                                    }
                                }
                            }
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
                </div>  
            </tr>
        </tbody>
    </table>
</div>
<!-- Add the modal structure at the end of your HTML -->
<div id="weightModal" class="entrymodal">
    <div class="modal-content">
        <span class="close" onclick="closeWeightModal()">&times;</span>
        <h2>Enter Weight</h2>
        <form method="post" action="">
            <label for="weight">Weight:</label>
            <input type="number" id="weight" name="weight" step="0.1" required>

            <label for="unit">Unit:</label>
            <select id="unit" name="unit">
                <option value="lbs">Pounds (lbs)</option>
                <option value="kg">Kilograms (kg)</option>
            </select>

            <button type="submit" name="submit_weight" class="submit-button">Submit Weight</button>
        </form>
    </div>
</div>
<!-- Add the JavaScript functions to open and close the modal -->
<script>
    function openWeightModal() {
        document.getElementById('weightModal').style.display = 'block';
    }

    function closeWeightModal() {
        document.getElementById('weightModal').style.display = 'none';
    }
</script>
