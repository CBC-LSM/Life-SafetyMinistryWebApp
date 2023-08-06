// script.js

function openModal() {
    var modal = document.getElementById("ReportModal");
    modal.style.display = "block";
}

function closeModal() {
    var modal = document.getElementById("ReportModal");
    modal.style.display = "none";
}

function addPersonInvolved() {
    var container = document.getElementById("peopleInvolvedContainer");
    var personInvolved = document.createElement("div");
    personInvolved.className = "personInvolved";
    personInvolved.innerHTML = `
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
        <button type="button" class="btn btn-danger square-btn" onclick="deletePersonInvolved(this)"><span class="glyphicon glyphicon-trash"></span></button>
    `;
    container.appendChild(personInvolved);
}

function deletePersonInvolved(btn) {
    var personInvolved = btn.parentNode;
    personInvolved.parentNode.removeChild(personInvolved);
}

function goToIndex() {
    window.location.href = "index.php";
}

$(document).ready(function() {
    $('.edit-btn').click(function() {
        var entryId = $(this).data('entry-id');
        // Use AJAX to fetch data for the selected entry from the server
        $.ajax({
            url: 'get_entry_data.php', // Replace with your script to fetch entry data
            type: 'GET',
            data: { id: entryId },
            dataType: 'json',
            success: function(data) {
                // Populate modal form fields with data
                $('#editModal input[name="incidentDate"]').val(data.incidentDate);
                $('#editModal input[name="incidentTime"]').val(data.incidentTime);
                // Repeat for other fields...
                
                // Show the modal
                $('#editModal').modal('show');
            }
        });
    });
    
    // Handle form submission for updating the entry
    $('#updateEntryBtn').click(function() {
        // Use AJAX to submit the updated data to the server
        $.ajax({
            url: 'update_entry.php', // Replace with your script to update entry data
            type: 'POST',
            data: $('#editForm').serialize(),
            success: function(response) {
                if (response === 'success') {
                    // Close the modal and update the entry on the page
                    $('#editModal').modal('hide');
                    // Refresh the list or update the entry on the page
                }
            }
        });
    });
});


