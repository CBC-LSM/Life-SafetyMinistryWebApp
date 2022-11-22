<?php
/**
 * add_order.php
 *
 * @package default
 */

include '../database/load.php';

$tagid = $_POST['id'];
$name =$_POST['name'];

$date   = date('Y-m-d H:i:s ');

$userID= findUserID($name);

updateRFIDRegistration($tagid,$userID,$date);