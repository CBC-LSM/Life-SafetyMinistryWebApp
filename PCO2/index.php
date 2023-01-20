<?php
$pageName = "Emergency Roster";

require_once '../database/load.php';
require_once 'common.php';
require_once 'pcoCall.php';
include '../pages/header.php';

pcoCall($URL);

?>
<script>
    setTimeout("location.reload(true);", 10000);
</script>
<div class="panel-box">
    <table class="tableContainer">
        <thead>
            <tr class = "entry_header" style ="color: #D4D4C9; font-family: Arial  ;">
                <th class="header-text-left"style="width:20%"></th>
                <th class="header-text-left" style="width:20%">First Name</th>
                <th class="header-text-center" style="width:20%">Last Name</th>
                <th class="header-text-center" style="width:20%">Check-In Time</th>
                <th class="header-text-center" style="width:20%">Checked Out Time</th>
            </tr>
        </thead>
        <tbody class="dashboard_table_body">
            <?php foreach($includes as $included):
                $eventid = $included['id'];
                $eventName = $included['attributes']['name'];
                ?>
                <tr>
                    <td class="body-text-left"><?=$eventName;?></td>
                    <?php foreach($datas as $data):
                        $checkoutEventID = $data['relationships']['event']['data']['id'];?>
                        <?php if($checkoutEventID == $eventid):?>
                            <?php $checkedouttime = $data['attributes']['checked_out_at'];
                                if(is_null($checkedouttime)):?>
                                    <tr>
                                        <td class="body-text-left"></td>
                                        <td class="body-text-left"><?php echo $data['attributes']['first_name']; ?></td>
                                        <td class="body-text-center"><?php echo $data['attributes']['last_name']; ?></td>
                                        <td class="body-text-center"><?php echo timeConvert($data['attributes']['created_at']); ?></td>
                                        <td class="body-text-center"><?php 
                                        if (is_null($data['attributes']['checked_out_at'])){
                                            echo "";
                                        }else{ 
                                            echo timeConvert($data['attributes']['checked_out_at']);
                                        }
                                        ?></td>
                                    </tr>
                                <?php else:?>
                                <?php endif;?>
                        <?php endif;?>
                    <?php endforeach;?> 
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<?php include 'pages/footer.php';?>
