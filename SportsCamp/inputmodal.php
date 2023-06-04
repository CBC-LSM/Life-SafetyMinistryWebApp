<?php
?>
<div id="add_data_modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <h4 class="modal-title">Add Equipment Check Out</h4>
                </div>   
                <div class="modal-body">  
                     <form method="post" id="insert_form">  
                            <label>Name<input list="name" name="myBrowser"class="form-control" placeholder="Name"/></label>
                                <datalist id="name">
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
                          <input type="hidden" name="order_id" id="order_id" value="<?=$orderID;?>" />  
                          <input type="submit" name="insert" id="insert" value="Submit" class="btn btn-success" /> 
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  
                     </form> 
                </div>  
           </div>  
      </div>  
 </div>