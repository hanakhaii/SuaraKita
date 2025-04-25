<?php
require __DIR__ . '/../vendor/autoload.php';
include 'db.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$dbsuara = new Database();

if (isset($_POST['import'])) {
    $file = $_FILES['file_excel']['tmp_name'];
    $fileName = $_FILES['file_excel']['name'];

    // Validasi ekstensi file
    $allowedExtensions = ['xls', 'xlsx'];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    if (!in_array($fileExtension, $allowedExtensions)) {
        die("<script>alert('Hanya file Excel (.xls, .xlsx) yang diperbolehkan!'); window.history.back();</script>");
    }

    try {
        $spreadsheet = IOFactory::load($file);
        
        // Loop melalui semua sheet
        foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
            $sheetName = $worksheet->getTitle();
            
            // Skip sheet yang tidak relevan (sesuaikan jika perlu)
            if (strpos($sheetName, '11') === false) continue;

            $rows = $worksheet->toArray();

            // Cari baris header (No | NIS | NISN | L/P | NAMA | TTD)
            $headerRowIndex = null;
            foreach ($rows as $index => $row) {
                if (isset($row[1]) && trim($row[1]) === 'NIS' && isset($row[4]) && trim($row[4]) === 'NAMA') {
                    $headerRowIndex = $index;
                    break;
                }
            }

            if ($headerRowIndex === null) {
                continue; // Skip sheet jika header tidak ditemukan
            }

            // Ambil data mulai dari baris setelah header
            $dataRows = array_slice($rows, $headerRowIndex + 1);

            foreach ($dataRows as $row) {
                // Pastikan struktur kolom: NIS di kolom B (indeks 1), Nama di kolom E (indeks 4)
                $nis = $row[1] ?? '';
                $nama = $row[4] ?? '';

                // Skip baris kosong atau NIS tidak valid
                if (empty($nis) || $nis === '-' || empty($nama)) continue;

                // Generate username dan password
                $username = $nis;
                $password = password_hash($nis, PASSWORD_DEFAULT);
                $role = 'user';
                $validasi = 'belum_memilih';

                // Cek duplikat NIS
                if (!$dbsuara->getPemilihById($nis)) {
                    $dbsuara->inputPemilih($nis, $password, $username, $nama, $role, $validasi);
                }
            }
        }

        echo "<script>
            alert('Data berhasil diimport!');
            window.location.href = 'data_pemilih.php';
        </script>";
    } catch (Exception $e) {
        die("<script>alert('Error: " . addslashes($e->getMessage()) . "'); window.history.back();</script>");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Import Data Pemilih</title>
    <link rel="stylesheet" href="dashboardmin.css">
</head>
<body>
    <div class="container">
        <main class="table_view" align="center">
            <section class="table_header">
                <h1>IMPORT DATA PEMILIH DARI EXCEL</h1>
            </section>
            <section class="table_body_pemilih">
                <form method="POST" enctype="multipart/form-data" action="import_excel.php">
                    <input type="file" name="file_excel" accept=".xls,.xlsx" required>
                    <button type="submit" name="import" class="btn-import">IMPORT</button>
                    <a href="data_pemilih.php" class="btn-back">KEMBALI</a>
                </form>
                
                <!-- Contoh Format Excel -->
                <div style="margin-top: 20px; text-align: left;">
                    <h3>Contoh Format Excel:</h3>
                    <table border="1" cellpadding="5">
                        <tr>
                            <th>NIS</th>
                            <th>Nama</th>
                        </tr>
                        <tr>
                            <td>222310004</td>
                            <td>AGUS RAMDANI</td>
                        </tr>
                    </table>
                    <p>Unduh template: <a href="template_pemilih.xlsx" download>Download</a></p>
                </div>
            </section>
        </main>
    </div>
</body>
</html>