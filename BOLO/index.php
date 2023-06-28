<?php
$pageName = "Be On Look Out!";

require_once '../database/load.php';
if (!$session->isUserLoggedIn()){redirect("/",false);}
include '../pages/header.php';

// echo "Hello Tyler";

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="pic_css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<div class="gallery-container">
    <div class="image-container">
        <img id="gallery-image" src="" alt="Gallery Image">
    </div>
    <div class="arrow-container">
        <a href="#" id="prev-btn"><i class="fas fa-chevron-left"></i></a>
        <a href="#" id="next-btn"><i class="fas fa-chevron-right"></i></a>
    </div>
    <div class="caption-container">
        <h2>Name: <span id="image-name"></span></h2>
        <h2>Date of Photo: <span id="image-date"></span></h2>
        <div class="notes-container" style="width: 65%; margin: 0 auto; text-align: center;">
            <h3 id="image-notes"></h3>
        </div>
    </div>
    

</div>

<script src="pic_script.js"></script>

