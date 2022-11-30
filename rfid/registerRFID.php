<?php
	$Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
	file_put_contents('../rfid/UIDContainer.php',$Write);
?>
		<script>
			$(document).ready(function(){
				 $("#getUID").load("../rfid/UIDContainer.php");
				setInterval(function() {
					$("#getUID").load("../rfid/UIDContainer.php");
				}, 500);
			});
		</script>
<div id="add_data_modal" class="modal fade">
      <div class="modal-dialog">
           <div class="modal-content">
                <div class="modal-header">
                     <h3 class="modal-title">Register New Badge</h4>
                </div>
                <div class="modal-body">
                     <form method="post" id="insert_form">
                        <div class="test_modal_body">
                            <label>ID:</label>
                                <textarea disabled class = form-control name="id" id="getUID" placeholder="Please Scan your Card / Key Chain to display ID" rows="1" cols="1" required></textarea>
                            <label for="Name-Choice">Name</label>
                            <input list="names" name="name" id= "name" class="form-control" placeholder="Name" required/>
                                <datalist id="names">
                                <?php  foreach ($users as $user): ?>
                                        <option value="<?php echo $user['name']; ?>" >
                                    <?php endforeach; ?>
                                </datalist>
                            <br>
                            <br>
                            <input type="submit" name="register" id="register" value="Submit" class="btn btn-success" />
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                     </form>
                </div>
           </div>
      </div>
</div>
<script>
$(document).ready(function() {
	$('#register').on('click', function() {
		var id = $('#getUID').val();
		var name = $('#name').val();
        event.preventDefault();
            if($('#getUID').val() ==''){alert("Must scan badge before entering");}
            else if ($('#name').val()==''){alert("Must select name");}
            else{
                $.ajax({
                    url: "../rfid/insert.php",
                    type: "POST",
                    data: {
                        id: id,
                        name: name			
                    },
                    beforeSend:function(){  
                                $('#register').val("registering");},
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