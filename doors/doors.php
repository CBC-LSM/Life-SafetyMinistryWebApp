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
$doorschedules =finddoorschedule();
// $users = find_all_user();
// $group_names = find_all_groups();
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
            <?php foreach($doorschedules as $doorschedule):;?>
                <tr style ="color: #D4D4C9; font-size: 100%; background-color:#1E1E1E;">
                    <td class="text-left"><div class="mobile-only"><strong>Door</strong></div><strong><?php echo $doorschedule['doorName']; ?></strong></td>
                    <?php 
                    $schedule = ucwords($doorschedule['startday'])." ".date("H:i",strtotime($doorschedule['starttime']));
                    $schedule .=" - ".ucwords($doorschedule['endday'])." ".date("H:i",strtotime($doorschedule['endtime']));
                    ?>
                    <td><div class="mobile-only"><strong>Schedule</strong></div><?php echo $schedule; ?></td>
                    <td><div class="mobile-only"><strong>Action</strong></div><?php echo ucwords($doorschedule['action']); ?></td>
                    <td><div class="mobile-only"><strong>Modify</strong></div>
                        <a href="/doors/deletedoorschedule.php?id=<?php echo $doorschedule['id'];?>"onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-xs"  
                        title="Delete" data-toggle="tooltip"><span class="glyphicon glyphicon-remove"></span>
                        </a>

                        <button type="button" class="btn btn-warning btn-xs" id ="edit" title="Edit" value = "<?php echo $user['id'];?>" onClick="<?php echo $user['id']?>" 
                        data-toggle="modal" data-target="#edit_schedule<?=$doorschedule['id'];?>" VALIGN=MIDDLE><span class="glyphicon glyphicon-pencil"></button>
                    </td>
                    <?php include '../doors/editdoorschedulemodal.php'; ?>
                </tr>
                    <!-- need to finish adding the modification modal and delete icon. This needs to be completed soon. -->
                    <!-- Add information here regarding the schedules for the doors   -->

            <?php endforeach;?>
        </tbody>
    </table>
    </div>
</div>
<script>
$(document).ready(function() {
	$('#register').on('click', function() {
		var id = $('#getUID').val();
		var name = $('#name').val();
        event.preventDefault();
            if($('#getUID').val() ==''){alert("Must scan badge before entering");}
            else if ($('#name').val()==''){alert("Must select name");}
            else{
                $.ajax({
                    url: "../rfid/insert.php",
                    type: "POST",
                    data: {
                        id: id,
                        name: name			
                    },
                    beforeSend:function(){  
                                $('#register').val("registering");},
                    success: function(dataResult){
                            var dataResult = dataResult;
                            let baseURL = "";
                            let newURL = baseURL.concat(dataResult);
                            window.location.replace(newURL);
                            }
                });
            }
	})
});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- jQuery UI library -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
