<?php
/**
 * includes/load.php
 *
 * @package default
 * @see index.php
 */
require_once '../database/load.php';
include '../pages/header.php';
$users = find_all_user();
$group_names = find_all_groups();
if (!$session->isUserLoggedIn()) { redirect('/', false);}


?>
<div class="panel-box">
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

<div id="add_data_modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <h3 class="modal-title">Add Equipment Check Out</h4>
                </div>   
                <div class="modal-body">  
                     <form method="post" id="insert_form">
                            <div class="test_modal_body">
                            <!-- <label for="Name-Choice">Name</label>
                            <input type="text" name="search" id="search" placeholder="search here...." class="form-control">   -->
                            <!-- <br> -->
                            <label for="Name-Choice">Name</label>
                            <input list="names" name="Name-Choice" id= "Name-Choice" class="form-control" placeholder="Name"/>
                                <datalist id="names">
                                <?php  foreach ($AllNames as $name): ?>
                                        <option value="<?php echo $name['membername']; ?>" >
                                    <?php endforeach; ?>
                                </datalist>
                            <br>
                          <label>Position</label> 
                          <select class="form-control" name="position" id="position">
                              <option value="">Position</option>
                                <?php  foreach ($allPositions as $position): ?>
                                    <option value="<?php echo $position['positionname']; ?>" >
                                        <?php echo $position['positionname']; ?></option>
                                <?php endforeach; ?>
                          </select>  
                          <br>
                          <label>Radio</label> 
                          <select class="form-control" name="radio" id="radio">
                              <option value="">Radio</option>
                                   <?php  foreach ($allRadios as $radio):
                                        if ($radio['status']=="Checked In"):?>
                                            <option value="<?php echo $radio['radioname']; ?>" >
                                            <?php echo $radio['radioname']; ?></option>
                                        <?php else:?>
                                        <?php endif;?>  
                                    <?php endforeach; ?>
                          </select>  
                          <br>   
                          <label>DSM</label>  
                          <select class="form-control" name="dsm" id="dsm">
                              <option value="">DSM</option>
                              <?php  foreach ($allDSMs as $DSM):
                                        if ($DSM['status']=="Checked In"):?>
                                            <option value="<?php echo $DSM['dsmname']; ?>" >
                                            <?php echo $DSM['dsmname']; ?></option>
                                        <?php else:?>
                                        <?php endif;?>  
                                    <?php endforeach; ?>
                          </select>
                          <br>   
                          <label>Flashlight</label> 
                            <select class ="form-control" name="flashlight" id="flashlight">
                                <option value="">Flashlight</option>
                                <?php  foreach ($allFlashlights as $flashlight):
                                    if ($flashlight['status']=="Checked In"):?>
                                        <option value="<?php echo $flashlight['flashlightname']; ?>" >
                                        <?php echo $flashlight['flashlightname']; ?></option>
                                    <?php else:?>
                                    <?php endif;?>  
                                <?php endforeach; ?>
                            </select>
                          <br>
                          <label>Tourniquet</label> 
                            <select class ="form-control" name="tourniquet" id="tourniquet">
                                <option value="">Tourniquet</option>
                                <?php  foreach ($allTourniquets as $tourniquet):
                                    if ($tourniquet['status']=="Checked In"):?>
                                        <option value="<?php echo $tourniquet['tourniquetname']; ?>" >
                                        <?php echo $tourniquet['tourniquetname']; ?></option>
                                    <?php else:?>
                                    <?php endif;?>  
                                <?php endforeach; ?>
                            </select>
                          <br>
                          <label>Utility Bag</label> 
                            <select class ="form-control" name="utility_bag" id="utility_bag">
                                <option value="">Utility Bag</option>
                                <?php  foreach ($allUtilityBags as $bag):
                                    if ($bag['status']=="Checked In"):?>
                                        <option value="<?php echo $bag['ubname']; ?>" >
                                        <?php echo $bag['ubname']; ?></option>
                                    <?php else:?>
                                    <?php endif;?>  
                                <?php endforeach; ?>
                            </select>
                          <br> 
                          <input type="submit" name="insert" id="insert" value="Submit" class="btn btn-success" /> 
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                          </div> 
                     </form> 
                </div>  
           </div>  
      </div>  
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- jQuery UI library -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
