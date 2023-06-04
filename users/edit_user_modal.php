<div id="edit_user_modal<?=$user['id'];?>" class="modal fade"> 
                            <div class="panel-modal">
                                <div class="modal-dialog">  
                                    <div class="modal-content">  
                                        <div class="modal-header">  
                                            <h3 class="modal-title">Edit Account</h3>
                                            <?php if ($_SESSION['userLevel'] ==1){
                                                $userstatus = "";
                                            }else{
                                                $userstatus = "disabled";
                                            }
                                            $url = $_SERVER['REQUEST_URI'];
                                            if ($url != "/users/user.php"){
                                                $redirectURL="../users/users.php";
                                            }else{
                                                $redirectURL="/";
                                            }                                            
                                            ?>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <img class="img-circle img-size-2" src="../images/users/<?php echo $user['img'];?>" alt="">
                                                </div>
                                                <div class="col-md-8">
                                                    <form class="form" action="../users/edit_user_picture.php" method="POST" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <input type="file" name="file_upload" multiple="multiple" class="btn btn-default btn-file"/>
                                                        </div>
                                                        <div class="form-group">
                                                         <input type="hidden" name="id" id="id" value="<?=$user['id'];?>" />
                                                            <button type="submit" name="submit" class="btn btn-warning">Change</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <!-- <form method="post" id="edit_form" > -->
                                            <form method="post" action="../users/updateAccount.php">
                                                    <div class="form-group">
                                                            <label for="name" class="control-label">Name</label>
                                                            <input type="name" class="form-control" name="name" value="<?php echo ucwords($user['name']); ?>">
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                            <label for="username" class="control-label">Username</label>
                                                            <input type="username" class="form-control" name="username" value="<?php echo $user['username']; ?>">
                                                    </div>
                                                    <label>Status</label> 
                                                    <select class="form-control" name="status" id="status" value = "<?php echo $status; ?>">
                                                        <!-- <option value="<?php echo $status; ?>"><?=$status;?></option> -->
                                                        <option value="1">Active</option>
                                                        <option value="0">Not Active</option>

                                                    </select> 
                                                    <br>
                                                    <label>User Level</label> 
                                                    <select class="form-control" name="userlevel" id="userlevel" <?=$userstatus;?>>
                                                        <option value="<?php echo $user['group_level']; ?>"><?=$user['group_name'];?></option>
                                                            <?php  foreach ($group_names as $group_name): ?>
                                                                <option value="<?php echo $group_name['group_level']; ?>" >
                                                                    <?php echo $group_name['group_name']; ?></option>
                                                            <?php endforeach; ?>
                                                    </select>  
                                                    <br>
                                                <input type="hidden" name="id" id="id" value="<?=$user['id'];?>" />
                                                <input type="hidden" name="redirect" id="redirect" value="<?=$redirectURL;?>" />
                                                <input type="submit" name="edit_insert" id="edit_insert<?=$user['id'];?>" value="Change" class="btn btn-success" /> 
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  
                                            </form> 
                                        </div>  
                                    </div>  
                                </div>  
                            </div>
                        </div>
