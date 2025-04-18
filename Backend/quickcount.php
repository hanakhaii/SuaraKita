<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
include 'db.php';
$dbsuara = new Database();

// Ambil waktu quickcount terbaru
$pengaturan = $dbsuara->getPengaturanWaktu();
$sekarang = time();

if (!$pengaturan || !$pengaturan['waktu_quickcount'] || !$pengaturan['waktu_selesai_quickcount']) {
    die("Quick count belum diatur!");
}


$waktu_mulai = strtotime($pengaturan['waktu_quickcount']);
$waktu_selesai = strtotime($pengaturan['waktu_selesai_quickcount']);

// Cek apakah waktu sekarang dalam rentang quick count
if ($sekarang < $waktu_mulai || $sekarang > $waktu_selesai) {
    die("Quick count hanya dapat diakses antara " . date('d M Y H:i', $waktu_mulai) . " hingga " . date('d M Y H:i', $waktu_selesai));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagram dengan Persentase</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="quickcount.css">
</head>
<!-- hanaa cantikkk, lucuu, sayangg -->
<body>
    <header>
        <div class="logo">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="#0066FF"
                    d="M13 8V4q0-.425.288-.712T14 3h6q.425 0 .713.288T21 4v4q0 .425-.288.713T20 9h-6q-.425 0-.712-.288T13 8M3 12V4q0-.425.288-.712T4 3h6q.425 0 .713.288T11 4v8q0 .425-.288.713T10 13H4q-.425 0-.712-.288T3 12m10 8v-8q0-.425.288-.712T14 11h6q.425 0 .713.288T21 12v8q0 .425-.288.713T20 21h-6q-.425 0-.712-.288T13 20M3 20v-4q0-.425.288-.712T4 15h6q.425 0 .713.288T11 16v4q0 .425-.288.713T10 21H4q-.425 0-.712-.288T3 20m2-9h4V5H5zm10 8h4v-6h-4zm0-12h4V5h-4zM5 19h4v-2H5zm4-2" />
            </svg>
            <a href="dashboardser.php">Dashboard</a>
        </div>
    </header>

    <section class="h1">
        <div>
            <h1 style="text-align: center;">
                HASIL REKAPITULASI PEMILIHAN <br> KETUA OSIS SMKN 1 DEPOK
            </h1>
        </div>
    </section>

    <section class="data">
        <div style="width: 50%; margin: auto;">
            <canvas id="myChart" style="display: inline;"></canvas>
        </div>
        <script>
            // Data diagram
            const labels = ['Kandidat A', 'Kandidat B', 'Kandidat C'];
            const data = [140, 125, 35]; // Jumlah suara

            // Total jumlah suara
            const total = data.reduce((sum, value) => sum + value, 0);

            // Hitung persentase setiap data
            const percentages = data.map(value => ((value / total) * 100).toFixed(1) + '%');

            // Buat grafik menggunakan Chart.js
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'pie', // Jenis grafik
                data: {
                    labels: labels.map((label, index) => `${label} (${percentages[index]})`), // Perbaikan template literal
                    datasets: [{
                        data: data,
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'], // Warna untuk setiap bagian
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top', // Posisi legenda
                        },
                        tooltip: {
                            callbacks: {
                                label: function (tooltipItem) {
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

    <section class="disclaimer">
        <div class="paragraf">
            <h1 style="text-align: center;"> Disclaimer </h1>
            <li><span>1) </span> Data Suara berdasarkan quikcount tidak menampilkan jumlah data secara tranparan atau
                terang-terangan.
                Baru berupa penghitungan oleh program menjadi dalam bentuk nilai persen.</li>
            <li> <span>2) </span> Pengguna di harapkan tidak menganggap data ini sebagai data yang bersifat real atau
                permanen. Karena jumlah
                persentase data ini dapat berubah sesuai dengan jumlah data yang masuk
            </li>
            <li> <span>3) </span> Pengguna harap bijak dalam menyebarkan informasi karena quickqount hanya menampikan
                data secara umum dan
                dalam bentuk persentase yang nilainya dapat berubah kapan saja. Tunggu hingga mendapat kan informasi
                resmi
                dari pengurus.
            </li>
        </div>
    </section>

    <footer>
        <p> &copy; 2025, SuaraKita. All rights reserved.</p>
    </footer>
</body>

</html>