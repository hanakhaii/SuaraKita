<?php
include 'db.php';
$db = new Database();
$kandidatData = $db->getAllKandidat();
$totalSuara = $dbsuara->getTotalSuara();
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
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="dashboardmin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Dashboard Admin SuaraKita</title>

    <style>
        img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }
    </style>
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
                        <path fill="currentColor" d="M12 8a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 2a2 2 0 0 0-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2m-2 12c-.25 0-.46-.18-.5-.42l-.37-2.65c-.63-.25-1.17-.59-1.69-.99l-2.49 1.01c-.22.08-.49 0-.61-.22l-2-3.46a.493.493 0 0 1 .12-.64l2.11-1.66L4.5 12l.07-1l-2.11-1.63a.493.493 0 0 1-.12-.64l2-3.46c.12-.22.39-.31.61-.22l2.49 1c.52-.39 1.06-.73 1.69-.98l.37-2.65c.04-.24.25-.42.5-.42h4c.25 0 .46.18.5.42l.37 2.65c.63.25 1.17.59 1.69.98l2.49-1c.22-.09.49 0 .61.22l2 3.46c.13.22.07.49-.12.64L19.43 11l.07 1l-.07 1l2.11 1.63c.19.15.25.42.12.64l-2 3.46c-.12.22-.39.31-.61.22l-2.49-1c-.52.39-1.06.73-1.69.98l-.37 2.65c-.04.24-.25.42-.5.42zm1.25-18l-.37 2.61c-1.2.25-2.26.89-3.03 1.78L5.44 7.35l-.75 1.3L6.8 10.2a5.55 5.55 0 0 0 0 3.6l-2.12 1.56l.75 1.3l2.43-1.04c.77.88 1.82 1.52 3.01 1.76l.37 2.62h1.52l.37-2.61c1.19-.25 2.24-.89 3.01-1.77l2.43 1.04l.75-1.3l-2.12-1.55c.4-1.17.4-2.44 0-3.61l2.11-1.55l-.75-1.3l-2.41 1.04a5.42 5.42 0 0 0-3.03-1.77L12.75 4z" />
                    </svg>
                    Pengaturan
                </li>

                <li id="akun-admin">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M10 4a4 4 0 0 0-4 4a4 4 0 0 0 4 4a4 4 0 0 0 4-4a4 4 0 0 0-4-4m7 8a.26.26 0 0 0-.26.21l-.19 1.32c-.3.13-.59.29-.85.47l-1.24-.5c-.11 0-.24 0-.31.13l-1 1.73c-.06.11-.04.24.06.32l1.06.82a4.2 4.2 0 0 0 0 1l-1.06.82a.26.26 0 0 0-.06.32l1 1.73c.06.13.19.13.31.13l1.24-.5c.26.18.54.35.85.47l.19 1.32c.02.12.12.21.26.21h2c.11 0 .22-.09.24-.21l.19-1.32c.3-.13.57-.29.84-.47l1.23.5c.13 0 .26 0 .33-.13l1-1.73a.26.26 0 0 0-.06-.32l-1.07-.82c.02-.17.04-.33.04-.5s-.01-.33-.04-.5l1.06-.82a.26.26 0 0 0 .06-.32l-1-1.73c-.06-.13-.19-.13-.32-.13l-1.23.5c-.27-.18-.54-.35-.85-.47l-.19-1.32A.236.236 0 0 0 19 12zm-7 2c-4.42 0-8 1.79-8 4v2h9.68a7 7 0 0 1-.68-3a7 7 0 0 1 .64-2.91c-.53-.06-1.08-.09-1.64-.09m8 1.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5c-.84 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5" />
                    </svg>
                    Akun Anda
                </li>
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

            <!-- Di bagian HTML, tambahkan ini setelah chart -->
            <div class="table-container">
                <h2>Detail Data Suara</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kandidat Dipilih</th>
                            <th>Waktu Memilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $suara = $db->getAllSuara();

                        foreach ($suara as $data) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($data['id_suara']) . "</td>";
                            echo "<td>" . htmlspecialchars($data['no_urut_kandidat'] . " - " . $data['nama_kandidat']) . "</td>";
                            echo "<td>" . htmlspecialchars($data['waktu_milih']) . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
            // Loop untuk menampilkan data kandidat + persentase
            foreach ($kandidatData as $dataKandidat) {
                $persentase = ($totalSuara > 0)
                    ? ($dataKandidat['jumlah_suara'] / $totalSuara) * 100 : 0;
            ?>
            <div class="data-container">
                <div class="data-box">
                    <div class="img-kandidat"><img src="<?= $dataKandidat['foto'] ?>"></div>
                    <div class="name">
                        <div class="candidate-name">Kandidat <?= $dataKandidat['no_urut'] ?></div>
                        <div>
                            <p><?= $dataKandidat['nama'] ?></p>
                        </div>
                    </div>
                    <div class="horizontal-line"></div>
                    <div class="jumlah">
                        <div class="vote-count"><?= number_format($dataKandidat['jumlah_suara']) ?></div>
                        <div class="percentage"><?= number_format($persentase, 2) ?>%</div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </main>
    </div>

    <script>
        // Konversi data PHP ke JavaScript
        const kandidatLabels = <?php echo json_encode(array_column($kandidatData, 'nama')); ?>;
        const jumlahSuara = <?php echo json_encode(array_column($kandidatData, 'jumlah_suara')); ?>;
    </script>

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
                case 'akun-admin':
                    url = '/Backend/akun_admin.php';
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

        // Ganti data statis dengan data dari PHP
        const voteData = {
            labels: kandidatLabels, // Menggunakan nama kandidat dari database
            datasets: [{
                label: 'Jumlah Suara',
                data: jumlahSuara, // Menggunakan jumlah suara dari database
                backgroundColor: [
                    '#3498db',
                    '#e74c3c',
                    '#2ecc71',
                    // Tambahkan lebih banyak warna jika ada kandidat lebih dari 3
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