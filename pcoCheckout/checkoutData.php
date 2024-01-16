<?php
    header('Content-Type: application/json; charset=utf-8');
	include 'config.php';
	date_default_timezone_set("America/New_York");
	$checkoutData = curl_init();
	curl_setopt($checkoutData, CURLOPT_URL, $APIURL . "&where[created_at]=" . date("Y-m-d") . "&per_page=100&order=-checked_out_at&include=locations");
    curl_setopt($checkoutData, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($checkoutData, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($checkoutData, CURLOPT_USERPWD, "$APIUser:$APIPass");
	
	$checkoutResponse = curl_exec($checkoutData);
	
    $jsonCheckout = json_decode($checkoutResponse, true);
	curl_close($checkoutData);
    $locationsArray = explode(",",$_GET['locations']);

    $checkoutArray = array();
    foreach($jsonCheckout['data'] as $checkoutEvent){
        if(!empty($checkoutEvent['attributes']['checked_out_at'])){

        foreach($checkoutEvent['relationships']['locations']['data'] as $locationData){
            if(in_array($locationData['id'], $locationsArray)){
                $checkoutArray[] =  array(
                    "checkoutID" => $checkoutEvent['id'],
                    "firstName" => $checkoutEvent['attributes']['first_name'],
                    "lastName" => $checkoutEvent['attributes']['last_name']
                );
            break;
            }
        }

            
        }	
    }

$array = array("Product" => "Coffee", "Price" => 1.5);
/* The JSON string created from the array. */
$json = json_encode($checkoutArray);

echo $json;

?>