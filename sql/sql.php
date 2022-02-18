<?php
/**
 * includes/sql.php
 *
 * @package default
 */


// require_once 'database/load.php';

/**
 *
 * @param unknown $table
 * @return unknown
 */
function find_all($table) {
	global $db;
	if (tableExists($table)) {
		return find_by_sql("SELECT * FROM ".$db->escape($table));
	}
}

/**
 *
 * @param unknown $sql
 * @return unknown
 */
function find_by_sql($sql) {
	global $db;
	$result = $db->query($sql);
	$result_set = $db->while_loop($result);
	return $result_set;
}

function logAction($user_id, $remote_ip, $action) {
	global $db;
	$date = make_date();
	$sql  = "INSERT INTO log (user_id,remote_ip,action,date)";
	$sql .= " VALUES ('{$user_id}','{$remote_ip}','{$action}','{$date}')";
	$result = $db->query($sql);
	return $result && $db->affected_rows() === 1 ? true : false;
}

function findAllnames(){
	global $db;
	$sql = "SELECT `membername` FROM `teamMembers` WHERE 1 ORDER by `membername` ASC";
	$result = find_by_sql($sql);
	return $result;
}
function findAllRadios(){
	global $db;
	$sql = "SELECT * FROM `radio` WHERE 1";
	$result = find_by_sql($sql);
	return $result;
}
function findAllDSMs(){
	global $db;
	$sql = "SELECT * FROM `dsm` WHERE 1";
	$result = find_by_sql($sql);
	return $result;
}
function findAllflashlights(){
	global $db;
	$sql = "SELECT * FROM `flashlights` WHERE 1";
	$result = find_by_sql($sql);
	return $result;
}
function findAllTourniquets(){
	global $db;
	$sql = "SELECT * FROM `tourniquets` WHERE 1";
	$result = find_by_sql($sql);
	return $result;
}
function findAllUtilityBags(){
	global $db;
	$sql = "SELECT * FROM `ub` WHERE 1";
	$result = find_by_sql($sql);
	return $result;
}
function findAllPositions(){
	global $db;
	$sql = "SELECT * FROM `positions` ORDER by `positionname` ASC";
	$result = find_by_sql($sql);
	return $result;
}
function findAllTeamStatus($date1,$date2){
	global $db;
	$sql = "SELECT s.id,s.nameID,s.positionID,s.radioID,s.dsmID,s.flashlightID,s.status,s.checkout,";
	$sql .= "s.tourniquetID,s.ubID,m.membername,p.positionname,r.radioname,d.dsmname,t.tourniquetname,f.flashlightname,u.ubname from teamStatus s LEFT JOIN teamMembers m ON ";
	$sql .= "s.nameID=m.id LEFT JOIN positions p on s.positionID = p.id ";
	$sql .= "LEFT JOIN radio r on s.radioID = r.id LEFT JOIN dsm d on ";
	$sql .= "s.dsmID =d.id LEFT JOIN flashlights f on s.flashlightID = ";
	$sql .= "f.id LEFT JOIN tourniquets t ON s.tourniquetID = t.id LEFT JOIN ub u on s.ubID = u.id where s.checkout between '{$date1}' and '{$date2}' ;";
	// die(print_r($sql));
	$result = find_by_sql($sql);
	return $result;
}
function nameCheck($name){
	global $db;
	$sql = "SELECT * FROM `teamMembers` WHERE `membername` ='{$name}'";
	// die(var_dump($sql));
	$db->query($sql);		
	return ($db->affected_rows() === 1) ? true : false;
}
function addNameToTeamMembers($name){
	global $db;
	$sql = "INSERT INTO `teamMembers`(`id`, `membername`) VALUES ('','{$name}');";
	$db->query($sql);
	$rowid= findNameID($name);
	// die(var_dump($rowid));
	return $rowid[0][0];
}
function addTeamStatus($nameID,$positionID,$radioID,$dsmID,$flashlightID,$tourniquetID,$ubID,$checkouttime){
	global $db;
	$sql = "INSERT INTO `teamStatus`(`id`,`nameID`, `positionID`, `radioID`, `dsmID`, `flashlightID`,"; 
	$sql .= "`tourniquetID`, `ubID`, `status`, `checkout`) VALUES ";
	$sql .= "('','{$nameID}','{$positionID}','{$radioID}','{$dsmID}','{$flashlightID}','{$tourniquetID}','{$ubID}','Checked Out','{$checkouttime}');";
	$db->query($sql);
	return ($db->affected_rows() === 1) ? true : false;
}
function findNameID($name){
	global $db;
	$sql = "SELECT `id` FROM `teamMembers` WHERE `membername` ='{$name}'";
	$result = find_by_sql($sql);
	return $result;
}
function findPositionID($name){
	global $db;
	$sql = "SELECT `id` FROM `positions` WHERE `positionname` ='{$name}'";
	$result = find_by_sql($sql);
	return $result[0][0];
}
function findRadioID($name){
	global $db;
	$sql = "SELECT `id` FROM `radio` WHERE `radioname` ='{$name}'";
	$result = find_by_sql($sql);
	return $result[0][0];
}
function findDSMID($name){
	global $db;
	$sql = "SELECT `id` FROM `dsm` WHERE `dsmname` ='{$name}'";
	$result = find_by_sql($sql);
	return $result[0][0];
}
function findFlashlightID($name){
	global $db;
	$sql = "SELECT `id` FROM `flashlights` WHERE `flashlightname` ='{$name}'";
	$result = find_by_sql($sql);
	return $result[0][0];
}
function findTourniquetID($name){
	global $db;
	$sql = "SELECT `id` FROM `tourniquets` WHERE `tourniquetname` ='{$name}'";
	$result = find_by_sql($sql);
	return $result[0][0];
}
function findUbID($name){
	global $db;
	$sql = "SELECT `id` FROM `ub` WHERE `ubname` ='{$name}'";
	$result = find_by_sql($sql);
	return $result[0][0];
}
function updateStatusIN($id,$time){
	global $db;
	$sql = "UPDATE `teamStatus` SET `status` = 'Checked In',`checkin` = '{$time}' WHERE `id` = '{$id}'";
	$db->query($sql);
	return ($db->affected_rows() === 1) ? true : false;
}
function updateStatusOut($id){
	global $db;
	$sql = "UPDATE `teamStatus` SET `status` = 'Checked Out' WHERE `teamStatus`.`id` = '{$id}'";
	$db->query($sql);
	return ($db->affected_rows() === 1) ? true : false;
}
function deleteEntry($id){
	global $db;
	$sql = "DELETE FROM `teamStatus` WHERE `teamStatus`.`id` = '{$id}';";
	$db->query($sql);
	return ($db->affected_rows() === 1) ? true : false;
}
function changeStatus($id,$table,$currentStatus){
	global $db;
	$sql = "UPDATE `{$table}` SET `status` = '{$currentStatus}' WHERE `id` = '{$id}'";
	$db->query($sql);
	return ($db->affected_rows() === 1) ? true : false;
}
function findComponentStatusID($id){
	global $db;
	$sql = "SELECT * FROM `teamStatus` WHERE `id` ='{$id}'";
	$result = find_by_sql($sql);
	return $result;
}

?>



