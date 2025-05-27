<?php
session_start();
require_once __DIR__ . '/../config/config_db.php'; 
require_once __DIR__ . '/../../app/helpers/auth_helper.php'; 

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $user_type = $_POST['user_type'] ?? 'customer';

   
    require_once __DIR__ . '/proses_login.php'; 
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gudangnet - Login</title>
    <link rel="stylesheet" href="../../assets/css/style.css"> <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="logo">kuis_2.</div>
            <h2>LOGIN</h2>
            
            <div class="user-type-switcher">
                <button class="btn active">Customer</button> 
                <a href="../../admin/admin_login.php" class="btn">Admin</a> </div>

            <h3>Hi, Welcome to kuis_2.</h3>

            <?php if (!empty($error_message)): ?>
                <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
            <?php endif; ?>

            <form id="loginForm" action="login.php" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required value="<?php echo htmlspecialchars($email ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter password" required>
                </div>
                <button type="submit" class="btn-login">LOGIN</button>
            </form>

            <div class="footer-info">
                Versi 1.0.0 | Dikembangkan oleh Kelompok 3
            </div>
        </div>
    </div>
</body>
</html>