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

<?php include 'pages/main.php';?>
<?php include 'doorstatus.php';?>

<!-- This is where I need to include a table page to show -->



<?php include 'pages/footer.php';?>