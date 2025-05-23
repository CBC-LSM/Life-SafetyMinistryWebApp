<?php
/**
 * includes/session.php
 *
 * @package default
 */


session_start();

class Session {

	public $msg;
	private $user_is_logged_in = false;


	/**
	 *
	 */
	function __construct() {
		$this->flash_msg();
		$this->userLoginSetup();
	}


	/**
	 *
	 * @return unknown
	 */
	public function isUserLoggedIn() {
		if (isset($_SESSION['user_id'])) {
			$this->user_is_logged_in = true;
		} else {
			$this->user_is_logged_in = false;
		}
		return $this->user_is_logged_in;
	}


	/**
	 *
	 * @param unknown $user_id
	 */
	public function login($user_id) {
		$_SESSION['user_id'] = $user_id;
	}
	public function userName($username) {
		$_SESSION['username'] = $username;
	}
	public function userLevel($userLevel) {
		$_SESSION['userLevel'] = $userLevel;
	}
	


	/**
	 *
	 */
	private function userLoginSetup() {
		if (isset($_SESSION['user_id'])) {
			$this->user_is_logged_in = true;
		} else {
			$this->user_is_logged_in = false;
		}

	}


	/**
	 *
	 */
	public function logout() {
		unset($_SESSION['user_id']);
		unset($_SESSION['username']);
		unset($_SESSION['userLevel']);
	}


	/**
	 *
	 * @param unknown $type (optional)
	 * @param unknown $msg  (optional)
	 * @return unknown
	 */
	public function msg($type ='', $msg ='') {
		if (!empty($msg)) {
			if (strlen(trim($type)) == 1) {
				$type = str_replace( array('d', 'i', 'w', 's'), array('danger', 'info', 'warning', 'success'), $type );
			}
			$_SESSION['msg'][$type] = $msg;
		} else {
			return $this->msg;
		}
	}


	/**
	 *
	 */
	private function flash_msg() {

		if (isset($_SESSION['msg'])) {
			$this->msg = $_SESSION['msg'];
			unset($_SESSION['msg']);
		} else {
			$this->msg;
		}
	}


}


$session = new Session();
$msg = $session->msg();

?>
