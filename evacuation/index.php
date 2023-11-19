<?php
$pageName = "Evacuation Plans 2023";

require_once '../database/load.php';
include '../pages/dashboardHeader.php';
?>
<head>
    <style>
        #construction-header {
            color: white;
            font-size: 24px;
            text-align: center;
            background-color: #333; /* Set your desired background color */
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
            margin-top: 20px;
        }

        #construction-image {
            width: 65%;
            max-width: 85%; /* Set your desired maximum width */
            margin-top: 20px; /* Adjust as needed */
        }
    </style>
</head>
<div class="panel-box" >
    <div id="construction-header">
        Fire Evacuation
    </div>
    <img id="construction-image" src="../images/Maps_overview1.png" alt="Fire Evacuation Area">
    <div id="construction-header">
        Shelter In Place
    </div>
    <img id="construction-image" src="../images/ShelterInPlace.png" alt="Shelter In Place Area">
</div>


<?php //include '../pages/dashboardHeader.php';?>
<?php include 'pages/footer.php';?>