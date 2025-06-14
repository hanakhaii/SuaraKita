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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="home.css">
    <title>SuaraKita</title>
</head>

<body>
    <header>
        <!-- navigasi -->
        <nav>
            <div class="burger">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
            <h3>Suara<span>Kita</span></h3>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">Tentang Kami</a></li>
                <li><a href="#how">Panduan</a></li>
                <li><a href="#kandidat">Pilih Sekarang</a></li>
                <li><a href="#quickcount">QuickCount</a></li>
                <li>
                    <button type="button" class="btn-login" data-bs-toggle="modal" data-bs-target="#loginModal" style="margin-top: -7px;">
                        Login
                    </button>
                </li>
            </ul>

        </nav>

        <!-- Modal Login -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">Login SuaraKita</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <a class="btn btn-outline-primary w-100" href="login-user.php">Login Sebagai User</a>
                        <div class="text-center my-2">atau</div>
                        <a class="btn btn-outline-secondary w-100" href="login-admin.php">Login Sebagai Admin</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <section id="home" class="slideshow">
            <div class="slides">
                <div class="slide" style="background-image: url('../img/ilustaratsiSatu.jpg');">
                    <div class="text-overlay">
                        <h1>Welcome</h1>
                        <p>Online Voting System</p>
                        <button class="btn btn-primary" onclick="requireLogin()">Vote Now</button>
                    </div>
                </div>
                <div class="slide" style="background-image: url('../img/ilustrasiDua.jpg');">
                    <div class="text-overlay">
                        <h1>Voting is Important</h1>
                        <p>Choose Your Leader</p>
                        <button class="btn btn-primary" onclick="requireLogin()">Vote Now</button>
                    </div>
                </div>
                <div class="slide" style="background-image: url('../img/ilustrasiTiga.jpg');">
                    <div class="text-overlay">
                        <h1>Quick Count</h1>
                        <p>Real-time Results</p>
                        <button class="btn btn-primary" onclick="requireLogin()">Vote Now</button>
                    </div>
                </div>
            </div>
            <button class="prev">❮</button>
            <button class="next">❯</button>
        </section>

        <!-- about us section  -->
        <section id="about" class="about-us">
            <div style="align-self: center;">
                <h2>Tentang Kami</h2>
                <h4>Suara Anda, Masa Depan Kita!</h4>
                <p> SuaraKita adalah platform pemungutan suara digital yang dibuat khusus untuk pemilihan OSIS. Kami ingin membuat proses pemilu jadi lebih transparan.
                    Lewat SuaraKita, semua siswa bisa ikut berpartisipasi aktif dalam demokrasi sekolah dengan cara yang modern dan aman. <br>
                </p>
                <p>
                    <b>Visi</b> kami adalah <mark>menciptakan sistem pemilihan OSIS yang jujur, mudah diakses, dan menyenangkan.</mark> <br>
                    <b>Misi</b> kami adalah <mark>menghadirkan pengalaman pemilu yang adil, real-time, dan terbuka untuk semua pelajar.</mark>
                </p>
                <p>
                    Yuk, wujudkan pemilu OSIS yang lebih berintegritas bersama SuaraKita!
                    <b>Dirancang oleh pelajar, untuk pelajar</b>
                </p>
                <button class="btn-home" onclick="requireLogin()">Pilih Sekarang</button>
            </div>
            <div>
                <img src="../img/icon-suarakita.png" alt="" width="400px">
            </div>
        </section>
    </header>

    <main>
        <!-- panduan section -->
        <section id="how" class="panduan">
            <h2>3 STEP MUDAH UNTUK VOTING!</h2>
            <div class="steps">
                <div class="step">
                    <img src="/img/1.png" alt="">
                    <h3>Login sebagai user</h3>
                </div>
                <h1>></h1>
                <div class="step">
                    <img src="/img/2.png" alt="">
                    <h3>Tentukan Pilihanmu</h3>
                </div>
                <h1>></h1>
                <div class="step">
                    <img src="/img/3.png" alt="">
                    <h3>Voting</h3>
                </div>
            </div>
        </section>

        <!-- kandidat section -->
        <section id="kandidat" class="kandidat">
            <div class="kandidat-space">
                <h2>PILIH SEKARANG!</h2>
                <div class="kandidat-grid">
                    <div class="grid1">
                        <h3> 01 </h3>
                        <img src="../img/Group 30.png" alt="" width="150px">
                    </div>
                    <div class="grid2">
                        <h3>02</h3>
                        <img src="../img/Group 30.png" alt="" width="150px">
                    </div>
                    <div class="grid3">
                        <h3>03</h3>
                        <img src="../img/Group 30.png" alt="" width="150px">
                    </div>
                </div>
                <h3>🗳 Kenali, Pilih, Tentukan! 🗳</h3>
                <p>Lihat profil kandidat, pahami visi-misinya,<br> dan buat keputusan terbaik untuk sekolah di masa yang akan datang!</p>
                <button class="btn-home" onclick="requireLogin()">Lihat Kandidat</button>
            </div>
        </section>

        <!-- quickcount -->
        <section id="quickcount" class="quickcount">
            <h2>QUICKCOUNT</h2>
            <section class="data">
                <div style="width: 30%; height: 30%; margin: auto;">
                    <canvas id="myChart" style="display:block;"></canvas>
                </div>
                <script>
                    // Data diagram
                    const labels = ['Kandidat ?', 'Kandidat ?', 'Kandidat ?'];
                    const data = [25, 150, 70]; // Jumlah suara

                    // Total jumlah suara
                    const total = data.reduce((sum, value) => sum + value, 0);

                    // Hitung persentase setiap data
                    const percentages = data.map(value => ((value / total) * 100).toFixed(1) + '%');

                    // Buat grafik menggunakan Chart.js
                    const ctx = document.getElementById('myChart').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels.map((label, index) => `${label} (${percentages[index]})`), // Perbaikan template literal
                            datasets: [{
                                data: data,
                                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'], // Warna untuk setiap bagian
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false, // ← tambahkan ini
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top', // Posisi legenda
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            const index = tooltipItem.dataIndex;
                                            return `${labels[index]}: ${data[index]} suara (${percentages[index]})`; // Perbaikan template literal
                                        }
                                    }
                                }
                            }
                        }
                    });
                </script>
            </section>
            <h4>⏳ Hasil Cepat, Keputusan Akurat! ⏳</h4>
            <p> Pantau perhitungan suara secara real-time dan tetap update dengan hasil terbaru!</p>
            <button class="btn-home" onclick="requireLogin()">Selengkapnya</button>
        </section>
    </main>

    <footer>
        <div>
            <p>© 2025, SuaraKita. All rights reserved.</p>
            <p style="margin-left: 13px;">Send your feedback to <a href="">suarakita@gmail.com</a></p>
        </div>
        <div>
            <p>Powered by Tim SuaraKita</a></p>
            <p>Menuju masa depan demokrasi yang lebih baik!</p>
        </div>
    </footer>

    <!-- JavaScript -->
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
                            top: targetElement.offsetTop - 50,
                            behavior: "smooth"
                        });
                    }
                });
            });
        });

        function requireLogin() {
            var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        }

        let currentSlide = 0;
        const slides = document.querySelector('.slides');
        const slideCount = document.querySelectorAll('.slide').length;
        const prevButton = document.querySelector('.prev');
        const nextButton = document.querySelector('.next');

        function updateSlidePosition() {
            slides.style.transform = `translateX(-${currentSlide * 100}%)`;
        }

        function autoSlide() {
            currentSlide = (currentSlide + 1) % slideCount;
            updateSlidePosition();
        }

        prevButton.addEventListener('click', () => {
            currentSlide = (currentSlide > 0) ? currentSlide - 1 : slideCount - 1;
            updateSlidePosition();
        });

        nextButton.addEventListener('click', () => {
            currentSlide = (currentSlide + 1) % slideCount;
            updateSlidePosition();
        });

        setInterval(autoSlide, 3000);

        // Burger Menu Toggle
        const burger = document.querySelector('.burger');
        const nav = document.querySelector('.nav-links');
        const navLinks = document.querySelectorAll('.nav-links li');

        burger.addEventListener('click', () => {
            // Toggle Nav
            nav.classList.toggle('nav-active');

            // Animate Links
            navLinks.forEach((link, index) => {
                if (link.style.animation) {
                    link.style.animation = '';
                } else {
                    link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.3}s`;
                }
            });

            // Burger Animation
            burger.classList.toggle('toggle');
        });

        // Tutup menu saat klik link
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                nav.classList.remove('nav-active');
                burger.classList.remove('toggle');
                navLinks.forEach(link => {
                    link.style.animation = '';
                });
            });
        });
    </script>
</body>

</html>