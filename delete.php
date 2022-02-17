<?php 

require 'database/load.php';

$id = $_GET['id'];
// echo $id;
$deleteStatus = deleteEntry($id);
// echo "check in status: ".$deleteStatus."<br>";

if (!$deleteStatus){
    echo "Error....";
}else{
    redirect('index.php', false);
}
