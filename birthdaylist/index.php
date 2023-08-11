<?php
$pageName = "Emergency Roster";

require_once '../database/load.php';
require_once 'common.php';
require_once 'bdFunctions.php';
include '../pages/header.php';
$results = pcoCallbirthday($URL);
// die(var_dump($results[10]));
// die(print_r($results));

//now that I am pulling this info, it may be useful to create an announcment on the front page and say "in this week
// who's birthday is coming up and anniversary and on what date (maybe say an age or # of years but this is necesssary);

$upandcoming = upcomingevents($results);



// die();
?>
<div class="panel-box" >
    <table class="tableContainer">
        <thead>
            <tr class = "entry_header" style ="color: #D4D4C9; font-family: Arial  ;">
                <th class="header-text-left" style="width:33%">Name</th>
                <th class="header-text-center" style="width:33%">Birthday</th>
                <th class="header-text-center" style="width:33%">Anniversary</th>
            </tr>
        </thead>
        <tbody class="dashboard_table_body">
            <?php foreach($results as $result):
                $firstname = $result['attributes']['first_name'];
                $lastname = $result['attributes']['last_name'];
                $birthday = $result['attributes']['birthdate'];
                $anniversary = $result['attributes']['anniversary'];
                ?>
                <tr>
                    <td class="class_body-text-left"><?php echo $firstname." ".$lastname; ?></td>
                    <td class="class_body-text-center"><?php echo $birthday;?></td>
                    <td class="class_body-text-center"><?php echo $anniversary; ?></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<?php include 'pages/footer.php';?>