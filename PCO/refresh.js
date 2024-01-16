// script.js

function checkObjectStatus() {
    fetch('check_object_status.php') // Replace with the actual path to your PHP script
      .then(response => response.json())
      .then(data => {
        if (data.isFilled) {
          // The object is filled, update the page without refreshing
          console.log('The object is filled! wait 5s');
          // Access the $checkInObj data using data.checkInObj and update the page accordingly
          setTimeout("location.reload(true);", 5000); //updates every 15 seconds.
        } else {
          console.log('The object is Empty!');
          // The object is still empty, continue checking after a delay
          setTimeout(checkObjectStatus, 5000); // Check every 5 seconds (adjust as needed)
        }
      })
      .catch(error => {
        console.error('Error while checking object status:', error);
        // Handle any errors or retries here
      });
  }
  
  document.addEventListener('DOMContentLoaded', checkObjectStatus);
  