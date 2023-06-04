<?php

/*--------------------------------------------------------------*/
/* Function for Creting random string
/*--------------------------------------------------------------*/


/**
 *
 * @param unknown $length (optional)
 * @return unknown
 */
function randString($length = 5) {
	$str='';
	$cha = "0123456789abcdefghijklmnopqrstuvwxyz";

	for ($x=0; $x<$length; $x++)
		$str .= $cha[mt_rand(0, strlen($cha))];
	return $str;
}

function redirect($url, $permanent = false) {
	if (headers_sent() === false) {
		header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
	}
	exit();
}

function getTime()
{
 return array_sum(explode(" ",microtime()));  
}
/**
 *
 * @param unknown $str
 * @return unknown
 */
function remove_junk($str) {
	$str = nl2br($str);
	$str = trim($str);
	$str = stripslashes($str);
	$str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
	return $str;
}
function first_character($str) {
	$val = str_replace('-', " ", $str);
	$val = ucfirst($val);
	return $val;
}
function make_date() {
	return strftime("%Y-%m-%d %H:%M:%S", time());
}
function display_msg($msg ='') {
	$output = array();
	if (!empty($msg)) {
		foreach ($msg as $key => $value) {
			$output  = "<div class=\"alert alert-{$key}\">";
			$output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>";
			$output .= remove_junk(first_character($value));
			$output .= "</div>";
		}
		return $output;
	} else {
		return "" ;
	}
}
/**
 *
 * @param unknown $var
 * @return unknown
 */
function validate_fields($var) {
	global $errors;
	foreach ($var as $field) {
		$val = remove_junk($_POST[$field]);
		if (isset($val) && $val=='') {
			$errors = $field ." can't be blank.";
			return $errors;
		}
	}
}


function checkIn($id,$time){
	$checkINstatus = updateStatusIN($id,$time);
	$results = findComponentStatusID($id)[0];

	$radioID        = $results['radioID'];
	$dsmID          = $results['dsmID'];
	$flashlightID   = $results['flashlightID'];
	$tourniquetID   = $results['tourniquetID'];
	$ubID           = $results['ubID'];

	changeStatus($radioID,"radio","Checked In");
	if($dsmID){changeStatus($dsmID,"dsm","Checked In");}
	if($flashlightID){changeStatus($flashlightID,"flashlights","Checked In");}
	if($tourniquetID){changeStatus($tourniquetID,"tourniquets","Checked In");}
	if($ubID){changeStatus($ubID,"ub","Checked In");}

	if (!$checkINstatus){
		echo "Error....";
	}else{
		redirect('../gearpage/gearpage.php', false);
	}
	
}
function checkOut($id){
	$checkOUTstatus = updateStatusOut($id);
	// echo "check in status: ".$checkOUTstatus."<br>";
	
	$results = findComponentStatusID($id)[0];
	$radioID        = $results['radioID'];
	$dsmID          = $results['dsmID'];
	$flashlightID   = $results['flashlightID'];
	$tourniquetID   = $results['tourniquetID'];
	$ubID           = $results['ubID'];

	changeStatus($radioID,"radio","Checked Out");
	if($dsmID){changeStatus($dsmID,"dsm","Checked Out");}
	if($flashlightID){changeStatus($flashlightID,"flashlights","Checked Out");}
	if($tourniquetID){changeStatus($tourniquetID,"tourniquets","Checked Out");}
	if($ubID){changeStatus($ubID,"ub","Checked Out");}
	
	
	if (!$checkOUTstatus){
		echo "Error....";
	}else{
		redirect('../gearpage/gearpage.php', false);
	}

}