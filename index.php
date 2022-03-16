<?php
/**
 * includes/load.php
 *
 * @package default
 * @see index.php
 */


$pageName = "Sandbox CBC Gearpage";
require_once 'database/load.php';
include 'pages/header.php';

?>
<body style="background-color:#1E1E1E"></body>

<?php include 'pages/loggedgear.php';?>


<?php include 'pages/footer.php';?>