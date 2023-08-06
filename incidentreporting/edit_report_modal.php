<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Entry</h5>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <form id="editForm" action="update_entry.php" method="POST" enctype="multipart/form-data">
                    <!-- ...other form fields... -->

                    <div class="form-group">
                        <label for="editIncidentDate">Date of Incident:</label>
                        <input type="date" id="editIncidentDate" name="incidentDate" required>
                    </div>

                    <div class="form-group">
                        <label for="editIncidentTime">Time of Incident:</label>
                        <input type="time" id="editIncidentTime" name="incidentTime" required>
                    </div>

                    <!-- ...rest of the form... -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="updateEntryBtn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
