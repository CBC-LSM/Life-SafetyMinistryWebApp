<div id="SCadd_data_modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <h3 class="modal-title">Add Equipment Check Out</h4>
                </div>   
                <div class="modal-body">  
                     <form method="post" id="insert_form">
                            <div class="test_modal_body">
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
                          <br> 
                          <input type="submit" name="insert" id="insert" value="Submit" class="btn btn-success" /> 
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                          </div> 
                     </form> 
                </div>  
           </div>  
      </div>  
</div>