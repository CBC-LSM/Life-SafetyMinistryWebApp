<?php
/**
 * includes/load.php
 *
 * @package default
 * @see index.php
 */
ob_start();
$pageName = "Door Schedule";
require_once '../database/load.php';
include '../pages/header.php';
$doors = findalldoors();
$users = find_all_user();
$group_names = find_all_groups();
// die(var_dump($users));
if ($_SESSION['userLevel']!=1) { redirect('/', false);}
?> 

<div class="panel-box">
    <?php echo display_msg($msg); ?>
    <button type="button" class="btn btn-primary btn-lg" id ="add" data-toggle="modal" data-target="#add_to_schedule" VALIGN=MIDDLE>
        <span class="glyphicon glyphicon-plus-sign" style="color:#a0a0a0; font-size: 30px; vertical-align: middle; padding: 0px 10px 0px 0px;" aria-hidden="true"></span>
        <strong>Add Door Schedule</strong>
    </button>
    <?php include '../doors/doorschedulesetup.php'; ?>
    <div class="tableContainer">
    <table>
        <thead>
            <tr style ="color: #D4D4C9; font-size: 20px; font-family: Arial  ;">
                <th class="text-left" style="width: 5%;"><strong>Door</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Schedule</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Action</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Modify</strong></th>
            </tr>
        </thead>
        <tbody>
            <!-- Add information here regarding the schedules for the doors   -->
        </tbody>
    </table>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- jQuery UI library -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
