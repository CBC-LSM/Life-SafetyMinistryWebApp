<?php
/**
 * includes/load.php
 *
 * @package default
 * @see index.php
 */


$pageName = "CBC Life and Safety Ministry";
require_once '../database/load.php';
include 'header.php';

?>
<body style="background-color:#1E1E1E"></body>
<div class = "message-text-center">
    <?php echo display_msg($msg); ?>
</div>
<div class="login-page">
    <div class="text-center">
       <h1>Events and Updates</h1>
       <p>I am making this a section where I can hopefully put updates for us to see every so often if needed.
            Perhpas items to keep in mind and see when we first login on a weekly basis as reminders.</p>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
    </div>
</div>
<?php include 'footer.php';?>