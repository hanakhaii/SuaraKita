<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home SuaraKita</title>
    <link rel="stylesheet" href="home.css">
</head>

<body>
    <nav>
        <h1><span>Suara</span>Kita</h1>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#voting">Voting</a></li>
            <li><a href="#kandidat">Kandidat</a></li>
            <li><a href="#quickcount">QuickCount</a></li>
            <li>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal" style="margin-top: -8px;">
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

    <section class="slideshow">
        <div class="slides">
            <div class="slide" style="background-image: url('../Backend/img/ilustaratsiSatu.jpg');">
                <div class="text-overlay">
                    <h1>Welcome</h1>
                    <p>Online Voting System</p>
                    <button class="btn btn-primary" onclick="requireLogin()">Vote Now</button>
                </div>
            </div>
            <div class="slide" style="background-image: url('../Backend/img/ilustrasiDua.jpg');">
                <div class="text-overlay">
                    <h1>Voting is Important</h1>
                    <p>Choose Your Leader</p>
                    <button class="btn btn-primary" onclick="requireLogin()">Vote Now</button>
                </div>
            </div>
            <div class="slide" style="background-image: url('../Backend/img/ilustrasiTiga.jpg');">
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

    <section class="sec1" id="voting">
        <div class="inline1">
            <h1>Online Voting <br> System</h1>
            <p>Sistem pemungutan suara online adalah solusi modern yang memungkinkan proses pemilihan OSIS 
                dilakukan secara digital, cepat, dan aman.</p>
            <a href="#" onclick="requireLogin()" class="btn btn-primary" style="background-color: #FC0134;">Mulai Voting</a>
        </div>
    </section>

    <section class="sec2" id="kandidat">
        <div class="inline2">
            <center>
                <h1>Pilih Sekarang!</h1>
                <p>Pilih kandidat terbaik yang memiliki visi, misi, dan program kerja sesuai dengan harapanmu.</p>
                <a href="#" onclick="requireLogin()" class="btn btn-primary">Lihat Kandidat</a>
            </center>
        </div>
    </section>

    <section class="sec3" id="quickcount">
        <div class="inline3">
            <div>
                <h1>QuickCount</h1>
                <p>Setelah pemungutan suara selesai, sistem akan secara otomatis menghitung hasil suara dengan metode QuickCount.</p>
                <a href="#" onclick="requireLogin()" class="btn btn-primary">Selengkapnya</a>
            </div>
            <div class="gambal">
                <img src="../Backend/img/pie-chart.png" alt="">
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2025, SuaraKita. All rights reserved.</p>
    </footer>

    <!-- JavaScript -->
    <script>
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
    </script>
</body>
</html>
