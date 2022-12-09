<?php
/**
 * includes/load.php
 *
 * @package default
 * @see index.php
 */
ob_start();
$pageName = "Users";
require_once '../database/load.php';
include '../pages/header.php';
$users = find_all_user();
$group_names = find_all_groups();
// die(var_dump($users));
// die(print_r($_SESSION['userLevel']));
if ($_SESSION['userLevel']!=1 && $_SESSION['userLevel']!=2 ) { redirect('/', false);}
?> 

<div class="panel-box">
    <?php echo display_msg($msg); ?>
    <button type="button" class="btn btn-primary btn-lg" id ="add" data-toggle="modal" data-target="#add_data_modal" VALIGN=MIDDLE>
        <span class="glyphicon glyphicon-plus-sign" style="color:#a0a0a0; font-size: 30px; vertical-align: middle; padding: 0px 10px 0px 0px;" aria-hidden="true"></span>
        <strong>Register Badge</strong>
    </button>
    <?php include '../rfid/registerRFID.php'; //This is what loads the modal for the RFID registration?>
    <div class="tableContainer">
    <table>
        <thead>
            <tr style ="color: #D4D4C9; font-size: 20px; font-family: Arial  ;">
                <th class="text-left" style="width: 5%;"><strong>Name</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Username</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Status</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Image</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Last Login</strong></th>
                <th class="text-center" style="width: 5%;"><strong>User Level</strong></th>
                <th class="text-center" style="width: 5%;"><strong>RFID Active</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Last RFID Scan</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Modify</strong></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user):
                // die(var_dump($user));
                if ($user['status'] == 1){
                    $status = "Active";
                }
                else{
                    $status = "Not Active";
                }
            ?>
                <tr style ="color: #D4D4C9; font-size: 100%; background-color:#1E1E1E;">
                    <td class="text-left"><div class="mobile-only"><strong>Name</strong></div><strong><?php echo $user['name']; ?></strong></td>
                    <td><div class="mobile-only"><strong>Username</strong></div><?php echo $user['username']; ?></td>
                    <td><div class="mobile-only"><strong>Status</strong></div><?php echo $status; ?></td>
                    <td><?php if($user['img']!=""){$type = "success";}else{$type = "warning";}?>
                        <button type="button" class="btn btn-<?=$type;?> btn-xs" id ="picture" data-toggle="modal" value = '<?=$user['id'];?>' data-target="#picture_modal<?=$user['id'];?>" VALIGN=MIDDLE>
                        <span class="glyphicon glyphicon-picture"></span></button></td>
                    <td><div class="mobile-only"><strong>Last Login</strong></div><?php echo $user['last_login']; ?></td>
                    <td><div class="mobile-only"><strong>User Level</strong></div><?php echo $user['group_name']; ?></td>
                    <td><div class="mobile-only"><strong>RFID Active</strong></div><?php if ($user['RFIDtag'] >0){echo "Found";}else{echo "none";} ?></td>
                    <td><div class="mobile-only"><strong>Last RFID Scan</strong></div><?php echo $user['lastrfidscan']; ?></td>
                    <td><div class="mobile-only"><strong>Modify</strong></div>
                        <?php if($_SESSION['userLevel']==1):?>
                            <a href="/features/delete_user.php?id=<?php echo $user['id'];?>"onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-xs"  
                            title="Delete Entry" data-toggle="tooltip"><span class="glyphicon glyphicon-remove"></span>
                            </a>
                            <button type="button" class="btn btn-warning btn-xs" id ="edit" title="Edit Password" value = "<?php echo $user['id'];?>" onClick="<?php echo $user['id']?>" 
                                data-toggle="modal" data-target="#edit_password_modal<?=$user['id'];?>" VALIGN=MIDDLE><span class="glyphicon glyphicon-pencil"></button>

                                <button type="button" class="btn btn-warning btn-xs" id ="edit" title="Edit User" value = "<?php echo $user['id'];?>" onClick="<?php echo $user['id']?>" 
                                data-toggle="modal" data-target="#edit_user_modal<?=$user['id'];?>" VALIGN=MIDDLE><span class="glyphicon glyphicon-edit"></button>
                            </td>
                        <?php endif;?>
                    <?php include '../users/userpicmodal.php'; ?>    
                    <?php include '../users/edit_user_modal.php'; ?>
            <?php include '../users/edit_password_modal.php'; ?>
                    </tr>
            <?php endforeach;?>     
        </tbody>
    </table>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- jQuery UI library -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
