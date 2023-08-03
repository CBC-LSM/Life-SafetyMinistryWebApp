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
        <input type="text" class="personInvolvement" name="personInvolvement[]" placeholder="Involvement" required>
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
