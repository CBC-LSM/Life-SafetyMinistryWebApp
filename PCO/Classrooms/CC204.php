<?php
// redirect('../../PCO/index.php', false);
$pageName = "CC204";

require_once '../../database/load.php';
require_once '../common.php';
require_once '../redisConnection.php';
require_once '../redisFunctions.php';
require_once '../pcoFunctions.php';
$day = dayofweek($dateTimeUTC);

if ($day == "Sunday"){
    $key = "192331";
    $pageName = "K and 1st Grade";
}elseif($day == "Wednesday"){
    $key = "233761";
    $pageName = "Cubbies";
}else{
    $pageName = "CC204";
}


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
  <div class = "MainContainer">
    <table class="header_table">
        <tbody>
        <tr>
          <td></td>
          <td><img src="../../images/LSM_weblogo.png" alt=""/></td>
          <td>
          </td>
        </tr>
        </tbody>
      </table>

<?php
$ReJsonData = $redis->get($key);
$ReJsonData = json_decode($ReJsonData,true);
$classroom = $ReJsonData['name'];
$datas = $ReJsonData['data'];
if (is_null($ReJsonData)){
    // include '../../pages/loading.php';
    // echo "Not ready yet";
}

// while (is_null($ReJsonData)){
//     $ReJsonData = $redis->get($key);
//     $ReJsonData = json_decode($ReJsonData,true);
//     $classroom = $ReJsonData['name'];
//     $datas = $ReJsonData['data'];
//     if (is_null($ReJsonData)){
//         echo "Not ready yet";
//         include 'pages/footer.php';
//         sleep(2); 
//     }
// }
?>
<script>
    setTimeout("location.reload(true);", 5500);
</script>
<?php if (!is_null($ReJsonData)):?>
    <div class="panel-box">
        <table class="tableContainer">
                <thead>
                <tr>
                    <th colspan="3" style="text-align:center; color: #D4D4C9; font-family: Arial; font-size: 30px;"><?=$classroom;?></th>
                </tr>
                <tr class="entry_header" style="color: #D4D4C9; font-family: Arial;">
                    <th class="header-text-left" style="width:33%; text-align: left">First Name</th>
                    <th class="header-text-center" style="width:33%; text-align: left">Last Name</th>
                    <th class="header-text-center" style="width:33%; text-align: center">Check-In Time</th>
                </tr>
            </thead>
            <tbody class="dashboard_table_body">
                <?php foreach($datas as $data):?>
                    <tr>
                        <td class="body-text-left"><?php echo ucfirst($data['first_name']); ?></td>
                        <td class="body-text-left"><?php echo ucfirst($data['last_name']); ?></td>
                        <td class="body-text-center"><?php echo timeConvert($data['check_in_time']); ?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
<?php endif;?>
<?php include 'pages/footer.php';?>












