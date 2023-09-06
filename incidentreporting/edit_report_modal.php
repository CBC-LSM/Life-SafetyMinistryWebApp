<div id="edit_report_modal<?=$result['id'];?>" class="modal" style="margin: auto; width: 65%;">
    <?php
    //using the $result['id'] I want to do a sql call get the json data, roll it up into what should look like so it is editable. 
    //I will also want to figure out how this affects "updating" the database.
    $sql = "SELECT * FROM `IncidentReports`WHERE `id`={$result['id']}";
    $report = find_by_sql($sql);
    $jsonString = $report[0]['form_data'];
    // $jsonString = json_decode($report[0]['form_data'],true);
    $data = jsoncntrlerrorhandling($jsonString);
    // die(var_dump($data));
    // $reportID = $data['reportID'];
    $date = $data['IncidentDate'];
    $timeofincident= $data['IncidentTime'];
    $timeofreport= $data['ReportTime'];
    $locationofincident= $data['IncidentLocation'];
    $typeofincident= $data['IncidentType'];
    $reportwrittenby= $data['ReportWrittenBy'];
    $peopleinvolved = $data['PeopleInvolved']; 
    $emergencyFirstName = $data['EmergencyContact']['emergencyFirstName'];
    $emergencyLastName = $data['EmergencyContact']['emergencyLastName'];
    $emergencyPhone = $data['EmergencyContact']['emergencyPhone'];
    $description = $data['Description'];
    $injuryDamage = $data['InjuryDamage'];
    $actionTaken = $data['ActionTaken'];
    $medicalSupplies = $data['MedicalSupplies'];

    // die(var_dump($report));
    ?>
    <div class="modal-content">
        <span class="close" onclick="goToIndex()">&times;</span>
        <form action="process_form.php" method="POST" enctype="multipart/form-data">
            <h2 style="text-align: center;">Edit Incident</h2>

            <!-- Date of Incident -->
            <div class="form-group">
                <label for="incidentDate" style="display: block; text-align: center;">Date of Incident:</label>
                <input type="date" id="incidentDate" name="incidentDate" value="<?=$date;?>" required>
            </div>

            <!-- Time of Incident -->
            <div class="form-group">
                <label for="incidentTime" style="display: block; text-align: center;">Time of Incident:</label>
                <input type="time" id="incidentTime" name="incidentTime" value="<?=$timeofincident;?>" required>
            </div>

            <!-- Time of Report -->
            <div class="form-group">
                <label for="reportTime" style="display: block; text-align: center;">Time of Report:</label>
                <input type="time" id="reportTime" name="reportTime" value="<?=$timeofreport;?>" required>
            </div>

            <!-- Location of Incident -->
            <div class="form-group">
                <label for="incidentLocation" style="display: block; text-align: center;">Location of Incident:</label>
                <input type="text" id="incidentLocation" name="incidentLocation" value="<?=$locationofincident;?>" required>
            </div>

            <!-- Type of Incident -->
            <div class="form-group">
                <label for="incidentType" style="display: block; text-align: center;">Type of Incident:</label>
                <input type="text" id="incidentType" name="incidentType" value="<?=$typeofincident;?>" required>
            </div>

            <!-- Report written by -->
            <div class="form-group">
                <label for="reportWrittenBy" style="display: block; text-align: center;">Report written by:</label>
                <input type="text" id="reportWrittenBy" name="reportWrittenBy" value="<?=$reportwrittenby;?>" required>
            </div>

            <div class="form-group1">
                <h3>People Involved</h3>
                <button type="button" class="btn btn-default addPersonInvolved" onclick="addPersonInvolved()">
                    <span class="glyphicon glyphicon-plus"></span> Add Person Involved
                </button>
                <div id="peopleInvolvedContainer">
                    <?php
                    // Loop through the People Involved data from the database and generate HTML elements
                    foreach ($peopleinvolved as $person) {
                        echo '<div class="personInvolved">';
                        echo '<input type="text" class="personLastName" name="personLastName[]" placeholder="Last Name" required value="' . $person['LastName'] . '">';
                        echo '<input type="text" class="personFirstName" name="personFirstName[]" placeholder="First Name" required value="' . $person['FirstName'] . '">';
                        echo '<select class="personInvolvement" name="personInvolvement[]" required>';
                        echo '<option value="" disabled>Select an Involvement</option>';
                        $involvementOptions = ["Victim", "Medical", "Safety", "Safety Leader", "First Responder", "Offender", "Witness"];
                        foreach ($involvementOptions as $option) {
                            $selected = ($person['Involvement'] == $option) ? 'selected' : '';
                            echo '<option value="' . $option . '" ' . $selected . '>' . $option . '</option>';
                        }
                        echo '</select>';
                        echo '<button type="button" class="btn btn-danger square-btn" onclick="deletePersonInvolved(this)"><span class="glyphicon glyphicon-trash"></span></button>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>

            <div class="form-group1">
                <h3>Emergency Contact</h3>
                <div class="emergencyContact">
                    <input type="text" class="emergencyFirstName" name="emergencyFirstName" placeholder="First Name" value="<?=$emergencyFirstName;?>" required>
                    <input type="text" class="emergencyLastName" name="emergencyLastName" placeholder="Last Name" value="<?=$emergencyLastName;?>"required>
                    <input type="tel" class="emergencyPhone" name="emergencyPhone" placeholder="Phone Number" value="<?=$emergencyPhone;?>" required>
                </div>
            </div>

            <!-- Description of Incident -->
            <div class="form-group">
                <label for="description" style="display: block; text-align: center;">Description of Incident:</label>
                <textarea id="description" name="description" class="autosize-textarea" style="width: 65%;" required><?=$description;?></textarea>
            </div>

            <!-- Injury or Damage to Property -->
            <div class="form-group">
                <label for="injuryDamage" style="display: block; text-align: center;">Describe any Injury or Damage to Property:</label>
                <textarea id="injuryDamage" name="injuryDamage" class="autosize-textarea" style="width: 65%;" required><?=$injuryDamage;?></textarea>
            </div>

            <!-- What Action Was Taken? -->
            <div class="form-group">
                <label for="actionTaken" style="display: block; text-align: center;">What Action Was Taken?</label>
                <textarea id="actionTaken" name="actionTaken" class="autosize-textarea" style="width: 65%;" required><?=$actionTaken;?></textarea>
            </div>

            <!-- Were Any Medical Supplies Used? Describe -->
            <div class="form-group">
                <label for="medicalSupplies" style="display: block; text-align: center;">Were Any Medical Supplies Used? Describe:</label>
                <textarea id="medicalSupplies" name="medicalSupplies" class="autosize-textarea" style="width: 65%;" required><?=$medicalSupplies;?></textarea>
            </div>

            <input type="hidden" name="prevID" id="prevID" value="<?=$result['id'];?>" />      
            <div class="form-group">
                <button type="submit" class="btn btn-warning">
                    <span class="glyphicon glyphicon-ok"></span> <strong>Submit Edits <?=$result['id'];?></strong>
                </button>
                <button type="button" class="btn btn-default" onclick="goToIndex()">
                    <span class="glyphicon glyphicon-remove"></span> Cancel
                </button>                
            </div>
        </form>
    </div>
</div>
