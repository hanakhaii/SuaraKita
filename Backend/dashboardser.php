<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

if (!isset($_SESSION['nis'])) {
    header("Location: login-user.php");
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
    <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="icon" type="image/x-con" href="">
    <link rel="stylesheet" href="dashboardser.css">
    <title>Dashboard User</title>
</head>

<body>
    <div class="scroll-area">
        <header>
            <div class="burger">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
            <h1><span>Suara</span>Kita</h1>
            <nav>
                <ul class="nav-links">
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
                            <div class="kandidat-content">
                                <h1 class="judul"><?php echo $row['nama']; ?></h1>
                                <div class="foto">
                                    <img src="<?php echo $row['foto']; ?>" alt=""> 
                                </div>
                                <div class="deskripsi">
                                    <p><?php echo substr($row['deskripsi'], 0, 150); ?></p>
                                </div>
                            </div>
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
                <h1>PERATURAN YANG BERLAKU</h1>
                <p>Demi menjaga integritas pemungutan suara, setiap pemilih wajib mematuhi peraturan yang berlaku.</p>
                <div class="rules">
                    <div class="list-rules">
                        <img src="/img/rule1.png" alt="">
                        <p>Setiap pemilih hanya boleh memilih satu kandidat</p>
                    </div>
                    <div class="list-rules">
                        <img src="/img/rule2.png" alt="">
                        <p>Dilarang menghasut atau mempengaruhi pemilih lain untuk memilih calon tertentu dengan cara yang tidak etis</p>
                    </div>
                    <div class="list-rules">
                        <img src="/img/rule3.png" alt="">
                        <p>Gunakan hak pilih dengan bijak, hindari kecurangan, dan pastikan data pribadi Anda aman</p>
                    </div>
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

            document.addEventListener("DOMContentLoaded", function() {
                const links = document.querySelectorAll("nav ul li a[href^='#']");
                links.forEach(link => {
                    link.addEventListener("click", function(e) {
                        e.preventDefault();
                        const targetId = this.getAttribute("href").substring(1);
                        const targetElement = document.getElementById(targetId);
                        if (targetElement) {
                            window.scrollTo({
                                top: targetElement.offsetTop - 50,
                                behavior: "smooth"
                            });
                        }
                    });
                });
            });


            // Fungsi logout
            function confirmLogout() {
                if (confirm("Apakah Anda yakin ingin logout?")) {
                    allowBack = true; // Izinkan navigasi
                    window.location.href = "logout.php";
                }
            }

            // js untuk navbarr buat hanaa tersayangg 💗
            const burger = document.querySelector('.burger');
            const navLinks = document.querySelector('.nav-links');
            const navItems = document.querySelectorAll('.nav-links li');

            burger.addEventListener('click', () => {
                // Toggle Nav
                navLinks.classList.toggle('nav-active');

                // Animate Links
                navItems.forEach((link, index) => {
                    if (link.style.animation) {
                        link.style.animation = '';
                    } else {
                        link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.3}s`;
                    }
                });

                // Burger Animation
                burger.classList.toggle('toggle');
            });

            // Tutup menu saat klik link atau area lain
            document.addEventListener('click', (e) => {
                if (!navLinks.contains(e.target) && !burger.contains(e.target)) {
                    navLinks.classList.remove('nav-active');
                    burger.classList.remove('toggle');
                    navItems.forEach(link => {
                        link.style.animation = '';
                    });
                }
            });

            // Handle resize window
            window.addEventListener('resize', () => {
                if (window.innerWidth > 900) {
                    navLinks.classList.remove('nav-active');
                    burger.classList.remove('toggle');
                    navItems.forEach(link => {
                        link.style.animation = '';
                    });
                }
            });
        </script>

</body>

</html>