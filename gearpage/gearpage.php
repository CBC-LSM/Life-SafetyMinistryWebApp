<?php
/**
 * includes/load.php
 *
 * @package default
 * @see index.php
 */


$pageName = "CBC Life and Safety Ministry";
include '../database/load.php';
if (!$session->isUserLoggedIn()){redirect("/",false);}
include '../pages/header.php';
?>


<?php include '../gearpage/loggedgear.php';?>


<?php include '../pages/footer.php';?>