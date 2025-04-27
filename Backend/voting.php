<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
include 'db.php';
$dbsuara = new Database();

// Jika user belum login, arahkan ke login
if (!isset($_SESSION['nis'])) {
    header("Location: login-user.php");
    exit();
}

// Periksa status pemilih, jika sudah voting, jangan tampilkan form voting
$pemilih = $dbsuara->getPemilihById($_SESSION['nis']);
if ($pemilih['validasi_memilih'] === 'sudah_memilih') {
    echo "<script>
        alert('Anda sudah melakukan voting. Anda tidak dapat voting lagi.');
        window.location.href = 'dashboardser.php';
    </script>";
    exit();
}

// Cek waktu voting dari pengaturan
$sql = "SELECT waktu_mulai_memilih, waktu_selesai_memilih FROM pengaturan_waktu ORDER BY id DESC LIMIT 1";
$result = $dbsuara->getConnection()->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $waktu_mulai = strtotime($row['waktu_mulai_memilih']);
    $waktu_selesai = strtotime($row['waktu_selesai_memilih']);
    $sekarang = time();

    if ($sekarang < $waktu_mulai || $sekarang > $waktu_selesai) {
        die("<h2>Voting belum dibuka atau sudah ditutup.</h2>");
    }
} else {
    die("<h2>Waktu voting belum diatur.</h2>");
}

// Cek waktu voting dari pengaturan
$sql = "SELECT waktu_mulai_memilih, waktu_selesai_memilih FROM pengaturan_waktu ORDER BY id DESC LIMIT 1";
$result = $dbsuara->getConnection()->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $waktu_mulai = strtotime($row['waktu_mulai_memilih']);
    $waktu_selesai = strtotime($row['waktu_selesai_memilih']);
    $sekarang = time();

    if ($sekarang < $waktu_mulai || $sekarang > $waktu_selesai) {
        die("<h2>Voting belum dibuka atau sudah ditutup.</h2>");
    }
} else {
    die("<h2>Waktu voting belum diatur.</h2>");
}

// Ambil data kandidat secara dinamis
$dataKandidat = $dbsuara->viewKandidat();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="../Backend/img/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../Backend/img/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../Backend/img/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="icon" type="image/x-con" href="">
    <link rel="stylesheet" href="voting.css">
    <title>Voting</title>
</head>
<!-- hanaa cantikkk, lucuu, sayangg -->

<body>
    <div class="logo">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path fill="#0066FF"
                d="M13 8V4q0-.425.288-.712T14 3h6q.425 0 .713.288T21 4v4q0 .425-.288.713T20 9h-6q-.425 0-.712-.288T13 8M3 12V4q0-.425.288-.712T4 3h6q.425 0 .713.288T11 4v8q0 .425-.288.713T10 13H4q-.425 0-.712-.288T3 12m10 8v-8q0-.425.288-.712T14 11h6q.425 0 .713.288T21 12v8q0 .425-.288.713T20 21h-6q-.425 0-.712-.288T13 20M3 20v-4q0-.425.288-.712T4 15h6q.425 0 .713.288T11 16v4q0 .425-.288.713T10 21H4q-.425 0-.712-.288T3 20m2-9h4V5H5zm10 8h4v-6h-4zm0-12h4V5h-4zM5 19h4v-2H5zm4-2" />
        </svg>
        <a href="dashboardser.php">Dashboard</a>
    </div>
    </header>

    <section class="sec">
        <div class="h1">
            <h1>Pilih Sekarang!</h1>
            <h3>Pilihlah Dengan Bijak</h3>
        </div>
    </section>

    <!-- Form Voting -->
    <form action="process.php?action=vote" method="POST">
        <section class="sec1">
            <div class="nama-kan">
                <?php foreach ($dataKandidat as $kandidat): ?>
                    <div class="kan-container">
                        <div class="kan">
                            <!-- Pastikan path file gambar benar -->
                            <img src="<?php echo $kandidat['foto']; ?>" alt="">
                            <h1><?php echo $kandidat['nama']; ?></h1>
                        </div>
                        <div class="radio-container">
                            <input type="radio" name="kandidat" value="<?php echo $kandidat['no_urut']; ?>" id="kandidat<?php echo $kandidat['no_urut']; ?>">
                            <label for="kandidat<?php echo $kandidat['no_urut']; ?>">Pilih <?php echo $kandidat['nama']; ?></label>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <section class="sec3">
            <button type="submit" class="submit-button">Submit</button>
        </section>
    </form>

    <footer>
        <p>&copy; 2025, SuaraKita. All rights reserved.</p>
    </footer>

    <script>
        // Tambahkan JavaScript untuk highlight kandidat jika diinginkan
        const checkboxes = document.querySelectorAll(".radio-container input");
        const kandidatDivs = document.querySelectorAll(".kan");

        checkboxes.forEach((checkbox, index) => {
            checkbox.addEventListener("change", () => {
                document.querySelector(".selected")?.classList.remove("selected");
                kandidatDivs[index].classList.add("selected");
            });
        });

        // Cegah back setelah voting
        if (window.history && window.history.pushState) {
            window.history.pushState(null, null, window.location.href);
            window.onpopstate = function() {
                window.history.pushState(null, null, window.location.href);
            };
        }
    </script>
</body>

</html>

<!-- apa yang perlu -->