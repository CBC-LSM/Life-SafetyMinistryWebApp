<?php
$pageName = "Emergency Roster";

require_once '../database/load.php';
require_once 'common.php';
// include '../pages/header.php';
require_once 'redisConnection.php';
require_once 'redisFunctions.php';
require_once 'pcoFunctions.php';
require_once 'eventIDs.php';
//Get redis data
$checkInObj[] = new stdClass();//New Event (key) is being looped through so reset the object.
$keyValues = $arList = $redis->keys("*");

$keyValues = $mergedArray;
$columnCount= 38;
$counter = 0;
$column1Header = TRUE;
$column1End;
$column2Header = TRUE;

$currentDate = date("Y-m-d");
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

// Your PHP code to check if $checkInObj is empty and set the JavaScript variable accordingly
$isCheckInObjEmpty = empty($checkInObj) ? true : false;

//now we just need to iterate through the keys. The data is already conditionalized so we can make this a simple process.
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type ="image/png" href="../../images/cbcfavicon.PNG">

		<title><?=$pageName?></title>
    
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" />
    	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
      	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
      	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="../../main.css" />
        
	</head>
	
  <body style="background-color:#1E1E1E">
  <!-- If $isCheckInObjEmpty is true, show the centered div -->

  <div class = "MainContainer">
    <table class="header_table">
        <tbody>
        <tr>
          <td></td>
            <td>
                <img src="../../images/LSM_weblogo.png" alt="" style="width: 100px; height: auto;">
            </td>
          <td></td>
        </tr>
        </tbody>
      </table>
<div class="panel-box" >
    <?php if ($isCheckInObjEmpty): ?>
        <div class="centered-div">
            <p>No one is checked in at this moment.</p>
        </div>
    <?php endif; ?>
    <table class="ERtableContainer2">
        <!-- <thead> -->
            <!-- <tr class = "entry_header" style ="color: #D4D4C9; font-family: Arial  ;"> -->
                <!-- <th class="header-text-left" style="width:50%">Name</th> -->
                <!-- <th class="header-text-center" style="width:33%">Last Name</th> -->
                <!-- <th class="header-text-center" style="width:50%">Check-In Time</th> -->
            <!-- </tr> -->
        <!-- </thead> -->
        <tbody class="dashboard_table_body">
            <?php foreach($checkInObj as $check):
                $eventid = $check['id'];
                $eventName = $check['name'];
                $datas = $check['data'];
                // $count = count($datas);
                $count = count(array_filter($datas, function($element) {
                    return $element['checkoutstatus']== 0;
                }));
                // print_r($datas);
                // die();
                ?>
                <tr>
                <!-- <td colspan = "2" class="class_body-text-center" style ="color: #e0e019;"><strong><?=$eventName."---".$count;?></strong></td> -->
                <td class="class_body-text-center" style ="color: #e0e019;"><strong><?=$eventName;?></strong></td>
                <td class="class_body-text-center" style ="color: #e0e019;"><strong><?=$count;?></strong></td>
                    <!-- <td class="body-text-left"></td> -->
                    <?php foreach($datas as $data):?>
                        <?php if ($data['checkoutstatus']==0):?>
                        <tr class="table_names">
                            <td class="class_body-text-left"><?php echo $data['first_name']." ".$data['last_name']; ?></td>
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

 <!-- JavaScript variable to hold the object status -->
 <script>
    var isCheckInObjEmpty = <?php echo $isCheckInObjEmpty ? 'true' : 'false'; ?>;
</script>
<!-- Include your JavaScript script that will handle background updates -->
<script src="refresh.js"></script>

<?php include 'pages/footer.php';?>