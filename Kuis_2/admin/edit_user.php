<?php
session_start();
require_once __DIR__ . '/../user/config/config_db.php'; 
require_once __DIR__ . '/../app/helpers/auth_helper.php'; 
require_once __DIR__ . '/../app/models/User.php'; 
redirectIfNotAdmin();

$userModel = new User($pdo);
$user_id = $_GET['id'] ?? null;
$user_data = null;
$error_message = '';
$success_message = '';

if ($user_id) {
    $user_data = $userModel->getUserById($user_id, 'customer'); 
    if (!$user_data) {
        $error_message = "Pengguna tidak ditemukan.";
    }
} else {
    $error_message = "ID Pengguna tidak diberikan.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $user_data) {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $new_password = $_POST['new_password'] ?? '';

    // Update info dasar
    if ($userModel->updateUser($user_id, $name, $email, 'customer')) {
        $success_message = "Data pengguna berhasil diperbarui.";
        $user_data = $userModel->getUserById($user_id, 'customer'); 
    } else {
        $error_message = "Gagal memperbarui data pengguna.";
    }

    // Update password jika diisi
    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        if ($userModel->updatePassword($user_id, $hashed_password, 'customer')) {
            $success_message .= " Password juga berhasil diperbarui.";
        } else {
            $error_message .= " Gagal memperbarui password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Pengguna</title>
    <link rel="stylesheet" href="../assets/css/style.css"> <style>
        .edit-container { width: 50%; margin: 50px auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.1); }
        .edit-container h1 { text-align: center; color: #333; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: bold; }
        .form-group input[type="text"], .form-group input[type="email"], .form-group input[type="password"] { width: calc(100% - 22px); padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        .btn-submit { background-color: #28a745; color: white; padding: 12px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 1em; margin-top: 10px; }
        .btn-submit:hover { background-color: #218838; }
        .message { padding: 10px; margin-bottom: 20px; border-radius: 5px; font-weight: bold; }
        .message.success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .message.error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="edit-container">
        <h1>Edit Pengguna</h1>

        <?php if (!empty($error_message)): ?>
            <p class="message error"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
        <?php if (!empty($success_message)): ?>
            <p class="message success"><?php echo htmlspecialchars($success_message); ?></p>
        <?php endif; ?>

        <?php if ($user_data): ?>
            <form action="edit_user.php?id=<?php echo $user_data['id']; ?>" method="POST">
                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user_data['name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="new_password">Password Baru (kosongkan jika tidak diubah):</label>
                    <input type="password" id="new_password" name="new_password" placeholder="Kosongkan jika tidak ingin mengubah password">
                </div>
                <button type="submit" class="btn-submit">Simpan Perubahan</button>
            </form>
        <?php else: ?>
            <p>Data pengguna tidak dapat dimuat.</p>
        <?php endif; ?>
        <p><a href="manage_users.php">Kembali ke Daftar Pengguna</a></p>
    </div>
</body>
</html>