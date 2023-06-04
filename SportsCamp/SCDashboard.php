<?php


$pageName = "Sports Camp Dashboard";
require_once '../database/load.php';
include '../pages/dashboardHeader.php';
require_once 'scSql.php';

$AllNames = findAllSCnames();
$allRadios = findAllSCRadios();
$allPositions = findAllSCPositions();

$date1 = date('Y-m-d')." 00:00:00";
$date2 = date('Y-m-d')." 23:59:00";

$teamStatus = findAllSCTeamStatus($date1,$date2);

$checkouttime   = date('Y-m-d H:i:s');

?>

<div class="dashboard-box">
    <table class="dashboard_table">
        <thead class = "dashboard_table_head">
            <tr>
                <th class="header-text-left">Name</th>
                <th class="header-text-center">Position</th>
                <th class="header-text-center">Radio</th>
                <th class="header-text-center">Status</th>              
            </tr>
        </thead>
        <tbody class="dashboard_table_body">
            <?php foreach($teamStatus as $team):?>
                <tr>
                    <td class="body-text-left"><?php echo $team['membername']; ?></td>
                    <td class="body-text-center"><?php echo $team['positionname']; ?></td>
                    <td class="body-text-center"><?php echo $team['radioname']; ?></td>
                    <td class="body-text-center"><?php 
                    if ($team['status'] == "Checked Out"):?>
                        <div class="btn btn-warning">Checked Out</div>
                    <?php else:?>
                        <div class="btn btn-success">Checked In</div>
                    <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach;?>     
        </tbody>
    </table>
</div>


<?php include 'pages/footer.php';?>