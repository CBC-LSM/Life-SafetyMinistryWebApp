<?php
/**
 * includes/load.php
 *
 * @package default
 * @see index.php
 */


$pageName = "Rover Checklist";
require_once 'database/load.php';
include 'pages/header.php';
$roverchecklist = roverchecklist();

?>
<body style="background-color:#1E1E1E"></body>
<div class="rover_container">
    <table id="rover_checklist">
        <thead>
            <tr style ="color: #D4D4C9; font-size: 100%; font-family: Arial  ;">
                <th class="rover-text-left" style="width: 25%;"><strong>To-Do</strong></th>
                <th class="text-center" style="width: 25%;"><strong>Status</strong></th>
                <th class="text-center" style="width: 25%;"><strong>Complete</strong></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($roverchecklist as $checklist):?>
                <tr style ="color: #D4D4C9; font-size: 100%; background-color:#1E1E1E;">
                    <td class="rover-text-left"><div class="mobile-only"><strong>To-Do</strong></div><strong><?php echo $checklist['item']; ?></strong></td>
                    <td><div class="mobile-only"><strong>Status</strong></div><?php echo $checklist['status']; ?></td>
                    <td><div class="mobile-only"></div>
                    <?php if ($checklist['status']!="Completed"):?>
                        <a href="complete.php?id=<?php echo $checklist['id'];?>"class="btn btn-warning btn-xs"  
                        title="Check In" data-toggle="tooltip"><span class="glyphicon glyphicon-ok"></span></a>
                    <?php else:?>
                        <a href="resetItem.php?id=<?php echo $checklist['id'];?>"class="btn btn-success btn-xs"  
                        title="Check Out" data-toggle="tooltip"><span class="glyphicon glyphicon-ok"></span></a>
                    <?php endif;?>
                    </td>
                    </tr>
            <?php endforeach;?>     
        </tbody>
    </table>
    </div>
</div> 

<?php include 'pages/footer.php';?>