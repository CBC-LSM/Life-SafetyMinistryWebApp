<?php
$img = $user['img'];
// echo $img;
?>
<div id="picture_modal<?=$user['id'];?>" class="modal fade">
    <div class="panel-modal">
        <div class="modal-dialog">  
            <div class="modal-content">  
                <div class="modal-header">  
                  <h3 class="modal-title"><?=$img;?></h3>
              </div>
              <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal">X</button> 
                <?php if($img != ""):?>
                    <img class="modal-picture" src="../images/users/<?=$img;?>">
                <?php else:?>
                    <h3 class="modal-title">No Image Available</h3>
                <?php endif;?>
              </div>
            </div>
        </div>
    </div>
</div>