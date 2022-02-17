<?php
/**
 * includes/load.php
 *
 * @package default
 * @see index.php
 */
$AllNames = findAllnames();
$allRadios = findAllRadios();
$allDSMs = findAllDSMs();
$allFlashlights = findAllflashlights();
$allTourniquets = findAllTourniquets();
$allPositions = findAllPositions();
$teamStatus = findAllTeamStatus();
// die(var_dump($teamStatus));
// var_dump($AllNames);
?>

<center>
    <div>
        
    </div>
    <div class="panel-box">
        <button type="button" class="btn btn-primary" id ="add" data-toggle="modal" data-target="#add_data_modal">
            <span class="glyphicon glyphicon-plus-sign" style="color:#a0a0a0; font-size: 30px; vertical-align: middle;" aria-hidden="true"></span>
            Add Data
        </button>
        <div class="table-responsive{-xl}">
        <table class="table table-bordered table-hover">
            <thead>
                <tr style ="color: #D4D4C9; font-size: 100%; font-family: Arial  ;">
                    <th class="text-center" style="width: 5%;"><strong>Name</strong></th>
                    <th class="text-center" style="width: 5%;"><strong>Position</strong></th>
                    <th class="text-center" style="width: 5%;"><strong>Radio</strong></th>
                    <th class="text-center" style="width: 5%;"><strong>DSM</strong></th>
                    <th class="text-center" style="width: 5%;"><strong>Flashlight</strong></th>
                    <th class="text-center" style="width: 5%;"><strong>Tourniquet</strong></th>
                    <th class="text-center" style="width: 5%;"><strong>Check Out Time</strong></th>
                    <th class="text-center" style="width: 5%;"><strong>Status</strong></th>
                    <th class="text-center" style="width: 5%;"><strong>Checked In Time</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($teamStatus as $team):?>
                    <tr style ="color: #D4D4C9; font-size: 100%; background-color:#1E1E1E;">
                        <td class="text-left" VALIGN=MIDDLE><strong><?php echo $team['membername']; ?></strong></td>
                        <td class="text-center" VALIGN=MIDDLE><?php echo $team['positionname']; ?></td>
                        <td class="text-center" VALIGN=MIDDLE><?php echo $team['radioname']; ?></td>
                        <td class="text-center" VALIGN=MIDDLE><?php echo $team['dsmname']; ?></td>
                        <td class="text-center" VALIGN=MIDDLE><?php echo $team['flashlightname']; ?></td>
                        <td class="text-center" VALIGN=MIDDLE><?php echo $team['tourniquetname']; ?></td>
                        <td class="text-center" VALIGN=MIDDLE><?php echo $team['checkout']; ?></td>
                        <td class="text-center" VALIGN=MIDDLE><?php echo $team['status']; ?></td>
                        <td class="text-center" VALIGN=MIDDLE><?php echo $team['checkin']; ?></td>
                    </tr>
                <?php endforeach;?>     
            </tbody>
        </table>
                </div>
    </div>
</center>

<div id="add_data_modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <h4 class="modal-title">Add Equipment Check Out</h4>
                </div>   
                <div class="modal-body">  
                     <form method="post" id="insert_form">  
                          <label>Name</label>
                          <select class="form-control" name="product" id="product">
                              <option value="">Name</option>
                              <?php  foreach ($AllNames as $name): ?>
                                    <option value="<?php echo $name['name']; ?>" >
                                        <?php echo $name['name']; ?></option>
                                <?php endforeach; ?>
                          </select>  
                          <br> 
                          <label>Position</label> 
                          <select class="form-control" name="cord_color" id="cord_color">
                              <option value="">Position</option>
                                <?php  foreach ($allPositions as $position): ?>
                                    <option value="<?php echo $position['name']; ?>" >
                                        <?php echo $position['name']; ?></option>
                                <?php endforeach; ?>
                          </select>  
                          <br>
                          <label>Radio</label> 
                          <select class="form-control" name="purchased_component" id="purchased_component">
                              <option value="">Radio</option>
                                   <?php  foreach ($allRadios as $radio):
                                        if ($radio['status']=="Checked In"):?>
                                            <option value="<?php echo $radio['name']; ?>" >
                                            <?php echo $radio['name']; ?></option>
                                        <?php else:?>
                                        <?php endif;?>  
                                    <?php endforeach; ?>
                          </select>  
                          <br>   
                          <label>DSM</label>  
                          <select class="form-control" name="purchased_component" id="purchased_component">
                              <option value="">DSM</option>
                              <?php  foreach ($allDSMs as $DSM):
                                        if ($DSM['status']=="Checked In"):?>
                                            <option value="<?php echo $DSM['name']; ?>" >
                                            <?php echo $DSM['name']; ?></option>
                                        <?php else:?>
                                        <?php endif;?>  
                                    <?php endforeach; ?>
                          </select>
                          <br>   
                          <label>Flashlight</label> 
                            <select class ="form-control" name="sale_type" id="sale_type">
                                <option value="">Flashlight</option>
                                <?php  foreach ($allFlashlights as $flashlight):
                                    if ($flashlight['status']=="Checked In"):?>
                                        <option value="<?php echo $flashlight['name']; ?>" >
                                        <?php echo $flashlight['name']; ?></option>
                                    <?php else:?>
                                    <?php endif;?>  
                                <?php endforeach; ?>
                            </select>
                          <br>
                          <label>Tourniquet</label> 
                            <select class ="form-control" name="sale_type" id="sale_type">
                                <option value="">Tourniquet</option>
                                <?php  foreach ($allTourniquets as $tourniquet):
                                    if ($tourniquet['status']=="Checked In"):?>
                                        <option value="<?php echo $tourniquet['name']; ?>" >
                                        <?php echo $tourniquet['name']; ?></option>
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
