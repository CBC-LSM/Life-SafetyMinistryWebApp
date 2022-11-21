<?php
/**
 * add_order.php
 *
 * @package default
 */

include '../database/load.php';

$id = $_POST['id'];
$name =$_POST['name'];

$date   = date('Y-m-d H:i:s ');


addToRFIDRegistration($id,$name,$date);


$added = addTeamStatus($nameID,$positionID,$radioID,$dsmID,$flashlightID,$tourniquetID,$ubID,$checkouttime);
