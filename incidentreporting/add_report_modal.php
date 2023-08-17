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