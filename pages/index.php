<?php
/**
 * includes/load.php
 *
 * @package default
 * @see index.php
 */


$pageName = "CBC Gearpage";
require_once '../database/load.php';
include 'header.php';

?>
<body style="background-color:#1E1E1E"></body>
<div class = "message-text-center">
    <?php echo display_msg($msg); ?>
</div>

<?php include 'loggedgear.php';?>


<?php include 'footer.php';?>