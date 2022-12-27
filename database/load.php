<?php
/**
 * includes/load.php
 *
 * @package default
 * @see index.php
 */

define("URL_SEPARATOR", '/');
define("DS", DIRECTORY_SEPARATOR);
defined('SITE_ROOT')? null: define('SITE_ROOT', realpath(dirname(__FILE__)));
define("LIB_PATH_INC", SITE_ROOT.DS);


require_once LIB_PATH_INC.'config.php';
require_once LIB_PATH_INC.'../sql/functions.php';
require_once LIB_PATH_INC.'../database/session.php';
require_once LIB_PATH_INC.'database.php';
require_once LIB_PATH_INC.'../sql/sql.php';
require_once LIB_PATH_INC.'../database/upload.php';

// include LIB_PATH_INC.'../users/edit_user_modal.php';
// include LIB_PATH_INC.'../users/edit_password_modal.php.php';


date_default_timezone_set('America/New_York');

// if (isset( $_SESSION['user_id'] )) {
// $userLevel = userLevelReturn($_SESSION['user_id']);
// }else{
// 	$userLevel = 5;
// }


/*--------------------------------------------------------------*/
/* Log user actions
/*--------------------------------------------------------------*/
$user_id = 0;
$remote_ip = 0;
$action =  '';
if (isset( $_SESSION['user_id'] )) {
	$user_id = $_SESSION['user_id'];
}
if ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
	$remote_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	if ( strpos( $remote_ip, "," ) > 0 ) {
		$remote_ip_for = explode( ",", $remote_ip );
		$remote_ip = $remote_ip_for[0];
	}
} else {

	if (isset( $_SERVER['REMOTE_ADDR'] )) {
		$remote_ip = $_SERVER['REMOTE_ADDR'];
	}

}

if (isset( $_SERVER['REQUEST_URI'] )) {
	$action = $_SERVER['REQUEST_URI'];
	$action = preg_replace('/^.+[\\\\\\/]/', '', $action);
	//$action = preg_replace('/^\/inventory/', '', $action);
}

if ($remote_ip == "66.161.152.202" && $action =="/dashboard.php"){
	//logAction( $user_id, $remote_ip, $action );
}else{
	logAction( $user_id, $remote_ip, $action );
}