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
require_once "../birthdaylist/grabinfo.php";

?>
<body style="background-color:#1E1E1E"></body>
<div class = "message-text-center">
    <?php echo display_msg($msg); ?>
</div>
<div class="event-page">
    <div class="text-center">
       <h1>Events and Updates</h1>
       <!-- <?php var_dump($upandcoming);?> -->
       <!-- <h2>ATTENTION: <br>Don't forget to get a picture of everyone who checks in. This will needed as we move forward. If you have any questions ask Tyler. If you need to see
       who has already had their picture taken, please visit this page.</h2> -->
       <h2><span>&#x1F388;&#x1F382;</span> ATTENTION <span>&#x1F382;&#x1F388;</span></h2>
            <h3> Birthdays and Anniversaries:</h3>
            <h2>
                <?php foreach($upandcoming as $event){
                    echo $event['name']."'s  ".$event['type'] . " coming up: " . $event['date'] . "<br>";
                }
                ?>
            </h2>
       <!-- <h3><a href="/users/users.php" target="_self">Users</a></h3>
       <p> Note: The Users page can now receive uploads of pictures as they are taken. Create a new user if needed and upload the picture taken. </p>
            <br>
            <br>
            <br> -->
    </div>
</div>
<?php include 'footer.php';?>