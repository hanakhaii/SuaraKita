<?php
session_start();
date_default_timezone_set('Asia/Jakarta'); // Sesuaikan dengan zona waktu Anda
if (!isset($_SESSION['nis'])) {
    header("Location: login-user.php");
    exit();
}

// Koneksi ke database
include 'db.php';
$dbsuara = new Database();

// Ambil waktu voting terbaru
$sql = "SELECT waktu_mulai_memilih, waktu_selesai_memilih 
        FROM pengaturan_waktu 
        ORDER BY id DESC LIMIT 1";
$result = $dbsuara->getConnection()->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $waktu_mulai = strtotime($row['waktu_mulai_memilih']);
    $waktu_selesai = strtotime($row['waktu_selesai_memilih']);
    $sekarang = time();

    // Jika di luar waktu voting
    if ($sekarang < $waktu_mulai || $sekarang > $waktu_selesai) {
        die("<h2>Voting belum dibuka atau sudah ditutup.</h2>");
    }
} else {
    die("<h2>Waktu voting belum diatur.</h2>");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="voting.css">
    <title>Document</title>
</head>
<!-- hanaa cantikkk, lucuu, sayangg -->
<body>
    <header>
        <div class="logo"> 
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="#0066FF"
                    d="M13 8V4q0-.425.288-.712T14 3h6q.425 0 .713.288T21 4v4q0 .425-.288.713T20 9h-6q-.425 0-.712-.288T13 8M3 12V4q0-.425.288-.712T4 3h6q.425 0 .713.288T11 4v8q0 .425-.288.713T10 13H4q-.425 0-.712-.288T3 12m10 8v-8q0-.425.288-.712T14 11h6q.425 0 .713.288T21 12v8q0 .425-.288.713T20 21h-6q-.425 0-.712-.288T13 20M3 20v-4q0-.425.288-.712T4 15h6q.425 0 .713.288T11 16v4q0 .425-.288.713T10 21H4q-.425 0-.712-.288T3 20m2-9h4V5H5zm10 8h4v-6h-4zm0-12h4V5h-4zM5 19h4v-2H5zm4-2" />
            </svg>
            <a href="../user/dashboardser.html">Dashboard</a>
        </div>
    </header>

    <section class="sec">
        <div class="h1">
            <h1>Pilih Sekarang!</h1>
            <h3>Pilihlah Dengan Bijak</h3>
        </div>
    </section>

    <!-- Di dalam section.sec1 -->
    <section class="sec1">
        <div class="nama-kan">
            <!-- Kandidat 1 -->
            <div class="kan-container">
                <div class="kan">
                    <img src="/Backend/img/harry.jpg" alt="">
                    <h1>Kandidat 1</h1>
                </div>
                <div class="radio-container">
                    <input type="radio" name="kandidat" value="1" id="kandidat1">
                    <label for="kandidat1">Pilih Kandidat 1</label>
                </div>
            </div>

            <!-- Kandidat 2 -->
            <div class="kan-container">
                <div class="kan">
                    <img src="/Backend/img/ha" alt="">
                    <h1>Kandidat 2</h1>
                </div>
                <div class="radio-container">
                    <input type="radio" name="kandidat" value="2" id="kandidat2">
                    <label for="kandidat2">Pilih Kandidat 2</label>
                </div>
            </div>

            <!-- Kandidat 3 -->
            <div class="kan-container">
                <div class="kan">
                    <img src="../gambal/amba.jpg" alt="">
                    <h1>Kandidat 3</h1>
                </div>
                <div class="radio-container">
                    <input type="radio" name="kandidat" value="3" id="kandidat3">
                    <label for="kandidat3">Pilih Kandidat 3</label>
                </div>
            </div>
        </div>
    </section>

    <script>
        const checkboxes = document.querySelectorAll(".radio-container input");
        const kandidatDivs = document.querySelectorAll(".kan");

        checkboxes.forEach((checkbox, index) => {
            checkbox.addEventListener("change", () => {
                document.querySelector(".selected")?.classList.remove("selected");
                kandidatDivs[index].classList.add("selected");
            });
        });
    </script>
    
    <section class="sec3">
        <button class="submit-button">Submit</button>
    </section>

    <footer>
        <p>&copy; 2025, SuaraKita. All rights reserved.
        </p>
    </footer>
</body>

</html>