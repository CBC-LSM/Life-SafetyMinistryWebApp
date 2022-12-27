<?php
/**
 * add_user.php
 *
 * @package default
 */



require_once '../database/load.php';

$groups = find_all('user_groups');

$all_users = find_all_user();

if (isset($_POST['add_user'])) {
	$req_fields = array('full-name', 'username', 'password', 'level' );
	validate_fields($req_fields);

	if (empty($errors)) {
		$name   = remove_junk($db->escape($_POST['full-name']));
		$username   = strtolower(remove_junk($db->escape($_POST['username'])));

		foreach ($all_users as $a_user) {
			if ( $username == $a_user['username'] ) {
				//failed
				$session->msg('d', ' Sorry, username already used!');
				redirect('../users/users.php', false);
			}
		}

    $password   = remove_junk($db->escape($_POST['password']));
    $confirmpassword = remove_junk($db->escape($_POST['confirmpassword']));
    
    if ($password !== $confirmpassword){
      $session->msg('d', "Passwords are not the same");
			redirect('../users/users.php', false);
    }

		$user_level = (int)$db->escape($_POST['level']);
		$password = sha1($password);
		$query = "INSERT INTO users (";
		$query .="name,username,password,user_level,status";
		$query .=") VALUES (";
		$query .=" '{$name}', '{$username}', '{$password}', '{$user_level}','1'";
		$query .=")";
		if ($db->query($query)) {
			//sucess
			$session->msg('s', "User account has been created! ");
			redirect('../users/users.php', false);
		} else {
			//failed
			$session->msg('d', ' Sorry, failed to create account!');
			redirect('../users/users.php', false);
		}
	} else {
		$session->msg("d", $errors);
		redirect('../users/users.php', false);
	}
}