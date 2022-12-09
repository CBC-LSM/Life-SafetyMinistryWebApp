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
function find_all_user() {
	global $db;
	$results = array();
	$sql = "SELECT u.id,u.name,u.username,u.user_level,u.status,u.last_login,u.lastrfidscan,u.RFIDtag,";
	$sql .="g.group_name,g.group_level,u.img ";
	$sql .="FROM users u ";
	$sql .="LEFT JOIN user_groups g ";
	$sql .="ON g.group_level=u.user_level ORDER BY u.name ASC";
	$results = find_by_sql($sql);
	return $results;
}
function find_user($id) {
	global $db;
	$results = array();
	$sql = "SELECT u.id,u.name,u.username,u.user_level,u.status,u.last_login,";
	$sql .="g.group_name,g.group_level ";
	$sql .="FROM users u ";
	$sql .="LEFT JOIN user_groups g ";
	$sql .="ON g.group_level=u.user_level WHERE u.id = '{$id}'";
	$results = find_by_sql($sql);
	return $results;
}
function find_all_groups() {
	global $db;
	$sql = "SELECT `group_name`,`group_level` from `user_groups` WHERE 1";
	$results = find_by_sql($sql);
	return $results;
}
function deleteUser($id){
	global $db;
	$sql = "DELETE FROM `users` WHERE `users`.`id` = '{$id}';";
	$db->query($sql);
	return ($db->affected_rows() === 1) ? true : false;
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
function tableExists($table) {
	global $db;
	$table_exit = $db->query('SHOW TABLES FROM '.DB_NAME.' LIKE "'.$db->escape($table).'"');
	if ($table_exit) {
		if ($db->num_rows($table_exit) > 0)
			return true;
		else
			return false;
	}
}
function updateLastLogIn($user_id) {
	global $db;
	$date = make_date();
	$sql = "UPDATE users SET last_login='{$date}' WHERE id ='{$user_id}' LIMIT 1";
	$result = $db->query($sql);
	return $result && $db->affected_rows() === 1 ? true : false;
}
function authenticate($username='', $password='') {
	global $db;
	$username = $db->escape($username);
	$password = $db->escape($password);
	$sql  = sprintf("SELECT id,username,password,user_level FROM users WHERE username ='%s' LIMIT 1", $username);
	$result = $db->query($sql);
	if ($db->num_rows($result)) {
		$user = $db->fetch_assoc($result);
		$password_request = sha1($password);
		if ($password_request === $user['password'] ) {
			return $user['id'];
		}
	}
	return false;
}
function userNameReturn($user_id){
	global $db;
	$sql = "SELECT `name` FROM users where `id`={$user_id}";
	$result = find_by_sql($sql);
	return $result[0][0];
}
function userLevelReturn($user_id){
	global $db;
	$sql = "SELECT `user_level` FROM users where `id`={$user_id}";
	$result = find_by_sql($sql);
	return $result[0][0];
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
	$sql = "SELECT * FROM `teamMembers` WHERE 1 ORDER by `membername` ASC";
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
function findallwithoutdate(){
	global $db;
	$sql = "SELECT s.id,s.nameID,s.positionID,s.radioID,s.dsmID,s.flashlightID,s.status,s.checkout,";
	$sql .= "s.tourniquetID,s.ubID,m.membername,p.positionname,r.radioname,d.dsmname,t.tourniquetname,f.flashlightname,u.ubname from teamStatus s LEFT JOIN teamMembers m ON ";
	$sql .= "s.nameID=m.id LEFT JOIN positions p on s.positionID = p.id ";
	$sql .= "LEFT JOIN radio r on s.radioID = r.id LEFT JOIN dsm d on ";
	$sql .= "s.dsmID =d.id LEFT JOIN flashlights f on s.flashlightID = ";
	$sql .= "f.id LEFT JOIN tourniquets t ON s.tourniquetID = t.id LEFT JOIN ub u on s.ubID = u.id;";
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
	// die(var_dump($result));
	return $result;
}
function findPositionID($name){
	global $db;
	$sql = "SELECT `id` FROM `positions` WHERE `positionname` ='{$name}'";
	// die(print_r($sql));
	$result = find_by_sql($sql);
	// die(var_dump($result));
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
function editCheckOut($id,$nameID,$position,$radio,$dsm,$flashlight,$tourniquet,$utility_bag,$checkouttime){
	global $db;
	$sql = "UPDATE `teamStatus` SET `id`='{$id}',`nameID`='{$nameID}',`positionID`='{$position}',`radioID`='{$radio}',";
	$sql .= "`dsmID`='{$dsm}',`flashlightID`='{$flashlight}',`tourniquetID`='{$tourniquet}',`ubID`='{$utility_bag}',`status`='Checked Out',";
	$sql .= "`checkout`='{$checkouttime}' WHERE `id`='{$id}'";
	// die(print_r($sql));
	$result = find_by_sql($sql);
	$db->query($sql);
	return ($db->affected_rows() === 1) ? true : false;
}
function roverchecklist(){
	global $db;
	$sql = "SELECT * FROM `roverchecklist` WHERE 1";
	$result = find_by_sql($sql);
	return $result;
}
function roverComplete($id,$table,$status,$date){
	global $db;
	$sql = "UPDATE `{$table}` SET `status` = '{$status}',`timestamp`='{$date}' WHERE `id` = '{$id}'";
	$db->query($sql);
	return ($db->affected_rows() === 1) ? true : false;
}
function findUserID($name){
	global $db;
	$sql = "SELECT `id` FROM `users` WHERE `name` ='{$name}'";
	$result = find_by_sql($sql);
	// die(var_dump($result));
	return $result[0][0];
}

// RFID Functions 

function updateRFIDRegistration($tagid,$userID,$date){
	global $db;
	$sql = "UPDATE `users` SET `RFIDtag` = '{$tagid}', `lastrfidscan` = '{$date}' ";
	$sql .= "WHERE `id`= '{$userID}';";
	$db->query($sql);
	// return ($db->affected_rows() === 1) ? true : false;
}
function find_all_RFID_user(){
	global $db;
	$sql = "SELECT * FROM `RFID` WHERE 1";
	$result = find_by_sql($sql);
	return $result;
}
function findallrfidlogs(){
	global $db;
	$sql = "SELECT u.name, d.doorName, r.tagid, r.Status, r.timestamp FROM rfidlog r ";
	$sql .="LEFT JOIN users u ON r.userid = u.id LEFT JOIN rfidDoors d ON r.doorName = d.id ";
	$sql .= "ORDER BY r.timestamp DESC LIMIT 25";
	// die(print_r)
	$result = find_by_sql($sql);
	return $result;
}
function findalldoors(){
	global $db;
	$sql = "SELECT * FROM rfidDoors";
	$result = find_by_sql($sql);
	// die(var_dump($result));
	return $result;
}
function updateAccessLog($tagid,$userid,$doorname,$status,$date){
	global $db;
	$sql = "INSERT INTO `rfidlog`(`id`, `tagid`, `userid`, `doorname`, `Status`, `timestamp`) VALUES ('','{$tagid}','{$userid}','{$doorname}','{$status}','{$date}')";
	$db->query($sql);
	return ($db->affected_rows() === 1) ? true : false;
}
 function find_rfid($tagid){
	global $db;
	$sql = "SELECT * FROM `users` WHERE `RFIDtag` like '{$tagid}'";
	$result = find_by_sql($sql);
	return $result;
 }	

 function adddoorscheduletodb($doorid,$startday,$starttime,$endday,$endtime,$action){
	 global $db;
	 $sql = "INSERT INTO `rfiddoorschedule`(`id`, `doorid`, `startday`, `starttime`, `endday`, `endtime`, `action`) ";
	 $sql .= "VALUES ('','{$doorid}','{$startday}','{$starttime}','{$endday}','{$endtime}','{$action}')";
	 $db->query($sql);
	 return ($db->affected_rows() === 1) ? true : false;
 }
function finddoorschedule(){
	global $db;
	$sql = "SELECT d.id, d.doorid, d.startday, d.starttime, d.endday, d.endtime, d.action, r.doorName FROM ";
	$sql .="`rfiddoorschedule` d left JOIN rfidDoors r ON r.id = d.doorid ORDER by d.doorid ASC";
	$result = find_by_sql($sql);
	return $result;
}
function deleteschedule($id){
	global $db;
	$sql = "DELETE FROM `rfiddoorschedule` WHERE `id` = '{$id}';";
	// die(print_r($sql));
	$db->query($sql);
	return ($db->affected_rows() === 1) ? true : false;
}
function editdoorschedule($id,$doorid,$startday,$starttime,$endday,$endtime,$action){
	global $db;
	$sql = "UPDATE `rfiddoorschedule` SET `doorid`='{$doorid}',`startday`='{$startday}',`starttime`='{$starttime}',`endday` = '{$endday}',"; 
	$sql .="`endtime` = '{$endtime}',`action`='{$action}' ";
	$sql .= "WHERE `rfiddoorschedule`.`id` = '{$id}';";
	$db->query($sql);
	return ($db->affected_rows() === 1) ? true : false;
}
?>



