// Fungsi untuk menampilkan modal
    document.getElementById('openModalButton').addEventListener('click', function () {
        var modal = new bootstrap.Modal(document.getElementById('loginModal'));
        modal.show();
    });

    // Fungsi untuk redirect ke login.html
    document.getElementById('loginButton').addEventListener('click', function () {
        window.location.href = "login.html"; 
    });

// untuk validasi password
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text'; // Tampilkan password
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash'); // Ganti ikon ke mata tertutup
    } else {
        passwordInput.type = 'password'; // Sembunyikan password
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye'); // Ganti ikon ke mata terbuka
    }
}

// fungsi untuk tampilan dashboard utama admin
function dashboardAdmin() {
    window.location.replace(admin/dashboard.html);
}

function menu_userSettings() {
    window.location.replace(admin/pengguna.html);
}

// untuk transisi slideshow gambar
let currentSlide = 0;
const slides = document.querySelector('.slides');
const slideCount = document.querySelectorAll('.slide').length;
const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');

function updateSlidePosition() {
    slides.style.transform = `translateX(-${currentSlide * 100}%)`;
}

// Fungsi untuk geser otomatis tiap 3 detik
function autoSlide() {
    currentSlide = (currentSlide + 1) % slideCount;
    updateSlidePosition();
}

// Event listener untuk tombol navigasi
prevButton.addEventListener('click', () => {
    currentSlide = (currentSlide > 0) ? currentSlide - 1 : slideCount - 1;
    updateSlidePosition();
});

nextButton.addEventListener('click', () => {
    currentSlide = (currentSlide + 1) % slideCount;
    updateSlidePosition();
});

// Set interval untuk otomatis geser
setInterval(autoSlide, 3000);