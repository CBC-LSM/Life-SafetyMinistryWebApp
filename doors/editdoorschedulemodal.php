<?php
/**
 * includes/load.php
 *
 * @package default
 * @see index.php
 */
?>
<div id="edit_schedule<?=$doorschedule['id'];?>" class="modal fade"> 
  <div class="panel-modal">
      <div class="modal-dialog">  
          <div class="modal-content">  
              <div class="modal-header">  
                  <h3 class="modal-title">Edit Door Schedule</h3>
                  <!-- <?=$doorschedule['id'];?> -->
              </div>   
              <div class="modal-body">  
                  <form method="post" action="../doors/addDoorSchedule.php">
                          <div class="form-group">
                            <label for="doorid" class="control-label">Door</label>
                            <select class="form-control" name="doorid" id="doorid" required>
                                <option value="<?=$doorschedule['doorName'];?>"><?=$doorschedule['doorName'];?></option>
                                    <?php  foreach ($doors as $door): ?>
                                        <option value="<?php echo $door['id']; ?>" >
                                            <?php echo $door['doorName']; ?></option>
                                    <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="form-group">
                          <label for="startday" class="control-label">Start</label>
                            <select class="form-control" name="startday" id="startday" required>
                                <option value ="<?=$doorschedule['startday'];?>"><?=$doorschedule['startday'];?></option>
                                <option value ="sun">Sunday</option>
                                <option value ="mon">Monday</option>
                                <option value ="tues">Tuesday</option>
                                <option value ="wed">Wednesday</option>
                                <option value ="thurs">Thursday</option>
                                <option value ="fri">Friday</option>
                                <option value ="sat">Saturday</option>
                            </select>
                          </div>
                          <label>Start Time</label> 
                            <input type="time" name="startime" id="startime" class="form-control" value ="00:00" step="900" required>
                          <br>
                          <div class="form-group">
                          <label for="endday" class="control-label">End</label>
                            <select class="form-control" name="endday" id="endday" required>
                                <option value ="">Choose Day</option>
                                <option value ="sun">Sunday</option>
                                <option value ="mon">Monday</option>
                                <option value ="tues">Tuesday</option>
                                <option value ="wed">Wednesday</option>
                                <option value ="thurs">Thursday</option>
                                <option value ="fri">Friday</option>
                                <option value ="sat">Saturday</option>
                            </select>
                          </div>
                          <label>Stop Time</label> 
                            <input type="time" name="endtime" id="endtime" value ="00:00" class="form-control" required> 
                          <br>
                          <label>Action</label> 
                            <select class="form-control" name="dooraction" id="dooraction" required>
                                <option value ="">Choose Action</option>
                                <option value ="lock">Lock</option>
                                <option value ="unlock">Unlock</option>
                            </select>  
                          <br>
                      <input type="hidden" name="id" id="id" value="<?=$user['id'];?>" />
                      <input type="hidden" name="redirect" id="redirect" value="<?=$redirectURL;?>" />
                      <input type="submit" name="edit_insert" id="edit_insert<?=$user['id'];?>" value="Edit Schedule" class="btn btn-success" /> 
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  
                  </form> 
                  <!--Script-->
                <script src="../scripts/script.js"></script>
              </div>  
          </div>  
      </div>  
  </div>
</div>
</body>
</html>