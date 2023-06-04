<?php
/**
 * includes/load.php
 *
 * @package default
 * @see index.php
 */


$pageName = "Sports Camp Gear Check";
include '../database/load.php';
include 'scSql.php'; //adding only the sql for sports camp
if (!$session->isUserLoggedIn()){redirect("/",false);}
include '../pages/header.php';
?>


<?php include '../SportsCamp/loggedgear.php';?>


<?php include '../pages/footer.php';?>