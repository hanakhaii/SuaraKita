<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="dashboardmin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <!-- sidebar -->
        <aside class="sidebar">
            <!-- logo & overlay sidebar -->
            <div class="logo">
                <!-- logo -->
                <p><span>Suara</span>Kita</p>
                <i class="bi bi-layout-sidebar-inset"></i>
            </div>
            <!-- menu sidebar -->
            <ul class="menu">
                <!-- logo and menu -->
                <li id="dashboard">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M19 11a2 2 0 0 1 1.995 1.85L21 13v6a2 2 0 0 1-1.85 1.995L19 21h-4a2 2 0 0 1-1.995-1.85L13 19v-6a2 2 0 0 1 1.85-1.995L15 11zm0-8a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"
                            class="duoicon-secondary-layer" opacity="0.3" />
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M9 3a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z" class="duoicon-primary-layer" />
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M9 15a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2z" class="duoicon-secondary-layer"
                            opacity="0.3" />
                    </svg>
                    Dashboard
                </li>

                <li id="pemilih">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16" style="margin-top: 2px;">
                        <path fill="currentColor" d="M11 7c0 1.66-1.34 3-3 3S5 8.66 5 7s1.34-3 3-3s3 1.34 3 3" />
                        <path fill="currentColor" fill-rule="evenodd" d="M16 8c0 4.42-3.58 8-8 8s-8-3.58-8-8s3.58-8 8-8s8 3.58 8 8M4 13.75C4.16 13.484 5.71 11 7.99 11c2.27 0 3.83 2.49 3.99 2.75A6.98 6.98 0 0 0 14.99 8c0-3.87-3.13-7-7-7s-7 3.13-7 7c0 2.38 1.19 4.49 3.01 5.75" clip-rule="evenodd" />
                    </svg>
                    Pemilih
                </li>

                <li id="kandidat">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M10 4h4c3.771 0 5.657 0 6.828 1.172S22 8.229 22 12s0 5.657-1.172 6.828S17.771 20 14 20h-4c-3.771 0-5.657 0-6.828-1.172S2 15.771 2 12s0-5.657 1.172-6.828S6.229 4 10 4m3.25 5a.75.75 0 0 1 .75-.75h5a.75.75 0 0 1 0 1.5h-5a.75.75 0 0 1-.75-.75m1 3a.75.75 0 0 1 .75-.75h4a.75.75 0 0 1 0 1.5h-4a.75.75 0 0 1-.75-.75m1 3a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 0 1.5h-3a.75.75 0 0 1-.75-.75M11 9a2 2 0 1 1-4 0a2 2 0 0 1 4 0m-2 8c4 0 4-.895 4-2s-1.79-2-4-2s-4 .895-4 2s0 2 4 2"
                            clip-rule="evenodd" />
                    </svg>
                    Kandidat
                </li>

                <li id="data-suara">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 640 512">
                        <path fill="currentColor"
                            d="M608 320h-64v64h22.4c5.3 0 9.6 3.6 9.6 8v16c0 4.4-4.3 8-9.6 8H73.6c-5.3 0-9.6-3.6-9.6-8v-16c0-4.4 4.3-8 9.6-8H96v-64H32c-17.7 0-32 14.3-32 32v96c0 17.7 14.3 32 32 32h576c17.7 0 32-14.3 32-32v-96c0-17.7-14.3-32-32-32m-96 64V64.3c0-17.9-14.5-32.3-32.3-32.3H160.4C142.5 32 128 46.5 128 64.3V384zM211.2 202l25.5-25.3c4.2-4.2 11-4.2 15.2.1l41.3 41.6l95.2-94.4c4.2-4.2 11-4.2 15.2.1l25.3 25.5c4.2 4.2 4.2 11-.1 15.2L300.5 292c-4.2 4.2-11 4.2-15.2-.1l-74.1-74.7c-4.3-4.2-4.2-11 0-15.2" />
                    </svg>
                    Data Suara
                </li>

                <li id="quick-count">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M12.728 2.216a.75.75 0 0 1 .544-.212a9 9 0 0 1 8.724 8.724a.75.75 0 0 1-.75.772H13.25a.75.75 0 0 1-.75-.75V2.754a.75.75 0 0 1 .228-.538M11 4.784a.75.75 0 0 0-.817-.747a9 9 0 1 0 9.78 9.78a.75.75 0 0 0-.747-.817H11z" />
                    </svg>
                    Pengaturan
                </li>

                <li class="logout" onclick="confirmLogout()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M6 2h9a2 2 0 0 1 2 2v2h-2V4H6v16h9v-2h2v2a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2" />
                        <path fill="currentColor" d="M16.09 15.59L17.5 17l5-5l-5-5l-1.41 1.41L18.67 11H9v2h9.67z" />
                    </svg>
                    Logout
                </li>

                <!-- buat logout -->
                <script>
                    function confirmLogout() {
                        if (confirm("Apakah Anda yakin ingin logout?")) {
                            window.location.href = 'logout.php';
                        }
                    }
                </script>
            </ul>
            <!-- footer -->
            <div class="footer">&copy; 2025, SuaraKita. All rights reserved.</div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="main-quick">
            <h1>Hasil Quick Count</h1>
            <div class="chart-container">
                <canvas id="voteChart" style="display: inline;"></canvas>
            </div>

            <div class="data-container">
                <div class="data-box">
                    <div><img src="../img/bng_mandra.jpg" alt="" srcset="" style="width: 60px; border-radius: 50%;"></div>
                    <div>
                        <div class="candidate-name">Kandidat 1</div>
                        <div>
                            <p>Bang Mandra</p>
                        </div>
                    </div>
                    <div class="horizontal-line"></div>
                    <div>
                        <div class="vote-count">1.234</div>
                        <div class="percentage">32%</div>
                    </div>
                </div>

                <div class="data-box">
                    <div><img src="../img/davit_glasses.jpg" alt="" srcset="" style="width: 60px; border-radius: 50%;"></div>
                    <div>
                        <div class="candidate-name">Kandidat 2</div>
                        <div>
                            <p>David Glasses</p>
                        </div>
                    </div>
                    <div class="horizontal-line"></div>
                    <div>
                        <div class="vote-count">987</div>
                        <div class="percentage">26%</div>
                    </div>
                </div>

                <div class="data-box">
                    <div><img src="../img/amba_yungkai.jpg" alt="" srcset="" style="width: 60px; border-radius: 50%;"></div>
                    <div class="name">
                        <div class="candidate-name">Kandidat 3</div>
                        <div>
                            <p>Bung Amba</p>
                        </div>
                    </div>
                    <div class="horizontal-line"></div>
                    <div class="jumlah">
                        <div class="vote-count">1.567</div>
                        <div class="percentage">42%</div>
                    </div>
                </div>
            </div>

            <!-- <script src="../js/script(hanaa).js"></script> -->
        </main>
    </div>

    <!-- javascript -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.querySelector(".sidebar");
            const toggleIcon = document.querySelector(".sidebar .logo i");

            // Fungsi toggle sidebar
            toggleIcon.addEventListener("click", function() {
                sidebar.classList.toggle("closed");

                // Ganti ikon
                if (sidebar.classList.contains("closed")) {
                    toggleIcon.classList.remove("bi-layout-sidebar-inset");
                    toggleIcon.classList.add("bi-layout-sidebar-inset-reverse");
                } else {
                    toggleIcon.classList.remove("bi-layout-sidebar-inset-reverse");
                    toggleIcon.classList.add("bi-layout-sidebar-inset");
                }
            });
        });

        // Fungsi untuk menangani klik pada <li>
        function handleLiClick(event) {
            // Dapatkan ID dari elemen yang diklik
            const id = event.currentTarget.id;

            // Tentukan URL berdasarkan ID
            let url;
            switch (id) {
                case 'dashboard':
                    url = '/Backend/dashboardmin.php';
                    break;
                case 'pemilih':
                    url = '/Backend/data_pemilih.php';
                    break;
                case 'kandidat':
                    url = '/Backend/data_kandidat.php';
                    break;
                case 'data-suara':
                    url = '/Backend/data_suara.php';
                    break;
                case 'quick-count':
                    url = '/Backend/pengaturan.php';
                    break;
                default:
                    url = '#';
            }

            // Arahkan ke URL yang sesuai
            window.location.href = url;
        }

        // Dapatkan semua elemen <li> dengan ID
        const liElements = document.querySelectorAll('ul.menu li[id]');

        // Tambahkan event listener untuk setiap elemen <li>
        liElements.forEach(li => {
            li.addEventListener('click', handleLiClick);
        });

        // Data untuk diagram
        const voteData = {
            labels: ['Kandidat 1', 'Kandidat 2', 'Kandidat 3'],
            datasets: [{
                label: 'Jumlah Suara',
                data: [1234, 987, 167],
                backgroundColor: [
                    '#3498db',
                    '#e74c3c',
                    '#2ecc71'
                ],
                borderWidth: 1
            }]
        };

        // Konfigurasi chart
        const config = {
            type: 'bar',
            data: voteData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Distribusi Suara'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString();
                            }
                        }
                    }
                }
            }
        };

        // Inisialisasi chart
        const voteChart = new Chart(
            document.getElementById('voteChart'),
            config
        );
    </script>
</body>

</html>