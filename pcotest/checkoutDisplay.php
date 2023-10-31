<?php
	include 'config.php';
	date_default_timezone_set("America/New_York");
	$checkoutData = curl_init();
	curl_setopt($checkoutData, CURLOPT_URL, $APIURL . "&where[created_at]=" . date("Y-m-d") . "&per_page=15&order=-checked_out_at&include=locations");
	curl_setopt($checkoutData, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($checkoutData, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($checkoutData, CURLOPT_USERPWD, "$APIUser:$APIPass");
	
	$checkoutResponse = curl_exec($checkoutData);
	
	$jsonCheckout = json_decode($checkoutResponse, true);
	curl_close($checkoutData);
	$locationsArray = explode(",",$_GET['locations']);

?>

<html>
<head>
 <style>
 body{
   text-align: right;
 }

 h1{
   font-size: 60px;
   color: white;
  background-color: rgba(0, 0, 0, 0.5);
  display: inline-block;
  margin: 2px;

 }

  .child {
    text-align: right;
    font-size: 50px;
    padding: 5px;
    padding-left: 20px;
    padding-right: 20px;
    color: white;
    background-color: rgba(0, 0, 0, 0.5);
    //float: right;
    display: inline-block;
  }
 </style>
 <meta http-equiv="refresh" content="2">
</head>
<body>
  <h1>Pickup:</h1><br>
<?php
foreach($jsonCheckout['data'] as $checkoutEvent){
	if(!empty($checkoutEvent['attributes']['checked_out_at'])){
		if(in_array($checkoutEvent['relationships']['locations']['data'][0]['id'], $locationsArray)){
			echo "<div class='child'>" . $checkoutEvent['attributes']['first_name'] . " " . $checkoutEvent['attributes']['last_name'] . "</div><br>";
		}
	}	
}
?>

</body>
</html>
