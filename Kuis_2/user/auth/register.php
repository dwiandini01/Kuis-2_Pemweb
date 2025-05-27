<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $profile_pic = null;
    if ($_FILES['profile_pic']['name']) {
        $profile_pic = uniqid() . "_" . $_FILES['profile_pic']['name'];
        move_uploaded_file($_FILES['profile_pic']['tmp_name'], "../uploads/" . $profile_pic);
    }

    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role, profile_pic) VALUES (?, ?, ?, 'user', ?)");
    $stmt->bind_param("ssss", $username, $email, $password, $profile_pic);
    $stmt->execute();

    echo "Registrasi berhasil. <a href='login.php'>Login</a>";
}
?>

<link rel="stylesheet" href="../assets/style.css">
<h2>Registrasi User</h2>
<form method="POST" enctype="multipart/form-data">
    <input name="username" placeholder="Username" required>
    <input name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="file" name="profile_pic">
    <button type="submit">Register</button>
</form>