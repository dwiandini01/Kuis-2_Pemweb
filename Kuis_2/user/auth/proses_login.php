<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {
    die("Akses langsung tidak diizinkan.");
}

if (!isset($pdo)) {
    require_once __DIR__ . '/../config/db_config.php';
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$user_type = $_POST['user_type'] ?? 'customer';

if (empty($email) || empty($password)) {
    $error_message = "Email dan password harus diisi.";
} else {
    try {
        $table = ($user_type === 'admin') ? 'admins' : 'users';
        $stmt = $pdo->prepare("SELECT id, email, password, name FROM {$table} WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user) {
            if ($password === $user['password']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_type'] = $user_type;

                if ($user_type === 'admin') {
                    header("Location: /admin/dashboard.php");
                } else {
                    header("Location: /user/dashboard.php");
                }
                exit();
            } else {
                $error_message = "Password salah.";
            }
        } else {
            $error_message = "Email tidak ditemukan atau tidak terdaftar sebagai {$user_type}.";
        }
    } catch (PDOException $e) {
        $error_message = "Terjadi kesalahan database: " . $e->getMessage();
    }
}
