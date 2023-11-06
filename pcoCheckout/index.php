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
   font-size: 80px;
   color: white;
  background-color: rgba(0, 0, 0, 0.5);
  display: inline-block;
  margin: 2px;

 }

  .child {
    text-align: right;
    font-size: 80px;
    padding: 5px;
    padding-left: 20px;
    padding-right: 20px;
    color: white;
    background-color: rgba(0, 0, 0, 0.5);
    //float: right;
    display: inline-block;
  }

  ul {
    display: table;
    margin: 0 auto;
    text-align: left;
  }
 </style>
 <?php
if(isset($_GET['locations'])){
?>
 <meta http-equiv="refresh" content="2">
<?php
}
?>

</head>
<body>
<?php
if(!isset($_GET['locations'])){
?>
<p>Locations Parameter not set.  Please add ?locations= followed by the location id's seperated by comma's to the end of the url.</0>
  <div class="locationsList">
  <ul>
    <li>Sunday Children's Ministry - EventID: 27354867</li>
	  <ul>
      <li>Baby Nursery - LocationID: 1452290</li>
      <li>Toddler Nursery - LocationID: 1452291</li>
      <li>Children's Ministry Admin - LocationID: 1452301</li>
      <li>Sunday School Hour - LocationID: 1452292</li>
      <ul>
        <li>2s and 3s - LocationID: 1452296</li>
        <li>4s and 5s - LocationID: 1452297</li>
        <li>K and 1st Grade - LocationID: 1452295</li>
        <li>2nd and 3rd Grade - LocationID: 1452293</li>
        <li>4th and 5th Grade - LocationID: 1452294</li>
      </ul>
      <li>Worship Hour - LocationID: 1452298</li>
        <ul>
        <li>Disciple Kids Worship Jr. - LocationID: 1452299</li>
        <li>Disciple Kids Worship - LocationID: 1452300</li>
        </ul>
  </ul>
  </ul>
  <ul>
    <li>AWANA - EventID: 27121386</li>
    <ul>
      <li>AWANA Staff - LocationID: 248040</li>
      <li>AWANA Security Checkin - LocationID: 261759</li>
      <li>Baby Nursery - LocationID: 261760</li>
      <li>Toddler Nursery - LocationID: 261761</li>
      <li>Puggles - LocationID: 233759</li>
      <li>Cubbies - LocationID: 233761</li>
      <li>Sparks - LocationID: 233760</li>
      <li>TNT - LocationID: 233762</li>
    </ul>
  </ul>
  </div>
<?php
}
?>
  <h1>Pickup:</h1><br>
<?php
foreach($jsonCheckout['data'] as $checkoutEvent){
	if(!empty($checkoutEvent['attributes']['checked_out_at'])){
    foreach($checkoutEvent['relationships']['locations']['data'] as $locationData){
      if(in_array($locationData['id'], $locationsArray)){
        echo "<div class='child'>" . $checkoutEvent['attributes']['first_name'] . " " . $checkoutEvent['attributes']['last_name'] . "</div><br>";
      break;
      }
    }

		
	}	
}
?>

</body>
</html>
