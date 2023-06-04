<?php
/**
 * auth.php
 *
 * @package default
 */


include_once '../database/load.php';

$req_fields = array('username', 'password' );
validate_fields($req_fields);
$username = remove_junk($_POST['username']);
$password = remove_junk($_POST['password']);

// echo $username."<br>";
// echo $password."<br>";

if (empty($errors)) {
	$user_id = authenticate($username, $password);
	
	if ($user_id) {
		//create session with id
		$session->login($user_id);
		//Update Sign in time
		updateLastLogIn($user_id);
		$userName = userNameReturn($user_id);
		$session ->userName($userName);
		$session ->userLevel(userLevelReturn($_SESSION['user_id']));
		$session->msg("s", "Welcome {$userName}");
		redirect('../pages/index.php', false);

	} else {
		
		$session->msg("d", "Sorry Username/Password Incorrect.");
		redirect('/users/index.php', false);
	}

} else {
	$session->msg("d", $errors);
	redirect('index.php', false);
}

?>
