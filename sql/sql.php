<?php
/**
 * includes/sql.php
 *
 * @package default
 */


require_once 'database/load.php';

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
function findAllPositions(){
	global $db;
	$sql = "SELECT * FROM `positions` ORDER by `positionname` ASC";
	$result = find_by_sql($sql);
	return $result;
}
function findAllTeamStatus(){
	global $db;
	$sql = "SELECT s.id,s.nameID,s.positionID,s.radioID,s.dsmID,s.flashlightID,";
	$sql .= "s.tourniquetID,m.membername,p.positionname,r.radioname,d.dsmname,t.tourniquetname,f.flashlightname from teamStatus s LEFT JOIN teamMembers m ON ";
	$sql .= "s.nameID=m.id LEFT JOIN positions p on s.positionID = p.id ";
	$sql .= "LEFT JOIN radio r on s.radioID = r.id LEFT JOIN dsm d on ";
	$sql .= "s.dsmID =d.id LEFT JOIN flashlights f on s.flashlightID = ";
	$sql .= "f.id LEFT JOIN tourniquets t ON s.tourniquetID = t.id";
	$result = find_by_sql($sql);
	return $result;
}

function TestfindAllTeamStatus(){
	global $db;
	$sql = "SELECT * FROM `teamStatus`";
	$result = find_by_sql($sql);
	return $result;
}
?>



