<?php
/**
 * add_user.php
 *
 * @package default
 */
require_once '../database/load.php';
echo "hello bliss <br>";
//update user image
if (isset($_POST['submit'])) {
	echo "hello bliss1 <br>";
	$photo = new Media();
	$user_id = $_POST['id'];
	$photo->upload($_FILES['file_upload']);
	echo "hello bliss2 <br>";
	if ($photo->process_user($user_id)) {
		echo "hello bliss4 <br>";
		$session->msg('s', 'photo has been uploaded.');
		redirect('../users/users.php',false);
	}else {
		echo "hello bliss3 <br>";
		$session->msg('d', join($photo->errors));
		redirect('../users/users.php',false);
	}
	echo "hello bliss6 <br>";
}