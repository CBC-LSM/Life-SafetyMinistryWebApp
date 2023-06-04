<div id="SCedit_data_modal<?=$team['id'];?>" class="modal fade"> 
    <div class="panel-modal">
        <div class="modal-dialog">  
            <div class="modal-content">  
                <div class="modal-header">  
                    <h3 class="modal-title">Edit Equipment Check Out</h3>
                </div>   
                <div class="modal-body">  
                    <!-- <form method="post" id="edit_form" > -->
                    <form method="post" action="edit.php">
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