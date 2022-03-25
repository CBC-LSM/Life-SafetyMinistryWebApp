<div id="edit_password_modal<?=$user['id'];?>" class="modal fade"> 
                            <div class="panel-modal">
                                <div class="modal-dialog">  
                                    <div class="modal-content">  
                                        <div class="modal-header">  
                                            <h3 class="modal-title">Edit Password</h3>
                                            <h3 class="modal-title">ID: <?=$user['id'];?></h3>
                                        </div>   
                                        <div class="modal-body">  
                                            <!-- <form method="post" id="edit_form" > -->
                                            <form method="post" action="../features/edit.php">
                                                    <div class="form-group">
                                                            <label for="password" class="control-label">Password</label>
                                                            <input type="password" class="form-control" name="name" Placeholder = "Password">
                                                    </div>
                                                    <div class="form-group">
                                                            <label for="password_confirm" class="control-label">Confirm Password</label>
                                                            <input type="password_confirm" class="form-control" name="name" Placeholder="Confirm Password">
                                                    </div>
                                                <input type="hidden" name="id" id="id" value="<?=$user['id'];?>" />
                                                <input type="submit" name="edit_insert" id="edit_insert<?=$user['id'];?>" value="Change" class="btn btn-success" /> 
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  
                                            </form> 
                                        </div>  
                                    </div>  
                                </div>  
                            </div>
                        </div>