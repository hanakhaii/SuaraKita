<?php
    session_start();
    require_once 'db.php';

    if(isset($_POST['username']) && isset($_POST['password'])){
        $nis = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        if($row){
            $_SESSION['username'] = $username; 
            header('Location: dashboardmin.php');
        } else {
            echo "<script>alert('Username atau Password salah!')</script>";
        }
    } else {
        echo "<script>alert('Username atau Password tidak boleh kosong!')</script>";
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
                <label for="nis" class="label">Username</label> <br>
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
            <button onclick="window.location.href = 'dashboard.html';">Login</button>
        </form>
    </main>
    <script src="../js/script.js"></script>
</body>
</html>