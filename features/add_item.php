<?php
/**
 * add_user.php
 *
 * @package default
 */

require_once '../database/load.php';

$newItem = $_POST['text_input'];
$query = "INSERT INTO `roverchecklist` (`item`,`status`) values ('{$newItem}','Not Complete')";
// die(print_r($query));
if ($db->query($query)) {
    //sucess
    $session->msg('s', "Item Added to Check List! ");
    redirect('../gearpage/add_rover_checklist.php', false);
} else {
    //failed
    $session->msg('d', ' Sorry, failed to add!');
    redirect('../gearpage/add_rover_checklist.php', false);
}
