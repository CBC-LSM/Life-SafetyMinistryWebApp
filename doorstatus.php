<?php
/**
 * includes/load.php
 *
 * @package default
 * @see index.php
 */
include 'database/load.php';
//retrieve all door status
$doorstatus = findDoorsAll();
// die(var_dump($doorstatus));

?>

<div class="panel-box">
    <!-- <div style ="color: #D4D4C9;"><?=$checkouttime."<br>"; echo $date1."<br>";echo $date2."<br>";?></div> -->
    <div class="container">
    <table>
        <thead>
            <tr style ="color: #D4D4C9; font-size: 100%; font-family: Arial  ;">
                <th class="text-left" style="width: 5%;"><strong>Door name</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Status</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Locked Time</strong></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($doorstatus as $door):?>
                <tr style ="color: #D4D4C9; font-size: 100%; background-color:#1E1E1E;">
                    <td class="text-left"><div class="mobile-only"><strong>Door Name</strong></div><strong><?php echo $door['name']; ?></strong></td>
                    <td><div class="mobile-only"><strong>Status</strong></div><?php echo $door['status']; ?></td>
                    <td><div class="mobile-only"><strong>Locked Time</strong></div><?php echo $door['timestamp']; ?></td>
                </tr>
            <?php endforeach;?>     
        </tbody>
    </table>
    </div>
    <!-- <input style="color: #D4D4C9; font-size: 100%; font-family: Arial;" type="file"  accept="image/*" capture="camera" />Camera </input> -->
</div>