<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
    header("Location: ../auth/login.php");
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        h2 {
            color: #333;
        }
        p {
            font-size: 16px;
            margin: 10px 0;
        }
        img {
            border-radius: 50%;
            margin-top: 10px;
        }
        .actions a {
            display: inline-block;
            margin: 10px 8px;
            padding: 10px 16px;
            background: #007BFF;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.3s;
        }
        .actions a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Profil Saya</h2>
        <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>

        <?php if (!empty($user['profile_pic'])): ?>
            <img src="../uploads/<?= htmlspecialchars($user['profile_pic']) ?>" width="120" height="120" alt="Foto Profil">
        <?php else: ?>
            <img src="../assets/default-profile.png" width="120" height="120" alt="Default Profile">
        <?php endif; ?>

        <div class="actions">
            <a href="edit_profile.php">Edit Profil</a>
            <a href="../auth/logout.php">Logout</a>
        </div>
    </div>
</body>
</html>