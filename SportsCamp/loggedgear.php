<?php

$AllNames = findAllSCnames();
$allRadios = findAllSCRadios();

$allPositions = findAllSCPositions();

$date1 = date('Y-m-d')." 00:00:00";
$date2 = date('Y-m-d')." 23:59:00";
$teamStatus = findAllSCTeamStatus($date1,$date2);

$checkouttime   = date('Y-m-d H:i:s');
// die(print_r($checkouttime));
?>
<div>
    
</div>

<div class="panel-box">
    <button type="button" class="btn btn-primary btn-lg" id ="add" data-toggle="modal" data-target="#SCadd_data_modal" VALIGN=MIDDLE>
        <span class="glyphicon glyphicon-plus-sign" style="color:#a0a0a0; font-size: 30px; vertical-align: middle; padding: 0px 0px 0px 0px;" aria-hidden="true"></span>
        <strong>Add Data</strong>
    </button>
    <!-- <div style ="color: #D4D4C9;"><?=$checkouttime."<br>"; echo $date1."<br>";echo $date2."<br>";?></div> -->
    <div class="tableContainer">
    <table>
        <thead>
            <tr class = "entry_header" style ="color: #D4D4C9; font-family: Arial  ;">
                <th class="text-center" style="width: 10%;"><strong>Modify</strong></th>
                <th class="text-left" style="width: 10%;"><strong>Name</strong></th>
                <th class="text-center" style="width: 10%;"><strong>Position</strong></th>
                <th class="text-center" style="width: 10%;"><strong>Radio</strong></th>
                <th class="text-center" style="width: 10%;"><strong>Status</strong></th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach($teamStatus as $team):?>
                <tr style ="color: #D4D4C9; font-size: 100%; background-color:#1E1E1E;">
                    <td class="entry_input"><div class="mobile-only"></div>
                        <?php if ($_SESSION['userLevel'] ==1 and $_SESSION['userLevel']!=0):?>
                            <a href="delete.php?id=<?php echo $team['id'];?>"onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-xs"  
                            title="Delete Entry" data-toggle="tooltip"><span class="glyphicon glyphicon-remove"></span>
                            </a>
                        <?php endif;?>

                        <button type="button" class="btn btn-warning btn-xs" id ="edit" value = "<?php echo $team['id'];?>" onClick="<?php echo $team['id']?>" 
                        data-toggle="modal" title="Edit Entry" data-target="#SCedit_data_modal<?=$team['id'];?>" VALIGN=MIDDLE><span class="glyphicon glyphicon-edit"></button>

                    <?php if ($team['status']=="Checked Out"):?>
                        <a href="checkin.php?id=<?php echo $team['id'];?>"class="btn btn-warning btn-xs"  
                        title="Check In" data-toggle="tooltip"><span class="glyphicon glyphicon-ok"></span></a>
                    <?php else:?>
                        <a href="checkout.php?id=<?php echo $team['id'];?>"class="btn btn-success btn-xs"  
                        title="Check Out" data-toggle="tooltip"><span class="glyphicon glyphicon-ok"></span></a>
                    <?php endif;?>
                    </td>
                    <td class="text-left entry_input"><div class="mobile-only"><strong>Name</strong></div><strong><?php echo $team['membername']; ?></strong></td>
                    <td class="entry_input"><div class="mobile-only"><strong>Position</strong></div><?php echo $team['positionname']; ?></td>
                    <td class="entry_input"><div class="mobile-only"><strong>Radio</strong></div><?php echo $team['radioname']; ?></td>
                    <td class="entry_input"><div class="mobile-only"><strong>Status</strong></div><?php echo $team['status']; ?></td>
                    <?php include '../SportsCamp/SCedit_data_modal.php'; ?>    
                    </tr>
            <?php endforeach;?>     
        </tbody>
    </table>
    </div>
</div>

<?php include 'SCadd_data_modal.php'; ?>  

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
          event.preventDefault();  
           if($('#name').val() == ''){alert("Must Select Name");  }  
           else if($('#position').val() == ''){alert("Must Choose Position: \r\nUse MISC if no relative position");}  
           else if($('#radio').val() == ''){alert("Radio Required");}  
           else{
               $.ajax({
                    url: "insert.php",
                    type: "POST",
                    data: {
                        name: name,
                        position: position,
                        radio: radio				
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
$(document).ready(function() {
	$('#edit_insert').on('click', function() {
        var status_id = 11;
		var name = $('#Edit-Name-id').val();
		var position = $('#edit_position').val();
		var radio = $('#edit_radio').val();
        $.ajax({
                    url: "edit.php",
                    type: "POST",
                    data: {
                        id: status_id,
                        name: name,
                        position: position,
                        radio: radio		
                    },
               });
		})
});
</script>