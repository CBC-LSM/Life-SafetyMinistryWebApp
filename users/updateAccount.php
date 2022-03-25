<?php
/**
 * add_user.php
 *
 * @package default
 */
require_once '../database/load.php';

$id = $_POST['id'];
$ename = $_POST['name'];
$euserName = $_POST['username'];
$estatus = $_POST['status'];
$euserlevel = $_POST['userlevel'];
$redirectURL = $_POST['redirect'];


if (empty($ename)){
    $session->msg("d", "Name cannot be blank");
    redirect($redirectURL, false);
}
if (empty($euserName)){
    $session->msg("d", "username cannot be blank");
    redirect($redirectURL, false);
}

$query = "UPDATE `users` SET `name`='{$ename}',`username`='{$euserName}',`status`='{$estatus}',`user_level`='{$euserlevel}' WHERE `id` = '{$id}'";
if ($db->query($query)) {
    //sucess
        $session->msg('s', "Account Updated");
        redirect($redirectURL, false);
}else {
    //failed
    $session->msg('d', ' Sorry, failed to Update');
    redirect($redirectURL, false);
}