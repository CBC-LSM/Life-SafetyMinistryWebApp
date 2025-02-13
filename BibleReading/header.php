<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mobile_optimized_style.css">
    <title>Reading Tracker</title>
</head>
<body>

<header class="header">
    <div class="hamburger-menu" onclick="toggleMenu()">
        <span></span>
        <span></span>
        <span></span>
    </div>
</header>

<nav class="nav-menu" id="navMenu">
    <a href="dashboard.php">Dashboard</a>
    <a href="account_settings.php">Account Settings</a>
    <a href="log_progress.php">Log Progress</a>
    <a href="logout.php">Logout</a>
</nav>

<script>
function toggleMenu() {
    const navMenu = document.getElementById("navMenu");
    navMenu.classList.toggle("active");
}
</script>

</body>
</html>
