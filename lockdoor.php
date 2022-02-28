<?php
/**
 * add_order.php
 *
 * @package default
 */

include 'database/load.php';

$id = $_GET['id'];

//get id of door
// make SQL function to set door to locked and give time of locking.

$time   = date('Y-m-d H:i:s ');
$status = 'Locked';

$doorstatuschange = doorstatuschange($id,$status,$time);

if (!$doorstatuschange){
    echo "Error on change...";
}else{
    //redirect to index.php for now, create a new dynamic page stating door has been changed to locked for app users.
    redirect('index.php', false);
}