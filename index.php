<?php
/**
 * includes/load.php
 *
 * @package default
 * @see index.php
 */


$pageName = "CBC Gearpage";
require_once 'database/load.php';
include 'pages/header.php';

?>
<body style="background-color:#1E1E1E"></body>

<?php 

redirect('/users/index.php', false);?>


<?php include 'pages/footer.php';?>