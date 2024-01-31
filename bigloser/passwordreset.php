<?php
include('header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plaintextPassword = $_POST['password'];
    $hashedPassword = password_hash($plaintextPassword, PASSWORD_DEFAULT);
    ?>
    <div class="output-container">
        <p class="hashed-password">Hashed Password:</p>
        <code><?php echo $hashedPassword; ?></code>
    </div>
    <?php
}
?>

<div class="password-form-container">
    <h2>Password Hash Generator</h2>
    <form method="post" action="">
        <label for="password">Enter Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Generate Hash</button>
    </form>
</div>
