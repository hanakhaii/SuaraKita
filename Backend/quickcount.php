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

// Cek status pemilih
$pemilih = $dbsuara->getPemilihById($_SESSION['nis']);
if ($pemilih['validasi_memilih'] === 'belum_memilih') {
    echo "<script>
        alert('Anda belum melakukan voting. Tidak bisa mengakses halaman ini.');
        window.location.href = 'dashboardser.php';
    </script>";
    exit();
}

// Ambil pengaturan quickcount
$pengaturan = $dbsuara->getPengaturanWaktu();
$sekarang = time();

if (!$pengaturan || !$pengaturan['waktu_quickcount'] || !$pengaturan['waktu_selesai_quickcount']) {
    die("Quick count belum diatur!");
}

$waktu_mulai = strtotime($pengaturan['waktu_quickcount']);
$waktu_selesai = strtotime($pengaturan['waktu_selesai_quickcount']);

if ($sekarang < $waktu_mulai || $sekarang > $waktu_selesai) {
    die("Quick count hanya dapat diakses antara " . date('d M Y H:i', $waktu_mulai) . " hingga " . date('d M Y H:i', $waktu_selesai));
}

// Ambil data kandidat
$kandidat = $dbsuara->getAllKandidat(); // pastikan ini ada di class Database
$labels = [];
$data = [];

foreach ($kandidat as $k) {
    $labels[] = $k['nama'];
    $data[] = (int)$k['jumlah_suara'];
}

$labels_json = json_encode($labels);
$data_json = json_encode($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Quick Count - SuaraKita</title>
    <link rel="apple-touch-icon" sizes="180x180" href="../Backend/img/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../Backend/img/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../Backend/img/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest"><link rel="icon" type="image/x-con" href="">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="quickcount.css">
</head>

<body>
    <header>
        <div class="logo">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="#0066FF"
                    d="M13 8V4q0-.425.288-.712T14 3h6q.425 0 .713.288T21 4v4q0 .425-.288.713T20 9h-6q-.425 0-.712-.288T13 8M3 12V4q0-.425.288-.712T4 3h6q.425 0 .713.288T11 4v8q0 .425-.288.713T10 13H4q-.425 0-.712-.288T3 12m10 8v-8q0-.425.288-.712T14 11h6q.425 0 .713.288T21 12v8q0 .425-.288.713T20 21h-6q-.425 0-.712-.288T13 20M3 20v-4q0-.425.288-.712T4 15h6q.425 0 .713.288T11 16v4q0 .425-.288.713T10 21H4q-.425 0-.712-.288T3 20m2-9h4V5H5zm10 8h4v-6h-4zm0-12h4V5h-4zM5 19h4v-2H5zm4-2" />
            </svg>
            <a href="../Backend/dashboardser.php">Dashboard</a>
        </div>
    </header>

    <section class="h1">
        <h1 style="text-align: center;">HASIL REKAPITULASI PEMILIHAN<br>KETUA OSIS SMKN 1 DEPOK</h1>
    </section>

    <section class="data">
        <div style="width: 30%; margin: auto;">
            <canvas id="myChart"></canvas>
        </div>

        <script>
            const labels = <?= $labels_json ?>;
            const data = <?= $data_json ?>;

            const total = data.reduce((sum, val) => sum + val, 0);
            const percentages = data.map(v => ((v / total) * 100).toFixed(1) + '%');

            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels.map((label, i) => `${label} (${percentages[i]})`),
                    datasets: [{
                        data: data,
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'], // tambahin sesuai jumlah kandidat
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function (tooltipItem) {
                                    const i = tooltipItem.dataIndex;
                                    return `${labels[i]}: ${data[i]} suara (${percentages[i]})`;
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
            <h1 style="text-align: center;">Disclaimer</h1>
            <li><span>1)</span> Data suara berdasarkan quick count hanya menampilkan persentase, bukan jumlah secara eksplisit.</li>
            <li><span>2)</span> Persentase dapat berubah seiring waktu, bukan data final.</li>
            <li><span>3)</span> Harap tidak menyebarluaskan informasi sebelum hasil resmi dari panitia diumumkan.</li>
        </div>
    </section>

    <footer>
        <p>&copy; 2025, SuaraKita. All rights reserved.</p>
    </footer>
</body>

</html>