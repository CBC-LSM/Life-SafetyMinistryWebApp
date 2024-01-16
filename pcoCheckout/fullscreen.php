<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="checkoutstyle.css" />
 
 <?php
if(isset($_GET['locations'])){
?>
<?php
}
?>
<script src="https://code.jquery.com/jquery-1.6.4.js"></script>
<script>

  const queryString = window.location.search;
  const checkoutIDs = [];

  function getNewCheckout(){
    existingChildren = document.getElementById("childContainer").children;
    for (var i = 0; i < existingChildren.length; i++) {
      var existingChild = existingChildren[i];
      existingChild.classList.remove('newChild');
    }
    notifySound = new Audio('notification.mp3');
    $.getJSON('http://cbcsafety.org/pcoCheckout/checkoutData.php' + queryString, function(data){
    var array = $.map(data, function(value, index){
        if(!checkoutIDs.includes(value['checkoutID'])){
          notifySound.play();
          childContainer = document.getElementById("childContainer");
          newChild = document.createElement('div');
          newChild.classList.add('child');
          newChild.classList.add('newChild');
          newChild.setAttribute('id',value['checkoutID']);
          newChild = childContainer.insertBefore(newChild, childContainer.firstChild).innerHTML = value['firstName'] + " " + value['lastName'];
          checkoutIDs.push(value['checkoutID']);
        }
      });
    });
  }

  var intervalId = window.setInterval(function(){
    getNewCheckout();
  }, 2000);
  
  </script>
  <link rel="shortcut icon" href="#">
</head>
<body>
<?php
if(!isset($_GET['locations'])){
?>
<!-- <p>Locations Parameter not set.  Please add ?locations= followed by the location id's seperated by comma's to the end of the url.</0> -->
<div class="locationsList">
  <ul>
    <li>Sunday Children's Ministry - EventID: 27354867</li>
	  <ul>
      <li><a href="?locations=%1452290">Baby Nursery - LocationID: 1452290</a></li>
      <li><a href="?locations=%1452291">Toddler Nursery - LocationID: 1452291</a></li>
      <li><a href="?locations=%1452301">Children's Ministry Admin - LocationID: 1452301</a></li>
      <li><a href="?locations=%1452292">Sunday School Hour - LocationID: 1452292</a></li>
      <ul>
        <li><a href="?locations=%1452296">2s and 3s - LocationID: 1452296</a></li>
        <li><a href="?locations=%1452297">4s and 5s - LocationID: 1452297</a></li>
        <li><a href="?locations=%1452295">K and 1st Grade - LocationID: 1452295</a></li>
        <li><a href="?locations=%1452293">2nd and 3rd Grade - LocationID: 1452293</a></li>
        <li><a href="?locations=%1452294">4th and 5th Grade - LocationID: 1452294</a></li>
      </ul>
      <li><a href="?locations=%1452298">Worship Hour - LocationID: 1452298</a></li>
        <ul>
        <li><a href="?locations=%1452299">Disciple Kids Worship Jr. - LocationID: 1452299</a></li>
        <li><a href="?locations=%1452300">Disciple Kids Worship - LocationID: 1452300</a></li>
        </ul>
  </ul>
  </ul>
  <ul>
    <li>AWANA - EventID: 27121386</li>
    <ul>
      <li><a href="?locations=%248040">AWANA Staff - LocationID: 248040</a></li>
      <li><a href="?locations=%261759">AWANA Security Checkin - LocationID: 261759</a></li>
      <li><a href="?locations=%261760">Baby Nursery - LocationID: 261760</a></li>
      <li><a href="?locations=%261761">Toddler Nursery - LocationID: 261761</a></li>
      <li><a href="?locations=%233759">Puggles - LocationID: 233759</a></li>
      <li><a href="?locations=%233761">Cubbies - LocationID: 233761</a></li>
      <li><a href="?locations=%233760">Sparks - LocationID: 233760</a></li>
      <li><a href="?locations=%233762">TNT - LocationID: 233762</a></li>
    </ul>
  </ul>
  </div>
<?php
}
?>
  <h1 id="p1">Ready for Pickup:</h1><br>
<div id="childContainer">

</div>
</body>
</html>

