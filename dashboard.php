<?php
/**
 * includes/load.php
 *
 * @package default
 * @see index.php
 */


$pageName = "Dashboard";
require_once 'database/load.php';
include 'pages/dashboardHeader.php';
$AllNames = findAllnames();
$allRadios = findAllRadios();
$allDSMs = findAllDSMs();
$allFlashlights = findAllflashlights();
$allTourniquets = findAllTourniquets();
$allUtilityBags = findAllUtilityBags();
$allPositions = findAllPositions();

$date1 = date('Y-m-d')." 00:00:00";
$date2 = date('Y-m-d')." 23:59:00";
$teamStatus = findAllTeamStatus($date1,$date2);

$checkouttime   = date('Y-m-d H:i:s');

?>
<body style="background-color:#1E1E1E"></body>

<div class="dashboard-box">
    <!-- <div style ="color: #D4D4C9;"><?=$checkouttime."<br>"; echo $date1."<br>";echo $date2."<br>";?></div> -->
    <table>
        <thead>
            <tr style ="color: #D4D4C9; font-family: Arial  ;">
                <th class="text-left" style="width: 5%;"><strong><h2>Name</h2></strong></th>
                <th class="text-center" style="width: 5%;"><strong><h2>Position</h2></strong></th>
                <th class="text-center" style="width: 5%;"><strong><h2>Radio</h2></strong></th>
                <th class="text-center" style="width: 5%;"><strong><h2>DSM</h2></strong></th>
                <th class="text-center" style="width: 5%;"><strong><h2>Flashlight</h2></strong></th>
                <th class="text-center" style="width: 5%;"><strong><h2>Tourniquet</h2></strong></th>
                <th class="text-center" style="width: 5%;"><strong><h2>Utility Bag</h2></strong></th>
                <th class="text-center" style="width: 5%;"><strong><h2>Status</h2></strong></th>              
            </tr>
        </thead>
        <tbody>
            <?php foreach($teamStatus as $team):?>
                <tr style ="color: #D4D4C9; background-color:#1E1E1E;">
                    <td class="text-left"><strong><h3><?php echo $team['membername']; ?></h3></strong></td>
                    <td><h3><?php echo $team['positionname']; ?></h3></td>
                    <td><h3><?php echo $team['radioname']; ?></h3></td>
                    <td><h3><?php echo $team['dsmname']; ?></h3></td>
                    <td><h3><?php echo $team['flashlightname']; ?></h3></td>
                    <td><h3><?php echo $team['tourniquetname']; ?></h3></td>
                    <td><h3><?php echo $team['ubname']; ?></h3></td>
                    <td><h3><?php echo $team['status']; ?></h3></td>
                </tr>
            <?php endforeach;?>     
        </tbody>
    </table>
</div>


<?php include 'pages/footer.php';?>