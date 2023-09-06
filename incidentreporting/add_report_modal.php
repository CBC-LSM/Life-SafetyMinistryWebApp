<div id="ReportModal" class="modal" style="width: 65%;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <form action="process_form.php" method="POST" enctype="multipart/form-data">
            <h2 style="text-align: center;">Add New Incident</h2>

            <!-- Date of Incident -->
            <div class="form-group">
                <label for="incidentDate" style="display: block; text-align: center;">Date of Incident:</label>
                <input type="date" id="incidentDate" name="incidentDate" >
            </div>

            <!-- Time of Incident -->
            <div class="form-group">
                <label for="incidentTime" style="display: block; text-align: center;">Time of Incident:</label>
                <input type="time" id="incidentTime" name="incidentTime" >
            </div>

            <!-- Time of Report -->
            <div class="form-group">
                <label for="reportTime" style="display: block; text-align: center;">Time of Report:</label>
                <input type="time" id="reportTime" name="reportTime" >
            </div>

            <!-- Location of Incident -->
            <div class="form-group">
                <label for="incidentLocation" style="display: block; text-align: center;">Location of Incident:</label>
                <input type="text" id="incidentLocation" name="incidentLocation" >
            </div>

            <!-- Type of Incident -->
            <div class="form-group">
                <label for="incidentType" style="display: block; text-align: center;">Type of Incident:</label>
                <input type="text" id="incidentType" name="incidentType" >
            </div>

            <!-- Report written by -->
            <div class="form-group">
                <label for="reportWrittenBy" style="display: block; text-align: center;">Report written by:</label>
                <input type="text" id="reportWrittenBy" name="reportWrittenBy" >
            </div>
            
            <!-- People Involved -->
            <div class="form-group">
                <h3>People Involved</h3>
                <button type="button" class="btn btn-default addPersonInvolved" onclick="addPersonInvolved()">
                    <span class="glyphicon glyphicon-plus"></span> Add Person Involved
                </button>
                <div id="peopleInvolvedContainer">
                    <!-- Repeat this structure for each person involved -->
                    <div class="personInvolved">
                        <input type="text" class="personLastName" name="personLastName[]" placeholder="Last Name" required>
                        <input type="text" class="personFirstName" name="personFirstName[]" placeholder="First Name" required>
                        <select class="personInvolvement" name="personInvolvement[]" >
                                <option value="" disabled selected>Select an Involvement</option>
                                <option value="Victim">Victim</option>
                                <option value="Medical">Medical</option>
                                <option value="Safety">Safety</option>
                                <option value="Safety Leader">Safety Leader</option>
                                <option value="First Responder">First Responder</option>
                                <option value="Offender">Offender</option>
                                <option value="Witness">Witness</option>
                            <!-- Add more options as needed -->
                        </select>
                        <button type="button" class="btn btn-danger square-btn" onclick="deletePersonInvolved(this)">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Emergency Contact -->
            <div class="form-group">
                <h3>Emergency Contact</h3>
                <div class="emergencyContact">
                    <input type="text" class="emergencyFirstName" name="emergencyFirstName" placeholder="First Name" >
                    <input type="text" class="emergencyLastName" name="emergencyLastName" placeholder="Last Name" >
                    <input type="tel" class="emergencyPhone" name="emergencyPhone" placeholder="Phone Number" >
                </div>
            </div>
            <!-- Description of Incident -->
            <div class="form-group">
                <label for="description" style="display: block; text-align: center;">Description of Incident:</label>
                <textarea id="description" name="description" class="autosize-textarea" style="width: 65%;" ></textarea>
            </div>

            <!-- Injury or Damage to Property -->
            <div class="form-group">
                <label for="injuryDamage" style="display: block; text-align: center;">Describe any Injury or Damage to Property:</label>
                <textarea id="injuryDamage" name="injuryDamage" class="autosize-textarea" style="width: 65%;" ></textarea>
            </div>

            <!-- What Action Was Taken? -->
            <div class="form-group">
                <label for="actionTaken" style="display: block; text-align: center;">What Action Was Taken?</label>
                <textarea id="actionTaken" name="actionTaken" class="autosize-textarea" style="width: 65%;" ></textarea>
            </div>

            <!-- Were Any Medical Supplies Used? Describe -->
            <div class="form-group">
                <label for="medicalSupplies" style="display: block; text-align: center;">Were Any Medical Supplies Used? Describe:</label>
                <textarea id="medicalSupplies" name="medicalSupplies" class="autosize-textarea" style="width: 65%;" ></textarea>
            </div>

            <!-- Submit and Cancel Buttons -->
            <div class="form-group button-container" style="text-align: center;">
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-ok"></span> Submit
                </button>
                <button type="button" class="btn btn-default" onclick="goToIndex()">
                    <span class="glyphicon glyphicon-remove"></span> Cancel
                </button>
                <!-- <input type="hidden" name="reportID" id="reportID" value="" /> -->
            </div>
        </form>
    </div>
</div>
