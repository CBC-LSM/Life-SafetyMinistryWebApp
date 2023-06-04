<?php 

function findAllSCnames(){
	global $db;
	$sql = "SELECT * FROM `teamMembers` WHERE 1 ORDER by `membername` ASC";
	$result = find_by_sql($sql);
	return $result;
}
function findAllSCRadios(){
	global $db;
	$sql = "SELECT * FROM `SCRadio` WHERE 1";
    $result = find_by_sql($sql);
	return $result;
}
function findAllSCPositions(){
	global $db;
	$sql = "SELECT * FROM `SCPositions` ORDER by `positionname` ASC";
	$result = find_by_sql($sql);
	return $result;
}
function findAllSCTeamStatus($date1,$date2){
	global $db;
	$sql = "SELECT scGS.id,scGS.nameID,scGS.positionID,scGS.radioID,scGS.status,scGS.checkout,";
	$sql .= "m.membername,scPos.positionname,scRad.radioname from SCGearStatus scGS LEFT JOIN teamMembers m ON ";
	$sql .= "scGS.nameID=m.id LEFT JOIN SCPositions scPos on scGS.positionID = scPos.id ";
	$sql .= "LEFT JOIN SCRadio scRad on scGS.radioID = scRad.id ";
	$sql .= "where scGS.checkout between '{$date1}' and '{$date2}' order by scGS.status ASC;";
	// die(print_r($sql));
	$result = find_by_sql($sql);
	return $result;
}
function findSCPositionID($name){
	global $db;
	$sql = "SELECT `id` FROM `SCPositions` WHERE `positionname` ='{$name}'";
	// die(print_r($sql));
	$result = find_by_sql($sql);
	// die(var_dump($result));
	return $result[0][0];
}
function findSCRadioID($name){
	global $db;
	$sql = "SELECT `id` FROM `SCRadio` WHERE `radioname` ='{$name}'";
	$result = find_by_sql($sql);
	return $result[0][0];
}
function changeSCStatus($id,$table,$currentStatus){
	global $db;
	$sql = "UPDATE `{$table}` SET `status` = '{$currentStatus}' WHERE `id` = '{$id}'";
	$db->query($sql);
	return ($db->affected_rows() === 1) ? true : false;
}
function addSCGearStatus($nameID,$positionID,$radioID,$checkouttime){
	global $db;
	$sql = "INSERT INTO `SCGearStatus`(`id`,`nameID`, `positionID`, `radioID`, "; 
	$sql .= "`status`, `checkout`) VALUES ";
    $sql .= "('','{$nameID}','{$positionID}','{$radioID}','Checked Out','{$checkouttime}');";
    // die(print_r($sql));
	$db->query($sql);
	return ($db->affected_rows() === 1) ? true : false;
}
function findSCComponentStatusID($id){
	global $db;
	$sql = "SELECT * FROM `SCGearStatus` WHERE `id` ='{$id}'";
	$result = find_by_sql($sql);
	return $result;
}
function editSCCheckOut($id,$nameID,$position,$radio,$checkouttime){
	global $db;
	$sql = "UPDATE `SCGearStatus` SET `id`='{$id}',`nameID`='{$nameID}',`positionID`='{$position}',`radioID`='{$radio}',";
	$sql .= "`status`='Checked Out',";
	$sql .= "`checkout`='{$checkouttime}' WHERE `id`='{$id}'";
	// die(print_r($sql));
	$result = find_by_sql($sql);
	$db->query($sql);
	return ($db->affected_rows() === 1) ? true : false;
}
function checkSCIn($id,$time){
	$checkINstatus = updateSCStatusIN($id,$time);
	$results = findSCComponentStatusID($id)[0];

	$radioID = $results['radioID'];

	changeStatus($radioID,"SCRadio","Checked In");

    if (!$checkINstatus){
		echo "Error....";
	}else{
		redirect('../SportsCamp/index.php', false);
	}
	
}
function checkSCOut($id){
	$checkOUTstatus = updateSCStatusOut($id);
	// echo "check in status: ".$checkOUTstatus."<br>";
	
	$results = findSCComponentStatusID($id)[0];
	$radioID        = $results['radioID'];
	
	changeSCStatus($radioID,"SCRadio","Checked Out");
		
	if (!$checkOUTstatus){
		echo "Error....";
	}else{
		redirect('../SportsCamp/index.php', false);
	}

}
function updateSCStatusIN($id,$time){
	global $db;
	$sql = "UPDATE `SCGearStatus` SET `status` = 'Checked In',`checkin` = '{$time}' WHERE `id` = '{$id}'";
	$db->query($sql);
	return ($db->affected_rows() === 1) ? true : false;
}
function updateSCStatusOut($id){
	global $db;
	$sql = "UPDATE `SCGearStatus` SET `status` = 'Checked Out' WHERE `SCGearStatus`.`id` = '{$id}'";
	$db->query($sql);
	return ($db->affected_rows() === 1) ? true : false;
}
function deleteSCEntry($id){
	global $db;
	$sql = "DELETE FROM `SCGearStatus` WHERE `SCGearStatus`.`id` = '{$id}';";
	$db->query($sql);
	return ($db->affected_rows() === 1) ? true : false;
}
?>