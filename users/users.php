<?php
/**
 * includes/load.php
 *
 * @package default
 * @see index.php
 */
ob_start();
$page_name = "Users";
require_once '../database/load.php';
include '../pages/header.php';
$users = find_all_user();
$group_names = find_all_groups();
// die(var_dump($users));
if ($_SESSION['userLevel']!=1) { redirect('/', false);}
?> 

<div class="panel-box">
    <?php echo display_msg($msg); ?>
    <div class="tableContainer">
    <table>
        <thead>
            <tr style ="color: #D4D4C9; font-size: 20px; font-family: Arial  ;">
                <th class="text-left" style="width: 5%;"><strong>Name</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Username</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Status</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Last Login</strong></th>
                <th class="text-center" style="width: 5%;"><strong>User Level</strong></th>
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
                    <td><div class="mobile-only"><strong>Last Login</strong></div><?php echo $user['last_login']; ?></td>
                    <td><div class="mobile-only"><strong>User Level</strong></div><?php echo $user['group_name']; ?></td>
                    <td><div class="mobile-only"><strong>Modify</strong></div>
                        <a href="/features/delete.php?id=<?php echo $user['id'];?>"onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-xs"  
                        title="Delete Entry" data-toggle="tooltip"><span class="glyphicon glyphicon-remove"></span>
                        </a>
                        <button type="button" class="btn btn-warning btn-xs" id ="edit" title="Edit Password" value = "<?php echo $user['id'];?>" onClick="<?php echo $user['id']?>" 
                        data-toggle="modal" data-target="#edit_password_modal<?=$user['id'];?>" VALIGN=MIDDLE><span class="glyphicon glyphicon-pencil"></button>

                        <button type="button" class="btn btn-warning btn-xs" id ="edit" title="Edit User" value = "<?php echo $user['id'];?>" onClick="<?php echo $user['id']?>" 
                        data-toggle="modal" data-target="#edit_user_modal<?=$user['id'];?>" VALIGN=MIDDLE><span class="glyphicon glyphicon-edit"></button>
                    </td>
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
