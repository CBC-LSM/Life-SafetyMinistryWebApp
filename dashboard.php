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
$allcheckouts = findallwithoutdate();
foreach($allcheckouts as $checkout){
    if ($checkout['status']=="Checked Out" && $checkout['checkout']<=$date1){
        $checkintime   = date('Y-m-d H:i:s');
        checkIn($checkout['id'],$checkintime);
    }
}

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
                    <td class="text-left"><strong><p><?php echo $team['membername']; ?></p></strong></td>
                    <td><p><?php echo $team['positionname']; ?></p></td>
                    <td><p><?php echo $team['radioname']; ?></p></td>
                    <td><p><?php echo $team['dsmname']; ?></p></td>
                    <td><p><?php echo $team['flashlightname']; ?></p></td>
                    <td><p><?php echo $team['tourniquetname']; ?></p></td>
                    <td><p><?php echo $team['ubname']; ?></p></td>
                    <td><p><?php echo $team['status']; ?></p></td>
                </tr>
            <?php endforeach;?>     
        </tbody>
    </table>
</div>


<?php include 'pages/footer.php';?>