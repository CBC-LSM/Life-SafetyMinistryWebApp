// Function to open the modal with contact details
function openModal(firstName, lastName,emContact,phoneNumber) {
  var modal = document.getElementById("myModal");
  var modalContent = document.getElementById("modal-content");
  console.log("phoneNumber:", phoneNumber);
  // Create the content for the modal
  var content = `
    <strong>Name:</strong> ${firstName} ${lastName}<br>
    <strong>Name:</strong> ${emContact}<br>
    <strong>Phone Number:</strong> ${phoneNumber}
  `;

  modalContent.innerHTML = content;
  modal.style.display = "block";
}

// Function to close the modal
function closeModal() {
  var modal = document.getElementById("myModal");
  modal.style.display = "none";
}

// Close the modal when clicking the "X" button
document.getElementsByClassName("close")[0].onclick = closeModal;

// Close the modal when clicking outside of it
window.onclick = function(event) {
  var modal = document.getElementById("myModal");
  if (event.target == modal) {
    closeModal();
  }
}

// Function to handle the click event
function handleClick(event, firstName, lastName,emContact, phoneNumber) {
  event.preventDefault();
  openModal(firstName, lastName,emContact, phoneNumber);
}
