<?php
/**
 * add_user.php
 *
 * @package default
 */
require_once '../database/load.php';

$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];
$id = $_POST['id'];

if (empty($password) || empty($confirmPassword)){
    $session->msg("d", "Password is blank!");
    redirect('../users/users.php', false);
}

if($password == $confirmPassword){
    $password = sha1($password);
    $query = "UPDATE `users` SET `password`='{$password}' WHERE `id` = '{$id}'";
    if ($db->query($query)) {
        //sucess
			$session->msg('s', "Password Updated");
			redirect('../users/users.php', false);
    }else {
        //failed
        $session->msg('d', ' Sorry, failed to Update');
        redirect('../users/users.php', false);
    }
}else{
    $session->msg("d", "Passwords did not match...");
    redirect('../users/users.php', false);
}

