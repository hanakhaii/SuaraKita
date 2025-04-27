<?php
require __DIR__ . '/../vendor/autoload.php';
include 'db.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

session_start();
$dbsuara = new Database();

function setAlert($type, $title, $message, $redirect = '')
{
    $_SESSION['alert'] = [
        'type' => $type,
        'title' => $title,
        'message' => $message,
        'redirect' => $redirect
    ];
}

if (isset($_POST['import'])) {
    if (!isset($_FILES['file_excel']) || $_FILES['file_excel']['error'] !== UPLOAD_ERR_OK) {
        setAlert('error', 'Error', 'File tidak valid atau terjadi kesalahan upload');
        header("Location: import_excel.php");
        exit();
    }

    $file = $_FILES['file_excel']['tmp_name'];
    $fileName = $_FILES['file_excel']['name'];
    $allowedExtensions = ['xls', 'xlsx'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $allowedExtensions)) {
        setAlert('error', 'Error', 'Hanya file Excel (.xls, .xlsx) yang diperbolehkan!');
        header("Location: import_excel.php");
        exit();
    }

    try {
        $spreadsheet = IOFactory::load($file);
        $importedCount = 0;

        foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
            $rows = $worksheet->toArray();
            $headerRowIndex = null;
            foreach ($rows as $index => $row) {
                if (isset($row[1]) && trim($row[1]) === 'NIS' && isset($row[4]) && trim($row[4]) === 'NAMA') {
                    $headerRowIndex = $index;
                    break;
                }
            }

            if ($headerRowIndex === null) continue;

            $dataRows = array_slice($rows, $headerRowIndex + 1);
            foreach ($dataRows as $row) {
                $nis = $row[1] ?? '';
                $nama = $row[4] ?? '';

                if (empty($nis) || $nis === '-' || empty($nama)) continue;

                $username = $nis;
                $password = '123456';
                $role = 'user';
                $validasi = 'belum_memilih';

                if (!$dbsuara->getPemilihById($nis)) {
                    if ($dbsuara->inputPemilih($nis, $password, $username, $nama, $role, $validasi)) {
                        $importedCount++;
                    }
                }
            }
        }

        if ($importedCount > 0) {
            setAlert('success', 'Sukses', "Berhasil mengimport $importedCount data pemilih!", 'data_pemilih.php');
            exit();
        } else {
            setAlert('info', 'Info', 'Tidak ada data baru yang diimport.', 'import_excel.php');
            exit();
        }
    } catch (Exception $e) {
        setAlert('error', 'Error', 'Terjadi kesalahan: ' . $e->getMessage());
        header("Location: import_excel.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Import Data Pemilih</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin: 20px auto;
            padding: 20px;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        header {
            margin-left: 20px;
        }

        a {
            text-decoration: none;
            color: #0066FF;
            margin-top: -5px;
            margin-left: 5px;
            font-weight: bold;
        }

        a:hover {
            color: #181B3C;
            text-decoration: underline;
        }

        main {
            margin-top: 5%;
        }

        table {
            width: 500px;
            border: 1px black;
        }

        tr th {
            color: white;
            background-color: rgb(93, 147, 227);
        }

        button {
            color: white;
            padding: 5px;
            background-color: #0066FF;
            border-radius: 5px;
            border: transparent;
            cursor: pointer;
            transition: 0.3s ease-in-out;
        }

        button:hover {
            cursor: pointer;
            transition: 0.3s ease-in-out;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <div>
                <!-- SVG Logo -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="#0066FF"
                        d="M13 8V4q0-.425.288-.712T14 3h6q.425 0 .713.288T21 4v4q0 .425-.288.713T20 9h-6q-.425 0-.712-.288T13 8M3 12V4q0-.425.288-.712T4 3h6q.425 0 .713.288T11 4v8q0 .425-.288.713T10 13H4q-.425 0-.712-.288T3 12m10 8v-8q0-.425.288-.712T14 11h6q.425 0 .713.288T21 12v8q0 .425-.288.713T20 21h-6q-.425 0-.712-.288T13 20M3 20v-4q0-.425.288-.712T4 15h6q.425 0 .713.288T11 16v4q0 .425-.288.713T10 21H4q-.425 0-.712-.288T3 20m2-9h4V5H5zm10 8h4v-6h-4zm0-12h4V5h-4zM5 19h4v-2H5zm4-2" />
                </svg>
            </div>
            <a href="../Backend/data_pemilih.php">Dashboard</a>
        </div>
    </header>
    <main align="center">
        <h2>IMPORT DATA PEMILIH DARI EXCEL</h2>
        <section class="">
            <!-- Contoh Format Excel -->
            <div style="margin-top: 20px; text-align: center;">
                <h3>Contoh Format Excel:</h3>
                <table border="1" cellpadding="5" align="center">
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

            <form method="POST" enctype="multipart/form-data" action="import_excel.php">
                <input type="file" name="file_excel" accept=".xls,.xlsx" required>
                <button type="submit" name="import" class="btn-import">IMPORT</button>
            </form>

            <script>
                // untuk alert berhasil/gagal import excel
                $(document).ready(function() {
                    <?php if (isset($_SESSION['alert'])): ?>
                        Swal.fire({
                            icon: '<?php echo $_SESSION['alert']['type']; ?>',
                            title: '<?php echo $_SESSION['alert']['title']; ?>',
                            text: '<?php echo addslashes($_SESSION['alert']['message']); ?>',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                <?php if (!empty($_SESSION['alert']['redirect'])): ?>
                                    window.location.href = '<?php echo $_SESSION['alert']['redirect']; ?>';
                                <?php endif; ?>
                            }
                        });
                        <?php unset($_SESSION['alert']); ?>
                    <?php endif; ?>
                });

                // Konfirmasi sebelum submit
                $('#importForm').on('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Konfirmasi Import',
                        text: 'Apakah Anda yakin ingin mengimpor data pemilih dari file Excel ini?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#0066FF',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Import!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                });
            </script>
</body>

</html>