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
$allUtilityBags = findAllUtilityBags();
$allPositions = findAllPositions();

$date1 = date('Y-m-d')." 00:00:00";
$date2 = date('Y-m-d')." 23:59:00";
$teamStatus = findAllTeamStatus($date1,$date2);

$checkouttime   = date('Y-m-d H:i:s');
?>
<div>
    
</div>

<div class="panel-box">
    <!-- <div class="container">
        Search Here
        <input type="text" name="search" id="search" placeholder="search here...." class="form-control">  
    </div> -->
    <button type="button" class="btn btn-primary btn-lg" id ="add" data-toggle="modal" data-target="#add_data_modal" VALIGN=MIDDLE>
        <span class="glyphicon glyphicon-plus-sign" style="color:#a0a0a0; font-size: 30px; vertical-align: middle; padding: 0px 0px 0px 0px;" aria-hidden="true"></span>
        <strong>Add Data</strong>
    </button>
    <!-- <div style ="color: #D4D4C9;"><?=$checkouttime."<br>"; echo $date1."<br>";echo $date2."<br>";?></div> -->
    <div class="container">
    <table>
        <thead>
            <tr style ="color: #D4D4C9; font-size: 100%; font-family: Arial  ;">
                <th class="text-left" style="width: 5%;"><strong>Name</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Position</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Radio</strong></th>
                <th class="text-center" style="width: 5%;"><strong>DSM</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Flashlight</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Tourniquet</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Utility Bag</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Status</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Modify</strong></th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach($teamStatus as $team):?>
                <tr style ="color: #D4D4C9; font-size: 100%; background-color:#1E1E1E;">
                    <td class="text-left"><div class="mobile-only"><strong>Name</strong></div><strong><?php echo $team['membername']; ?></strong></td>
                    <td><div class="mobile-only"><strong>Position</strong></div><?php echo $team['positionname']; ?></td>
                    <td><div class="mobile-only"><strong>Radio</strong></div><?php echo $team['radioname']; ?></td>
                    <td><div class="mobile-only"><strong>DSM</strong></div><?php echo $team['dsmname']; ?></td>
                    <td><div class="mobile-only"><strong>Flashlight#</strong></div><?php echo $team['flashlightname']; ?></td>
                    <td><div class="mobile-only"><strong>Tourniquet</strong></div><?php echo $team['tourniquetname']; ?></td>
                    <td><div class="mobile-only"><strong>Utility Bag</strong></div><?php echo $team['ubname']; ?></td>
                    <td><div class="mobile-only"><strong>Status</strong></div><?php echo $team['status']; ?></td>
                    <td><div class="mobile-only"></div>
                        <a href="delete.php?id=<?php echo $team['id'];?>"onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-xs"  
                        title="Delete Entry" data-toggle="tooltip"><span class="glyphicon glyphicon-remove"></span></a>
                    <?php if ($team['status']=="Checked Out"):?>
                        <a href="checkin.php?id=<?php echo $team['id'];?>"class="btn btn-warning btn-xs"  
                        title="Check In" data-toggle="tooltip"><span class="glyphicon glyphicon-ok"></span></a>
                    <?php else:?>
                        <a href="checkout.php?id=<?php echo $team['id'];?>"class="btn btn-success btn-xs"  
                        title="Check Out" data-toggle="tooltip"><span class="glyphicon glyphicon-ok"></span></a>
                    <?php endif;?>
                    </td>
                </tr>
            <?php endforeach;?>     
        </tbody>
    </table>
    </div>
</div>

<div id="add_data_modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <h3 class="modal-title">Add Equipment Check Out</h4>
                </div>   
                <div class="modal-body">  
                     <form method="post" id="insert_form">
                            <!-- <label for="Name-Choice">Name</label>
                            <input type="text" name="search" id="search" placeholder="search here...." class="form-control">   -->
                            <!-- <br> -->
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


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <!-- jQuery UI library -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

 <script>
  $( function() {
    $( "#search" ).autocomplete({
      source: 'ajax-db-search.php',
      select: function( event, ui ) {
            event.preventDefault();
            $("#search").val(ui.item.id);
      }
    });
  } );
  </script>
<script>
$(document).ready(function() {
	$('#insert').on('click', function() {
		var name = $('#Name-Choice').val();
		var position = $('#position').val();
		var radio = $('#radio').val();
          var dsm = $('#dsm').val();
		var flashlight = $('#flashlight').val();
          var tourniquet = $('#tourniquet').val();
          var utility_bag = $('#utility_bag').val();
          event.preventDefault();  
           if($('#name').val() == '') 
           {  
                alert("Must Select Name");  
           }  
           else if($('#position').val() == '')  
           {  
                alert("Must Choose Position: \r\nUse MISC if no relative position");  
           }  
           else if($('#radio').val() == '')  
           {  
                alert("Radio Required");  
           }  
           else  
           {
               $.ajax({
                    url: "insert.php",
                    type: "POST",
                    data: {
                        name: name,
                        position: position,
                        radio: radio,
                        dsm: dsm,
                        flashlight: flashlight,
                        tourniquet: tourniquet,
                        utility_bag: utility_bag				
                    },
                    beforeSend:function(){  
                              $('#insert').val("Inserting");},
                    success: function(dataResult){
                         var dataResult = dataResult;
                         let baseURL = "";
                         let newURL = baseURL.concat(dataResult);
                         window.location.replace(newURL);

                         }
                         
                    
               });
		}

	})
});
</script>