<?php
/**
 * includes/load.php
 *
 * @package default
 * @see index.php
 */
ob_start();
$pageName = "Access Log";
require_once '../database/load.php';
include '../pages/header.php';
$logs = findallrfidlogs();
// die(var_dump($logs));
if ($_SESSION['userLevel']!=1) { redirect('/', false);}
?> 

<div class="panel-box">
    <?php echo display_msg($msg); ?>
    <div class="tableContainer">
    <table>
        <thead>
            <tr style ="color: #D4D4C9; font-size: 20px; font-family: Arial  ;">
                <th class="text-left" style="width: 5%;"><strong>Name</strong></th>
                <th class="text-center" style="width: 5%;"><strong>RFID Tag</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Door Name</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Status</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Time Stamp</strong></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($logs as $log):?>
                <tr style ="color: #D4D4C9; font-size: 100%; background-color:#1E1E1E;">
                    <td class="text-left"><div class="mobile-only"><strong>Name</strong></div><strong><?php if(empty($log['name'])){echo "USER NOT FOUND";}else{echo $log['name'];} ?></strong></td>
                    <td><div class="mobile-only"><strong>RFID Tag</strong></div><?php echo $log['tagid']; ?></td>
                    <td><div class="mobile-only"><strong>Door Name</strong></div><?php echo $log['doorName']; ?></td>
                    <td><div class="mobile-only"><strong>Status</strong></div><?php echo $log['Status']; ?></td>
                    <td><div class="mobile-only"><strong>Time Stamp</strong></div><?php echo $log['timestamp']; ?></td>
            <?php endforeach;?>     
        </tbody>
    </table>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- jQuery UI library -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
