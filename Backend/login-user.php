<?php
    include 'db.php';

    if(isset($_POST['nis']) && isset($_POST['password'])){
        $nis = $_POST['nis'];
        $password = $_POST['password'];

        $query = "SELECT * FROM user WHERE nis = '$nis' AND password = '$password'";
        $result = mysqli_query($connect, $query);

        if(mysqli_num_rows($result) > 0){
            $data = mysqli_fetch_assoc($result);
            session_start();
            $_SESSION['nis'] = $data['nis'];
            $_SESSION['name'] = $data['name'];
            $_SESSION['role'] = $data['role'];
            header('Location: dashboardser.php');
        } else {
            echo "<script>alert('NIS atau Password salah!')</script>";
        }
    } else {
        echo "<script>alert('NIS atau Password tidak boleh kosong!')</script>";
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
        <form action="" method="post">
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
            <button onclick="window.location.href='dashboardser.html'">Login</button>
        </form>
    </main>
    <script src="../js/script.js"></script>
</body>
</html>