<div id="edit_user_modal<?=$user['id'];?>" class="modal fade"> 
                            <div class="panel-modal">
                                <div class="modal-dialog">  
                                    <div class="modal-content">  
                                        <div class="modal-header">  
                                            <h3 class="modal-title">Edit Account</h3>
                                            <h3 class="modal-title">ID: <?=$user['id'];?></h3>
                                        </div>   
                                        <div class="modal-body">  
                                            <!-- <form method="post" id="edit_form" > -->
                                            <form method="post" action="../features/edit.php">
                                                    <div class="form-group">
                                                            <label for="name" class="control-label">Name</label>
                                                            <input type="name" class="form-control" name="name" value="<?php echo ucwords($user['name']); ?>">
                                                    </div>
                                                    <div class="form-group">
                                                            <label for="name" class="control-label">Username</label>
                                                            <input type="name" class="form-control" name="name" value="<?php echo $user['username']; ?>">
                                                    </div>
                                                    <label>Status</label> 
                                                    <select class="form-control" name="position" id="edit_position" value = "<?php echo $status; ?>">
                                                        <!-- <option value="<?php echo $status; ?>"><?=$status;?></option> -->
                                                        <option value="Active">Active</option>
                                                        <option value="Not Active">Not Active</option>

                                                    </select> 
                                                    <br>
                                                    <label>User Level</label> 
                                                    <select class="form-control" name="position" id="edit_position">
                                                        <option value="<?php echo $user['group_name']; ?>"><?=$user['group_name'];?></option>
                                                            <?php  foreach ($group_names as $group_name): ?>
                                                                <option value="<?php echo $group_name['group_name']; ?>" >
                                                                    <?php echo $group_name['group_name']; ?></option>
                                                            <?php endforeach; ?>
                                                    </select>  
                                                    <br>
                                                <input type="hidden" name="id" id="id" value="<?=$user['id'];?>" />
                                                <input type="submit" name="edit_insert" id="edit_insert<?=$user['id'];?>" value="Change" class="btn btn-success" /> 
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  
                                            </form> 
                                        </div>  
                                    </div>  
                                </div>  
                            </div>
                        </div>