<?php 
include 'db.php';
$dbsuara = new Database(); 
?>
<!-- inputtt pemilih -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="apple-touch-icon" sizes="180x180" href="../Backend/img/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../Backend/img/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../Backend/img/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest"><link rel="icon" type="image/x-con" href="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet" />
    <title>Upload Pemilih</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            margin: 20px auto;
            padding: 20px;
        }
        
        .logo{
            display: flex;
            align-items: center;
        }

        h2 {
            font-weight: bold;
            font-size: 40px;
            text-align: center;
        }

        h3{
            margin-top: -20px;
            font-weight: bold;
            font-size: 27px;
            text-align: center;
        }

        span{
            color: #FC0134;
            text-align: center;
        }

        header {
            margin-left: 20px;
        }

        a {
            text-decoration: none;
            color: #0066FF;
            margin-top: -5px;
            margin-left: 5px;
            font-weight: bold;
        }

        a:hover {
            color: #181B3C;
            text-decoration: underline;
        }

        .form-container {
            border-color: #ffffff;
            max-width: 600px;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 25px;
            box-shadow:0px 0px 7px 0px black;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #0066FF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: 0.3s ease-in-out;
            display: block;
            margin: 20px auto 0;
        }

        button:hover {
            background-color: #181B3C;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <div>
                <!-- SVG Logo -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="#0066FF"
                        d="M13 8V4q0-.425.288-.712T14 3h6q.425 0 .713.288T21 4v4q0 .425-.288.713T20 9h-6q-.425 0-.712-.288T13 8M3 12V4q0-.425.288-.712T4 3h6q.425 0 .713.288T11 4v8q0 .425-.288.713T10 13H4q-.425 0-.712-.288T3 12m10 8v-8q0-.425.288-.712T14 11h6q.425 0 .713.288T21 12v8q0 .425-.288.713T20 21h-6q-.425 0-.712-.288T13 20M3 20v-4q0-.425.288-.712T4 15h6q.425 0 .713.288T11 16v4q0 .425-.288.713T10 21H4q-.425 0-.712-.288T3 20m2-9h4V5H5zm10 8h4v-6h-4zm0-12h4V5h-4zM5 19h4v-2H5zm4-2" />
                </svg>
            </div>
            <a href="../Backend/data_pemilih.php">Dashboard</a>
        </div>
    </header>

    <main class="form-container">
        <h2>Tambah Pemilih</h2>
        <h3><span>Suara</span>Kita</h3>
        <form action="process.php?action=add_pemilih" method="post">
            <!-- Input NIS -->
            <div class="form-group">
                <label for="nis">NIS:</label>
                <input type="number" id="nis" name="nis" required>
            </div>

            <!-- Input Password --> 
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" id="password" name="password" required>
            </div>

            <!-- Input Username -->
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <!-- Input Nama -->
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" required>
            </div>

            <!-- Input Role -->
            <div class="form-group">
                <label>Masuk Sebagai:</label>
                <div style="display: flex; align-items: center;">
                    <input type="radio" id="admin" name="role" value="admin" required> 
                    <label for="admin">Admin</label>
                </div>
                <div style="display: flex; align-items: center;">
                    <input type="radio" id="user" name="role" value="user">
                    <label for="user">User</label>
                </div>
            </div>

            <!-- Input Status Pemilihan -->
            <div class="form-group">
                <label for="validasi_memilih">Status Pemilihan:</label>
                <select name="validasi_memilih" id="validasi_memilih" required>
                    <option value="">Pilih status</option>
                    <option value="sudah_memilih">Sudah Memilih</option>
                    <option value="belum_memilih">Belum Memilih</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" name="submit">Upload Pemilih</button>
            </div>
        </form>
    </main>
</body>
</html>
