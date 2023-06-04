<?php 

require '../database/load.php';

$id = $_GET['id'];

// echo $id;
$deleteStatus = deleteUser($id);
// echo "check in status: ".$deleteStatus."<br>";



if (!$deleteStatus){
    echo "Error....";
}else{
    redirect('/users/users.php', false);
}
