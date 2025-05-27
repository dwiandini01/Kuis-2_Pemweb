<?php
session_start();
include '../db_php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: admin_login.php");
    exit;
}

$result = $conn->query("SELECT * FROM users WHERE role='user'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../assets/style.css" />
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0; padding: 20px;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #34495e;
            padding: 15px 30px;
            color: white;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        header h2 {
            margin: 0;
            font-weight: 600;
        }
        header nav a {
            color: #ecf0f1;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        header nav a:hover {
            color: #1abc9c;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }

        .btn-primary {
            background-color: #1abc9c;
            color: white;
            padding: 12px 22px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 25px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #16a085;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        table thead {
            background-color: #34495e;
            color: white;
        }
        table th, table td {
            padding: 14px 18px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            vertical-align: middle;
        }
        table tr:hover {
            background-color: #f1f7f9;
        }
        img.profile-thumb {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }
        a.action-link {
            margin-right: 10px;
            color: #2980b9;
            text-decoration: none;
            font-weight: 600;
        }
        a.action-link.delete {
            color: #e74c3c;
        }
        a.action-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<header>
    <h2>Dashboard Admin</h2>
    <nav>
        <a href="create_user.php">Tambah User</a>
        <a href="../auth/logout.php">Logout</a>
    </nav>
</header>

<div class="container">
    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>Username</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td>
                    <?php if (!empty($row['profile_pic'])): ?>
                        <img src="../uploads/<?= htmlspecialchars($row['profile_pic']) ?>" alt="Foto Profil" class="profile-thumb">
                    <?php else: ?>
                        <img src="../assets/default-profile.png" alt="Default Foto" class="profile-thumb">
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td>
                    <a class="action-link" href="edit_user.php?id=<?= $row['id'] ?>">Edit</a>
                    <a class="action-link delete" href="delete_user.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus user ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>