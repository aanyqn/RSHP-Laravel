<?php
session_start();
$msg = $_SESSION['flash_msg'] ?? "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-page">
    <a href="../index.php"><button class="header-text">Back</button></a>
    <form action="../logic/login-post.php" method="post">
        <h1>Log in to your account</h1><br>
        <input type="email" name="email" placeholder="Email" required>
        <br><br>
        <input type="password" name="password" placeholder="Password" required>
        <br><br>
        <?php if ($msg): ?> <p style="color: red; align-items: center;"><?= $msg ?></p>
        <?php unset($_SESSION['flash_msg']);?>
        <?php endif;?>
        <input type="submit" value="Login">
    </form>
        
</body>
</html>