<!-- referenced in loggedgear.php -->
<div id="edit_data_modal<?=$team['id'];?>" class="modal fade"> 
                            <div class="panel-modal">
                                <div class="modal-dialog">  
                                    <div class="modal-content">  
                                        <div class="modal-header">  
                                            <h3 class="modal-title">Edit Equipment Check Out</h3>
                                        </div>   
                                        <div class="modal-body">  
                                            <!-- <form method="post" id="edit_form" > -->
                                            <form method="post" action="../features/edit.php">
                                                    <label for="Edit-Name-Choice">Name</label>
                                                    <input list="edit-names" name="Edit-Name-Choice" id= "Edit-Name-Choice" class="form-control" value ="<?=$team['membername'];?> " placeholder="<?=$team['membername'];?>"/>
                                                        <datalist id="edit-names">
                                                        <!-- <option value = "<?php echo $name['membername']; ?>"></option> -->
                                                        <?php  foreach ($AllNames as $name): ?>
                                                                <option value="<?php echo $name['membername']; ?>" ></option>
                                                            <?php endforeach; ?>
                                                        </datalist>
                                                    <br>
                                                    <label>Position</label> 
                                                    <select class="form-control" name="position" id="edit_position">
                                                        <option value="<?php echo $team['positionID']; ?>"><?=$team['positionname'];?></option>
                                                            <?php  foreach ($allPositions as $position): ?>
                                                                <option value="<?php echo $position['positionname']; ?>" >
                                                                    <?php echo $position['positionname']; ?></option>
                                                            <?php endforeach; ?>
                                                    </select>  
                                                    <br>
                                                    <label class="text-left">Radio</label> 
                                                    <select class="form-control" name="radio" id="edit_radio">
                                                        <option value="<?php echo $team['radioID']; ?>"><?php echo $team['radioname']; ?></option>
                                                            <?php  foreach ($allRadios as $radio):?>
                                                                        <option value="<?php echo $radio['radioname']; ?>" >
                                                                        <?php echo $radio['radioname']; ?></option>
                                                                <?php endforeach; ?>
                                                    </select>  
                                                    <br>   
                                                    <!-- <label>DSM</label>  
                                                    <select class="form-control" name="dsm" id="edit_dsm">
                                                        <option value="<?php echo $team['dsmID']; ?>"><?php echo $team['dsmname']; ?></option>
                                                        <?php  foreach ($allDSMs as $DSM):?>
                                                                        <option value="<?php echo $DSM['dsmname']; ?>" >
                                                                        <?php echo $DSM['dsmname']; ?></option>
                                                                <?php endforeach; ?>
                                                    </select>
                                                    <br>   
                                                    <label>Flashlight</label> 
                                                        <select class ="form-control" name="flashlight" id="edit_flashlight">
                                                            <option value="<?php echo $team['flashlightID']; ?>"><?php echo $team['flashlightname']; ?></option>
                                                            <?php  foreach ($allFlashlights as $flashlight):?>
                                                                    <option value="<?php echo $flashlight['flashlightname']; ?>" >
                                                                    <?php echo $flashlight['flashlightname']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    <br>
                                                    <label>Tourniquet</label> 
                                                        <select class ="form-control" name="tourniquet" id="edit_tourniquet">
                                                            <option value="<?php echo $team['tourniquetID']; ?>"><?php echo $team['tourniquetname']; ?></option>
                                                            <?php  foreach ($allTourniquets as $tourniquet):?>
                                                                    <option value="<?php echo $tourniquet['tourniquetname']; ?>" >
                                                                    <?php echo $tourniquet['tourniquetname']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    <br> -->
                                                    <label>Utility Bag</label> 
                                                        <select class ="form-control" name="utility_bag" id="edit_utility_bag">
                                                            <option value="<?php echo $team['ubID']; ?>"><?php echo $team['ubname']; ?></option>
                                                            <?php  foreach ($allUtilityBags as $bag):?>
                                                                    <option value="<?php echo $bag['ubname']; ?>" >
                                                                    <?php echo $bag['ubname']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    <br>
                                                <input type="hidden" name="id" id="id" value="<?=$team['id'];?>" />
                                                <input type="submit" name="edit_insert" id="edit_insert<?=$team['id'];?>" value="Change" class="btn btn-success" /> 
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  
                                            </form> 
                                        </div>  
                                    </div>  
                                </div>  
                            </div>
                        </div>