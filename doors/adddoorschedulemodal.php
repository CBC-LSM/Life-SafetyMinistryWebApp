<?php
/**
 * includes/load.php
 *
 * @package default
 * @see index.php
 */
?>
<div id="add_to_schedule" class="modal fade"> 
  <div class="panel-modal">
      <div class="modal-dialog">  
          <div class="modal-content">  
              <div class="modal-header">  
                  <h3 class="modal-title">Add To Door Schedule</h3>
              </div>   
              <div class="modal-body">  
                  <form method="post" action="../doors/addDoorSchedule.php">
                          <div class="form-group">
                            <label for="doorid" class="control-label">Door</label>
                            <select class="form-control" name="doorid" id="doorid" required>
                                <option value="">Choose Door</option>
                                    <?php  foreach ($doors as $door): ?>
                                        <option value="<?php echo $door['id']; ?>" >
                                            <?php echo $door['doorName']; ?></option>
                                    <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="form-group">
                          <label for="startday" class="control-label">Start</label>
                            <select class="form-control" name="startday" id="startday" required>
                                <option value ="">Choose Day</option>
                                <option value ="Sunday">Sunday</option>
                                <option value ="Monday">Monday</option>
                                <option value ="Tuesday">Tuesday</option>
                                <option value ="Wednesday">Wednesday</option>
                                <option value ="Thursday">Thursday</option>
                                <option value ="Friday">Friday</option>
                                <option value ="Saturday">Saturday</option>
                            </select>
                          </div>
                          <label>Start Time</label> 
                            <input type="time" name="startime" id="startime" class="form-control" value ="00:00" step="900" required>
                          <br>
                          <div class="form-group">
                          <label for="endday" class="control-label">End</label>
                            <select class="form-control" name="endday" id="endday" required>
                                <option value ="">Choose Day</option>
                                <option value ="Sunday">Sunday</option>
                                <option value ="Monday">Monday</option>
                                <option value ="Tuesday">Tuesday</option>
                                <option value ="Wednesday">Wednesday</option>
                                <option value ="Thursday">Thursday</option>
                                <option value ="Friday">Friday</option>
                                <option value ="Saturday">Saturday</option>
                            </select>
                          </div>
                          <label>Stop Time</label> 
                            <input type="time" name="endtime" id="endtime" value ="00:00" class="form-control" required> 
                          <br>
                          <label>Action</label> 
                            <select class="form-control" name="dooraction" id="dooraction" required>
                                <option value ="">Choose Action</option>
                                <option value ="Lock">Lock</option>
                                <option value ="Unlock">Unlock</option>
                            </select>  
                          <br>
                          <!-- <div class="wrapper">
                            <div class="values">
                                <span id="range1">
                                    0
                                </span>
                                <span> &dash; </span>
                                <span id="range2">
                                    6
                                </span>
                            </div>
                            <div class="container">
                                <div class="slider-track"></div>
                                <input type="range" min="0" max="6" data-step-labels="[0, 1, 2, 3, 4, 5, 6]" step="1" value="0" id="slider-1" oninput="slideOne()">
                                <input type="range" min="0" max="6" data-step-labels="[0, 1, 2, 3, 4, 5, 6]" step="1" value="6" id="slider-2" oninput="slideTwo()">
                            </div> -->
                        <!-- </div> -->
                        <!-- </div> -->
                      <input type="hidden" name="id" id="id" value="<?=$user['id'];?>" />
                      <input type="hidden" name="redirect" id="redirect" value="<?=$redirectURL;?>" />
                      <input type="submit" name="edit_insert" id="edit_insert<?=$user['id'];?>" value="Add New Schedule" class="btn btn-success" /> 
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