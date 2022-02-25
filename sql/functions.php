<?php

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
		redirect('index.php', false);
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
		redirect('index.php', false);
	}

}