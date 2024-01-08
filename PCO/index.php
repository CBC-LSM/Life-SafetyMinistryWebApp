<?php
$pageName = "Emergency Roster";

require_once '../database/load.php';
require_once 'common.php';
include '../pages/header.php';
require_once 'redisConnection.php';
require_once 'redisFunctions.php';
require_once 'pcoFunctions.php';
require_once 'eventIDs.php';
//Get redis data
$checkInObj[] = new stdClass();//New Event (key) is being looped through so reset the object.
$keyValues = $arList = $redis->keys("*");

$keyValues = $mergedArray;
// die(var_dump($keyValues));
// $currentDate = date("Y-m-d");
// $dateTimeUTC = "2023-06-18";
$currentDate = $dateTimeUTC;
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
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p id="modal-content"></p>
  </div>
</div>
<head>
    <script src="script.js"></script>
</head>

<div class="panel-box" >
    <table class="ERtableContainer2">
        <thead>
            <tr class = "entry_header" style ="color: #D4D4C9; font-family: Arial  ;">
                <th class="header-text-left" style="width:25%">Name</th>
                <!-- <th class="header-text-center" style="width:33%">Last Name</th> -->
                <th class="header-text-center" style="width:25%">Check-In Time</th>
            </tr>
        </thead>
        <tbody class="dashboard_table_body">
            <?php foreach($checkInObj as $check):
                $eventid = $check['id'];
                $eventName = $check['name'];
                $datas = $check['data'];
                $count = count(array_filter($datas, function($element) {
                    return $element['checkoutstatus']== 0;
                }));
                // $count = count($datas);
                // print_r($datas);
                // die();
                ?>
                <tr>
                <!-- <td colspan = "2" class="body-text-center" style ="color: #e0e019;"><strong><?=$eventName;?></strong></td> -->
                <td class="class_body-text-center" style ="color: #e0e019;"><strong><?=$eventName;?></strong></td>
                <td class="class_body-text-center" style ="color: #e0e019;"><strong><?=$count;?></strong></td>
                    <!-- <td class="body-text-left"></td> -->
                    <?php foreach($datas as $data):?>
                        <?php if ($data['checkoutstatus']==0):?>
                        <tr>
                            <!-- <td class="body-text-left"><?php echo $data['first_name']." ".substr($data['last_name'],0,1)."."; ?></td> -->
                            <!-- <td class="class_body-text-left"><?php echo $data['first_name']." ".$data['last_name']; ?></td> -->
                            <?php
                            $firstname = $data['first_name'];
                            $lastname = $data['last_name'];
                            $emContact = $data['emergency_contact_name'];
                            $phoneNum = $data['emergency_contact_number'];
                            // echo $phoneNum;
                            ?>
                            <td class="class_body-text-left">
                                <a href="#" onclick="handleClick(event, '<?=$firstname?>','<?=$lastname?>', '<?=$emContact?>','<?=$phoneNum?>')">
                                    <?php echo $data['first_name']." ".$data['last_name']; ?>
                                </a>
                            </td>

                            <!-- <td class="body-text-center"><?php ; ?></td> -->
                            <td class="body-text-center"><?php echo timeConvert($data['check_in_time']); ?></td>
                            
                        </tr>
                        <?php endif;?>
                    <?php endforeach;?>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>

<?php include 'pages/footer.php';?>
