<?php
/**
 * includes/load.php
 *
 * @package default
 * @see index.php
 */

// require_once '../database/load.php';
// include '../pages/header.php';
// $dayofweek = date('l'); // day of week
// $result    = date('Y-m-d', strtotime(($day - $dayofweek).' day', strtotime($date)));
?>
<div id="add_to_schedule" class="modal fade"> 
  <div class="panel-modal">
      <div class="modal-dialog">  
          <div class="modal-content">  
              <div class="modal-header">  
                  <h3 class="modal-title">Add To Door Schedule</h3>
              </div>   
              <div class="modal-body">  
                  <form method="post" action="../door/addDoorSchedule.php">
                          <div class="form-group">
                            <label for="name" class="control-label">Door</label>
                            <select class="form-control" name="userlevel" id="userlevel">
                                <option value="">Choose Door</option>
                                    <?php  foreach ($doors as $door): ?>
                                        <option value="<?php echo $door['doorName']; ?>" >
                                            <?php echo $door['doorName']; ?></option>
                                    <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="form-group">
                          <label for="name" class="control-label">Day</label>
                            <select class="form-control" name="day" id="day">
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
                          <!-- <label>Start Time</label> 
                            <input type="time" name="startime" id="startime" class="form-control">
                          <br>
                          <label>Stop Time</label> 
                            <input type="week" name="stoptime" id="stoptime" class="form-control"> 
                          <br> -->
                          <label>Action</label> 
                            <select class="form-control" name="dooraction" id="dooraction">
                                <option value ="">Choose Action</option>
                                <option value ="sun">Lock</option>
                                <option value ="mon">Unlock</option>
                            </select>  
                          <br>
                          <div class="wrapper">
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
                            </div>
                        </div>
                        </div>
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