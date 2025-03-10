<?php
session_start();
require_once 'db.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ambil koneksi database
    $conn = $dbsuara->getConnection();

    // Ambil data admin berdasarkan username
    $query = "SELECT * FROM pengguna WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $admin['password'])) {
            $_SESSION['username'] = $admin['username'];
            $_SESSION['role'] = "admin";

            header('Location: dashboardmin.php');
            exit;
        } else {
            echo "<script>alert('Username atau Password salah!'); window.location.href='login-admin.php';</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!'); window.location.href='login-admin.php';</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="login.css">
    <title>Login Admin SuaraKita</title>
</head>

<body>
    <main>
        <h1>LOGIN</h1>
        <h4>Welcome to <span>Suara</span>Kita!</h4>
        <form action="" method="post">
            <div class="nis">
                <label for="username" class="label">Username</label> <br>
                <input type="text" id="" name="username" required>
            </div>
            <div class="password">
                <label for="password" class="label">Password</label> <br>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" required>
                    <span class="toggle-password" onclick="togglePassword()">
                        <i class="fa fa-eye" id="eye-icon"></i>
                    </span>
                </div>
            </div>
            <button onclick="window.location.href = 'dashboard.html';">Login</button>
        </form>
    </main>
    <script>
        // untuk validasi password
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text'; // Tampilkan password
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash'); // Ganti ikon ke mata tertutup
            } else {
                passwordInput.type = 'password'; // Sembunyikan password
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye'); // Ganti ikon ke mata terbuka
            }
        }
    </script>
</body>

</html>