<!-- 
Add in that I would like to have an option for adding an image if on a cell phone 
I would like it to flow better. need to figure out why I can't get the buttons to fall in line with the rest of the inputs for people. Just looks sloppy 
Need to add that this folder for pdfs is backed up to dropbox on the server side. I am not sure all involved to do this again but need to get it added.
add in security so that you have to be logged in to view this page.
Add this to the header so that you can navigate here to add a incident report.
Need to get the logo added to the bottom of the pdf or in the header. But it needs to be there.
-->

<?php
$pageName = "Incident Reports";

require_once '../database/load.php';
include '../pages/header.php';
include 'add_report_modal.php';

$sql = "SELECT * FROM `IncidentReports`";
$results = find_by_sql($sql);
?>

<head>
    <!-- <title>Forum Page</title> -->
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    <script src="script.js"></script>
</head>

<div class="panel-box">
    <?php echo display_msg($msg); ?>
    <button type="button" class="btn btn-primary btn-lg" id ="add" onclick="openModal()" VALIGN=MIDDLE>
        <span class="glyphicon glyphicon-plus-sign" style="color:#a0a0a0; font-size: 20px; vertical-align: middle; " aria-hidden="true"></span>
        <strong>Start New Report</strong>
    </button>
    
    <div class="tableContainer">
    <table>
        <thead>
            <tr style ="color: #D4D4C9; font-size: 20px; font-family: Arial  ;">
                <th class="text-left" style="width: 5%;"><strong>First Name</strong></th>
                <th class="text-left" style="width: 5%;"><strong>Last Name</strong></th>
                <th class="text-left" style="width: 5%;"><strong>Involvement Type</strong></th>
                <th class="text-left" style="width: 5%;"><strong>Date</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Modify</strong></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $result):?>
                <tr style ="color: #D4D4C9; font-size: 100%; background-color:#1E1E1E;">
                    <td class="text-left"><div class="mobile-only"><strong>First Name</strong></div><strong><?php echo $result['firstname']; ?></strong></td>
                    <td class="text-left"><div class="mobile-only"><strong>Last Name</strong></div><strong><?php echo $result['lastname']; ?></strong></td>
                    <td class="text-left"><div class="mobile-only"><strong>Involvement Type</strong></div><strong><?php echo $result['involvementtype']; ?></strong></td>
                    <td class="text-left"><div class="mobile-only"><strong>Date</strong></div><strong><?php echo $result['date']; ?></strong></td>
                    <td><button type="button" class="btn btn-warning" id ="edit" title="Edit Report" value = "<?php echo $result['id'];?>" onClick="<?php echo $result['id']?>" 
                                data-toggle="modal" data-target="#edit_report_modal<?=$result['id'];?>" VALIGN=MIDDLE><span class="glyphicon glyphicon-pencil"></button>
                    </td>
                </tr>
                <?php include 'edit_report_modal.php'; ?>
            <?php endforeach;?>     
        </tbody>
    </table>
    </div>
</div>
    <!-- <div id="pdfLogo">
        <img src="../images/CBC_LSM_Logo.png" alt="CBC LSM Logo">
    </div> -->
    
    <script>

    </script>
</body>
</html>
