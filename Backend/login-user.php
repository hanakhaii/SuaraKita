<?php
session_start();
require_once 'db.php';

if (isset($_POST['nis']) && isset($_POST['password'])) {
    $nis = $_POST['nis'];
    $password = $_POST['password'];

    // Ambil koneksi database
    $conn = $dbsuara->getConnection();

    // Ambil data pengguna berdasarkan NIS
    $query = "SELECT * FROM pengguna WHERE nis = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nis);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc(); // Ambil hasil query ke dalam array

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            $_SESSION['nis'] = $user['nis'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['role'] = "user";

            header('Location: dashboardser.php');
            exit;
        } else {
            echo "<script>alert('NIS atau Password salah!'); window.location.href='login-user.php';</script>";
        }
    } else {
        echo "<script>alert('NIS tidak ditemukan!'); window.location.href='login-user.php';</script>";
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
    <title>Login User SuaraKita</title>
</head>
<!-- hanaa cantikkk, lucuu, sayangg -->

<body>
    <main>
        <h1>LOGIN</h1>
        <h4>Welcome to <span>Suara</span>Kita!</h4>
        <form action="login-user.php" method="post">
            <div class="nis">
                <label for="nis" class="label">NIS</label> <br>
                <input type="number" id="" name="nis" required>
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
            <button type="submit">Login</button>
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