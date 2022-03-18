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

<div class="dashboard-box">
    <table class="dashboard_table">
        <thead class = "dashboard_table_head">
            <tr>
                <th class="header-text-left">Name</th>
                <th class="header-text-center">Position</th>
                <th class="header-text-center">Radio</th>
                <th class="header-text-center">DSM</th>
                <th class="header-text-center">Flashlight</th>
                <th class="header-text-center">Tourniquet</th>
                <th class="header-text-center">Utility Bag</th>
                <th class="header-text-center">Status</th>              
            </tr>
        </thead>
        <tbody class="dashboard_table_body">
            <?php foreach($teamStatus as $team):?>
                <tr>
                    <td class="body-text-left"><?php echo $team['membername']; ?></td>
                    <td class="body-text-center"><?php echo $team['radioname']; ?></td>
                    <td class="body-text-center"><?php echo $team['positionname']; ?></td>
                    <td class="body-text-center"><?php echo $team['dsmname']; ?></td>
                    <td class="body-text-center"><?php echo $team['flashlightname']; ?></td>
                    <td class="body-text-center"><?php echo $team['tourniquetname']; ?></td>
                    <td class="body-text-center"><?php echo $team['ubname']; ?></td>
                    <td class="body-text-center"><?php echo $team['status']; ?></td>
                </tr>
            <?php endforeach;?>     
        </tbody>
    </table>
</div>


<?php include 'pages/footer.php';?>