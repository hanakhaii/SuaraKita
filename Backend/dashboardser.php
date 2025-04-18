<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
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

$waktu_mulai = null;
$waktu_selesai = null;
$sekarang = time();
$voting_dibuka = false;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $waktu_mulai = strtotime($row['waktu_mulai_memilih']);
    $waktu_selesai = strtotime($row['waktu_selesai_memilih']);

    // Cek apakah waktu sekarang berada dalam rentang waktu voting
    if ($sekarang >= $waktu_mulai && $sekarang <= $waktu_selesai) {
        $voting_dibuka = true;
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboardser.css">
    <title>Dashboard User</title>
</head>

<body>

    <header>
        <h1><span>Suara</span>Kita</h1>
        <nav>
            <ul>
                <li><a href="#kandidat">Kandidat</a></li>
                <li><a href="#rules">Peraturan</a></li>
                <li><a href="#vote">Pilih Sekarang</a></li>
                <li><a href="#quick">QuickCount</a></li>
                <li><a href="#" onclick="confirmLogout()">Logout</a></li>

                <script>
                    function confirmLogout() {
                        if (confirm("Apakah Anda yakin ingin logout?")) {
                            window.location.href = "logout.php";
                        }
                    }
                </script>
            </ul>
        </nav>
    </header>

    <section class="sec1">
        <div class="inline1">
            <h1>Halo, Selamat Datang <br> <span><?php echo $_SESSION['nama']; ?>!</span></h1>
            <p>Selamat datang di SuaraKita! Platform pemungutan suara yang transparan, adil, dan mudah digunakan.</p>
        </div>
    </section>

    <section id="kandidat" class="sec2">
        <h1>KANDIDAT</h1>
        <div class="inline2">
            <div class="kandidat" style="margin-left: -10px;">
                <h1 class="judul">01</h1>
                <img src="/Backend/img/harry.jpg" alt="">
                <p>[Nama Kandidat] adalah seorang pemimpin yang berkomitmen pada inovasi dan kemajuan. Dengan pengalaman
                    dan dedikasinya, ia ingin membawa perubahan positif bagi kita semua.</p>
                <button onclick="window.location.href='tampilan-kandidat1.php'">Lihat</button>
            </div>
            <div class="kandidat">
                <h1 class="judul">02</h1>
                <img src="/Backend/img/harry2.jpg" alt="">
                <p>Dengan semangat kebersamaan, [Nama Kandidat] bertekad menciptakan lingkungan yang lebih harmonis dan
                    inklusif. Ia percaya bahwa setiap suara memiliki peran penting dalam membangun masa depan.</p>
                <button onclick="window.location.href='tampilan-kandidat2.php'">Lihat</button>

            </div>
            <div class="kandidat">
                <h1 class="judul">03</h1>
                <img src="/Backend/img/harry3.jpg" alt="">
                <p>Kepemimpinan yang adil dan transparan adalah visi utama [Nama Kandidat]. Ia siap mendengar, bekerja,
                    dan berkolaborasi untuk mencapai tujuan bersama.
                </p>
                <button onclick="window.location.href='tampilan-kandidat3.php'">Lihat</button>

            </div>
        </div>
    </section>

    <section id="rules" class="sec3">
        <div class="inline3">
            <h1>Peraturan yang berlaku</h1>
            <p>Demi menjaga integritas pemungutan suara, setiap pemilih wajib mematuhi <a href="">peraturan yang berlaku</a>. Gunakan
                hak pilih dengan bijak, hindari kecurangan, dan pastikan data pribadi Anda aman. Suara Anda menentukan
                arah kebijakan ke depan!</p>
        </div>
    </section>

    <section id="vote" class="sec4">
        <div class="inline4">
            <h1>Ayo Memilih!</h1>
            <p>Saatnya memilih! Berikan suara Anda untuk calon terbaik yang akan membawa perubahan positif. Jangan
                biarkan hak suara Anda terbuang sia-sia, karena satu suara bisa membuat perbedaan besar!</p>
            <?php if ($voting_dibuka): ?>
                <button class="btn-vote" onclick="window.location.href='voting.php'">Vote Now!</button>
            <?php else: ?>
                <button class="btn-vote" disabled>Voting Belum Dibuka atau Sudah Ditutup</button>
            <?php endif; ?>
        </div>
    </section>

    <section id="quick" class="sec5">
        <h1>Quick Count</h1>
        <div class="inline5">
            <div class="count">
                <p>Pantau hasil sementara pemungutan suara secara real-time dengan fitur Quick Count. Data diperbarui
                    secara berkala agar Anda selalu mendapatkan informasi terbaru. Transparansi adalah kunci utama dalam
                    pemilihan ini!</p>
                <?php if ($voting_dibuka): ?>
                    <button class="btn-vote" onclick="window.location.href='quickcount.php'">Lihat Detail!</button>
                <?php else: ?>
                    <button class="btn-vote" disabled>Quickcount Belum Dibuka atau Sudah Ditutup</button>
                <?php endif; ?>
            </div>
            <div>
                <img src="/Backend/img/pie-chart.png" alt="" srcset="">
            </div>
        </div>
    </section>

    <footer>
        <p> &copy; 2025, SuaraKita. All rights reserved.</p>
    </footer>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const links = document.querySelectorAll("nav ul li a[href^='#']");
            links.forEach(link => {
                link.addEventListener("click", function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute("href").substring(1);
                    const targetElement = document.getElementById(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: "smooth"
                        });
                    }
                });
            });
        });

        // Mengunci fungsi tombol "Back"
        history.pushState(null, null, location.href);

        window.onpopstate = function() {
            // Saat tombol "Back" diklik, tetap berada di halaman ini
            history.pushState(null, null, location.href);
            alert("Navigasi mundur tidak diizinkan pada halaman ini!");
        };
    </script>

</body>

</html>