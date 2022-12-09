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
                  <form method="post" action="../doors/editDoorSchedule.php">
                          <div class="form-group">
                            <label for="doorid" class="control-label">Door</label>
                            <select class="form-control" name="readout" id="readout" disabled>
                                <option value=""><?=$doorschedule['doorName'];?></option>
                            </select>
                          </div>
                          <div class="form-group">
                          <label for="startday" class="control-label">Start</label>
                            <select class="form-control" name="editstartday<?=$doorschedule['id'];?>" id="editstartday<?=$doorschedule['id'];?>">
                                <option value ="<?=$doorschedule['startday'];?>"><?=$doorschedule['startday'];?></option>
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
                            <input type="time" name="editstartime<?=$doorschedule['id'];?>" id="editstartime<?=$doorschedule['id'];?>" class="form-control" value ="<?php if(isset($doorschedule['starttime'])){echo $doorschedule['starttime'];}else{echo "00:00";}?>" step="900">
                          <br>
                          <div class="form-group">
                          <label for="endday" class="control-label">End</label>
                            <select class="form-control" name="editendday<?=$doorschedule['id'];?>" id="editendday<?=$doorschedule['id'];?>" required>
                                <option value ="<?=$doorschedule['endday'];?>"><?=$doorschedule['endday'];?></option>
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
                            <input type="time" name="editendtime<?=$doorschedule['id'];?>" id="editendtime<?=$doorschedule['id'];?>" required value ="<?php if(isset($doorschedule['endtime'])){echo $doorschedule['endtime'];}else{echo "00:00";}?>" class="form-control" required> 
                          <br>
                          <label>Action</label> 
                            <select class="form-control" name="editdooraction<?=$doorschedule['id'];?>" id="editdooraction<?=$doorschedule['id'];?>">
                                <option value ="<?=$doorschedule['action'];?>"><?=$doorschedule['action'];?></option>
                                <option value ="">Choose Action</option>
                                <option value ="Lock">Lock</option>
                                <option value ="Unlock">Unlock</option>
                            </select>  
                          <br>
                          <label>Always Locked</label>
                          <input type="checkbox" name="editAlwaysLocked<?=$doorschedule['id'];?>" id="editAlwaysLocked<?=$doorschedule['id'];?>" value="1" onClick="editToggleSelect<?=$doorschedule['id'];?>()"/>
                          <br>
                      <input type="hidden" name="id" id="id" value="<?=$doorschedule['id'];?>" />
                      <input type="hidden" name="doorid<?=$doorschedule['id'];?>" id="doorid<?=$doorschedule['id'];?>" value ="<?=$doorschedule['doorid'];?>" />
                      <!-- <input type="hidden" name="redirect" id="redirect" value="<?=$redirectURL;?>" /> -->

                      <input type="submit" name="edit_insert" id="edit_insert<?=$user['id'];?>" value="Edit Schedule" class="btn btn-success" /> 
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  
                  </form> 
                <script>
                  function editToggleSelect<?=$doorschedule['id'];?>()
                    {
                      var isChecked = document.getElementById("editAlwaysLocked<?=$doorschedule['id'];?>").checked;
                    //   document.getElementById("selectOne").disabled = isChecked;
                      document.getElementById("editdooraction<?=$doorschedule['id'];?>").disabled = isChecked;
                      document.getElementById("editstartday<?=$doorschedule['id'];?>").disabled = isChecked;
                      document.getElementById("editstartime<?=$doorschedule['id'];?>").disabled = isChecked;
                      document.getElementById("editendday<?=$doorschedule['id'];?>").disabled = isChecked;
                      document.getElementById("editendtime<?=$doorschedule['id'];?>").disabled = isChecked;
                    //   document.getElementById("doorAction").value = "Locked";
                    }
                </script>
              </div>  
          </div>  
      </div>  
  </div>
</div>
</body>
</html>