<?php
$pageName = "Emergency Roster";

require_once '../database/load.php';
require_once 'common.php';
include '../pages/header.php';
require_once 'redisConnection.php';
require_once 'redisFunctions.php';
require_once 'pcoFunctions.php';

//Get redis data
$checkInObj[] = new stdClass();//New Event (key) is being looped through so reset the object.
$keyValues = $arList = $redis->keys("*");
$currentDate = date("Y-m-d");
// $dateTimeUTC = "2023-01-25";
// $currentDate = $dateTimeUTC;
// echo $currentDate;
foreach($keyValues as $key){
    //get and assign data value to $checkInObj[];<- like I did in the call function
    $ReJsonData = $redis->get($key);
    $ReJsonData = json_decode($ReJsonData,true);
    $dataDate = date('Y-m-d',strtotime($ReJsonData['date']));
    if ($currentDate == $dataDate && !is_null($key)){ //find current data only. For Today's eyes only
        $checkInObj[$key] = $ReJsonData;
    }
}

// unfortunately this is necessary as it is auto added when the list is created above. Not sure how to fix permenately but this works in it's place, else
// you end up with a empty key set with no data in it.
unset($checkInObj[0]);

//now we just need to iterate through the keys. The data is already conditionalized so we can make this a simple process.
?>
<script>
    // setTimeout("location.reload(true);", 10000);
</script>
<div class="panel-box">
    <table class="tableContainer">
        <thead>
            <tr class = "entry_header" style ="color: #D4D4C9; font-family: Arial  ;">
                <th class="header-text-left"style="width:20%">Check-In Event</th>
                <th class="header-text-left" style="width:20%">First Name</th>
                <th class="header-text-center" style="width:20%">Last Name</th>
                <th class="header-text-center" style="width:20%">Check-In Time</th>
            </tr>
        </thead>
        <tbody class="dashboard_table_body">
            <?php foreach($checkInObj as $check):
                $eventid = $check['id'];
                $eventName = $check['name'];
                $datas = $check['data'];
                // print_r($datas);
                // die();
                ?>
                <tr>
                    <td class="body-text-left"><?=$eventName;?></td>
                    <!-- <td class="body-text-left"></td> -->
                    <?php foreach($datas as $data):?>
                        <tr>
                            <td class="body-text-left"></td>
                            <td class="body-text-left"><?php echo $data['first_name']; ?></td>
                            <td class="body-text-center"><?php echo $data['last_name']; ?></td>
                            <td class="body-text-center"><?php echo timeConvert($data['check_in_time']); ?></td>
                        </tr>
                    <?php endforeach;?>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<?php include 'pages/footer.php';?>
