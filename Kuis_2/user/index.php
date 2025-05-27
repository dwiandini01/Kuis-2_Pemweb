<?php
session_start();
if(isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>kuis_2</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <div class="container">
        <h1>Selamat Datang di GudangNET</h1>
        <div class="menu">
            <a href="admin_login.php" class="btn">Login Admin</a>
            <a href="user/register.php" class="btn">Registrasi User</a>
        </div>
    </div>
</body>
</html>