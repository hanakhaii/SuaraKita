<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

if (!isset($_SESSION['nis'])) {
    header("Location: login-user.php");
    exit();
}

include 'db.php';
$dbsuara = new Database();

//Ambil data kandidat dari database
$sql_kandidat = "SELECT * FROM kandidat";
$result_kandidat = $dbsuara->getConnection()->query($sql_kandidat);

// Cek jika query gagal
if (!$result_kandidat) {
    die("Query kandidat gagal: " . $dbsuara->getConnection()->error);
}

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
    <link rel="apple-touch-icon" sizes="180x180" href="../Backend/img/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../Backend/img/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../Backend/img/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="icon" type="image/x-con" href="">
    <link rel="stylesheet" href="dashboardser.css">
    <title>Dashboard User</title>
</head>

<body>
    <div class="scroll-area">
        <header>
            <h1><span>Suara</span>Kita</h1>

            <!-- Burger Menu -->
            <div class="burger">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
            <div class="overlay"></div>

            <nav>
                <ul>
                    <li><a href="#kandidat">Kandidat</a></li>
                    <li><a href="#rules">Peraturan</a></li>
                    <li><a href="#vote">Pilih Sekarang</a></li>
                    <li><a href="#quick">QuickCount</a></li>
                    <li><a href="#" onclick="confirmLogout()">Logout</a></li>
                </ul>
            </nav>
        </header>

        <section class="sec1">
            <div class="floating"></div>
            <div class="floating"></div>
            <div class="floating"></div>

            <div class="inline1">
                <h1>Halo, Selamat Datang <br> <span><?php echo $_SESSION['nama']; ?>!</span></h1>
                <p>Selamat datang di SuaraKita! Platform pemungutan suara yang transparan, adil, dan mudah digunakan. Suara Anda adalah kekuatan perubahan!</p>
            </div>
        </section>

        <section id="kandidat" class="sec2">
            <?php if ($result_kandidat->num_rows > 0): ?>
                <h1>KANDIDAT</h1>
                <div class="inline2">
                    <?php while ($row = $result_kandidat->fetch_assoc()): ?>
                        <div class="kandidat">
                            <h1 class="judul"><?php echo $row['nama']; ?></h1>
                            <img src="<?php echo $row['foto']; ?>" alt="">
                            <p><?php echo substr($row['deskripsi'], 0, 150); ?></p>
                            <?php
                            $nama_file = strtolower(str_replace(' ', '-', $row['nama']));
                            ?>
                            <button onclick="window.location.href='tampilan-kandidat1.php?nama=<?php echo urlencode($row['nama']); ?>'">Lihat</button>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </section>

        <section id="rules" class="sec3">
            <div class="inline3">
                <h1>Peraturan yang berlaku</h1>
                <p>Demi menjaga integritas pemungutan suara, setiap pemilih wajib mematuhi peraturan yang berlaku.</p>

                <div class="list-rules">
                    <p>1. <mark>Setiap pemilih hanya boleh memilih satu kandidat.</mark></p>
                    <p>2. <mark>Dilarang menghasut atau mempengaruhi pemilih lain untuk memilih calon tertentu dengan cara yang tidak etis.</mark></p>
                    <p>3. <mark>Gunakan hak pilih dengan bijak, hindari kecurangan, dan pastikan data pribadi Anda aman.</mark></p>
                </div>

                <p><b>Suara Anda menentukan arah kebijakan ke depan!</b></p>
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
                    <img src="../img/pie-chart.png" alt="" srcset="">
                </div>
            </div>
        </section>

        <footer>
            <p> &copy; 2025, SuaraKita. All rights reserved.</p>
        </footer>


        <script>
            // Mengunci fungsi tombol "Back"
            history.pushState(null, null, location.href);

            // Cegah tombol back browser
            // history.pushState(null, null, location.href);
            // window.onpopstate = function() {
            //     history.pushState(null, null, location.href);
            //     alert("Navigasi mundur tidak diizinkan pada halaman ini!");
            // };

            const burger = document.querySelector('.burger');
            const navUl = document.querySelector('nav ul');
            const overlay = document.querySelector('.overlay');
            let allowBack = false;

            // Fungsi logout
            function confirmLogout() {
                if (confirm("Apakah Anda yakin ingin logout?")) {
                    allowBack = true; // Izinkan navigasi
                    window.location.href = "logout.php";
                }
            }

            // Burger Menu Toggle
            burger.addEventListener('click', () => {
                navUl.classList.toggle('active');
                burger.classList.toggle('active');
                overlay.classList.toggle('active');
                document.body.classList.toggle('no-scroll');
            });

            // Tutup sidebar
            overlay.addEventListener('click', closeSidebar);
            document.querySelectorAll('nav ul li a').forEach(link => {
                link.addEventListener('click', closeSidebar);
            });

            function closeSidebar() {
                burger.classList.remove('active');
                navUl.classList.remove('active');
                overlay.classList.remove('active');
                document.body.classList.remove('no-scroll');
            }
        </script>

</body>

</html>