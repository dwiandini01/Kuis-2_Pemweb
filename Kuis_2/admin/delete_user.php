<?php
session_start();
require_once __DIR__ . '/../user/config/config_db.php'; 
require_once __DIR__ . '/../app/helpers/auth_helper.php'; 
require_once __DIR__ . '/../app/models/User.php'; 

redirectIfNotAdmin(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'] ?? null;
    $user_type_to_delete = $_POST['user_type'] ?? 'customer'; 

    if ($user_id) {
        $userModel = new User($pdo);
        if ($userModel->deleteUser($user_id, $user_type_to_delete)) {
            $_SESSION['message'] = "Pengguna ID {$user_id} berhasil dihapus.";
        } else {
            $_SESSION['message'] = "Gagal menghapus pengguna ID {$user_id}.";
        }
    } else {
        $_SESSION['message'] = "ID Pengguna tidak valid.";
    }
} else {
    $_SESSION['message'] = "Permintaan tidak valid.";
}

header("Location: manage_users.php"); 
exit();
?>