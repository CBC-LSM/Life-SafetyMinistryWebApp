<?php
/**
 * includes/load.php
 *
 * @package default
 * @see index.php
 */

require_once 'database/config.php';
require_once 'sql/functions.php';
require_once 'database/database.php';
require_once 'sql/sql.php';
date_default_timezone_set('America/New_York');


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

// logAction( $user_id, $remote_ip, $action );