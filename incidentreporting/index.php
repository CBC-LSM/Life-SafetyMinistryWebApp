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
?>

<head>
    <title>Forum Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <!-- <button onclick="openModal()">Add New Incident</button> -->
    
    <!-- Display old incident reports -->
    <h2>Prior Incident Reports</h2>
    <?php
    $directory = 'incident_reports'; // Directory path where the PDF files are stored
    $files = glob($directory . '/*.pdf'); // Retrieve all PDF files from the directory

    if (empty($files)) {
        echo '<p>No old incident reports found.</p>';
    } else {
        echo '<ul>';
        foreach ($files as $file) {
            $fileName = basename($file);
            echo '<li><a href="' . $file . '" target="_blank">' . $fileName . '</a></li>';
        }
        echo '</ul>';
    }
    ?>
    
    <div id="ReportModal" class="modal">
        <div class="modal-content" style="text-align: left;">
            <span class="close" onclick="closeModal()">&times;</span>
            <form action="process_form.php" method="POST" enctype="multipart/form-data">
                <h2 style="text-align: center;">Add New Incident</h2>

                <div class="form-group">
                    <label for="incidentDate">Date of Incident:</label>
                    <input type="date" id="incidentDate" name="incidentDate" required>
                </div>

                <div class="form-group">
                    <label for="incidentTime">Time of Incident:</label>
                    <input type="time" id="incidentTime" name="incidentTime" required>
                </div>

                <div class="form-group">
                    <label for="reportTime">Time of Report:</label>
                    <input type="time" id="reportTime" name="reportTime" required>
                </div>

                <div class="form-group">
                    <label for="incidentLocation">Location of Incident:</label>
                    <input type="text" id="incidentLocation" name="incidentLocation" required>
                </div>

                <div class="form-group">
                    <label for="incidentType">Type of Incident:</label>
                    <input type="text" id="incidentType" name="incidentType" required>
                </div>

                <div class="form-group">
                    <label for="reportWrittenBy">Report written by:</label>
                    <input type="text" id="reportWrittenBy" name="reportWrittenBy" required>
                </div>

                <div class="form-group1">
                    <h3>People Involved</h3>
                    <button type="button" class="btn btn-default addPersonInvolved" onclick="addPersonInvolved()">
                        <span class="glyphicon glyphicon-plus"></span> Add Person Involved
                    </button>
                    <div id="peopleInvolvedContainer">
                        <div class="personInvolved">
                            <input type="text" class="personLastName" name="personLastName[]" placeholder="Last Name" required>
                            <input type="text" class="personFirstName" name="personFirstName[]" placeholder="First Name" required>
                            <select class="personInvolvement" name="personInvolvement[]" required>
                                <option value="" disabled selected>Select an Involvement</option>
                                <option value="Victim">Victim</option>
                                <option value="Medical">Medical</option>
                                <option value="Safety">Safety</option>
                                <option value="Safety Leader">Safety Leader</option>
                                <option value="First Responder">First Responder</option>
                                <option value="Offender">Offender</option>
                                <option value="Witness">Witness</option>
                            </select>
                            <button type="button" class="btn btn-danger square-btn" onclick="deletePersonInvolved(this)">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group1">
                    <h3>Emergency Contact</h3>
                    <div class="emergencyContact">
                        <input type="text" class="emergencyFirstName" name="emergencyFirstName" placeholder="First Name" required>
                        <input type="text" class="emergencyLastName" name="emergencyLastName" placeholder="Last Name" required>
                        <input type="tel" class="emergencyPhone" name="emergencyPhone" placeholder="Phone Number" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description of Incident:</label>
                    <textarea id="description" name="description" required></textarea>
                </div>

                <div class="form-group">
                    <label for="injuryDamage">Describe any Injury or Damage to Property:</label>
                    <textarea id="injuryDamage" name="injuryDamage" required></textarea>
                </div>

                <div class="form-group">
                    <label for="actionTaken">What Action Was Taken?</label>
                    <textarea id="actionTaken" name="actionTaken" required></textarea>
                </div>

                <div class="form-group">
                    <label for="medicalSupplies">Were Any Medical Supplies Used? Describe.</label>
                    <textarea id="medicalSupplies" name="medicalSupplies" required></textarea>
                </div>
                <div class="form-group">
                    <label for="incidentImage">Upload Image:</label>
                    <input type="file" id="incidentImage" name="incidentImage">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-ok"></span> Submit
                    </button>
                    <button type="button" class="btn btn-default" onclick="goToIndex()">
                        <span class="glyphicon glyphicon-remove"></span> Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
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
                <th class="text-left" style="width: 5%;"><strong>Report Name</strong></th>
                <th class="text-center" style="width: 5%;"><strong>Options</strong></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($files as $file):?>
                <tr style ="color: #D4D4C9; font-size: 100%; background-color:#1E1E1E;">
                    <td class="text-left"><div class="mobile-only"><strong>Name</strong></div><strong><?php echo $user['name']; ?></strong></td>
                    <td><div class="mobile-only"><strong>Username</strong></div><?php echo $user['username']; ?></td>
                    <td><div class="mobile-only"><strong>Status</strong></div><?php echo $status; ?></td>
                </tr>
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
