<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Biggest Loser - Error</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_GET['message'])) {
            $errorMessage = $_GET['message'];
            echo "<p style='color: red;'>$errorMessage</p>";
        } else {
            echo "<p style='color: red;'>An error occurred.</p>";
        }
        ?>
        <br>
        <a href="register.php?org=<?= $_GET['org']; ?>">Back to Registration</a>
    </div>
</body>
</html>
