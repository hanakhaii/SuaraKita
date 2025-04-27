<?php
include 'db.php';
$dbsuara = new Database();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="../Backend/img/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../Backend/img/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../Backend/img/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="icon" type="image/x-con" href="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet" />
    <title>Upload Kandidat</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin: 20px auto;
            padding: 20px;
        }

        ::-webkit-scrollbar {
            width: 5px;
            height: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background: #bbc4c4;
        }

        ::-webkit-scrollbar-track:hover {
            background: transparent;
            border-radius: 6px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #000dff;
            border-radius: 6px;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        h2 {
            font-weight: bold;
            font-size: 40px;
            text-align: center;
        }

        h3 {
            margin-top: -20px;
            font-weight: bold;
            font-size: 27px;
            text-align: center;
        }

        span {
            color: #FC0134;
            text-align: center;
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

        .form-container {
            border-color: #ffffff;
            max-width: 600px;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 25px;
            box-shadow: 0px 0px 7px 0px black;
            margin: 0 auto;
            /* Ini akan membuatnya berada di tengah */
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        button {
            background-color: #0066FF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: 0.3s ease-in-out;
            margin-left: 458px;
        }

        button:hover {
            background-color: #181B3C;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="#0066FF"
                        d="M13 8V4q0-.425.288-.712T14 3h6q.425 0 .713.288T21 4v4q0 .425-.288.713T20 9h-6q-.425 0-.712-.288T13 8M3 12V4q0-.425.288-.712T4 3h6q.425 0 .713.288T11 4v8q0 .425-.288.713T10 13H4q-.425 0-.712-.288T3 12m10 8v-8q0-.425.288-.712T14 11h6q.425 0 .713.288T21 12v8q0 .425-.288.713T20 21h-6q-.425 0-.712-.288T13 20M3 20v-4q0-.425.288-.712T4 15h6q.425 0 .713.288T11 16v4q0 .425-.288.713T10 21H4q-.425 0-.712-.288T3 20m2-9h4V5H5zm10 8h4v-6h-4zm0-12h4V5h-4zM5 19h4v-2H5zm4-2" />
                </svg>
            </div>
            <a href="../Backend/data_kandidat.php">Dashboard</a>
        </div>
    </header>

    <!-- Judul -->

    <main class="form-container">
        <h2>Tambah Kandidat</h2>
        <h3><Span>Suara</Span>Kita</h3>
        <form action="process.php" method="POST" enctype="multipart/form-data">
            <!-- hidden input -->
            <input type="hidden" name="no_urut">

            <label>Foto Kandidat:</label>
            <input type="file" name="foto" required><br>

            <label>Poster Kandidat:</label>
            <input type="file" name="poster" required><br>

            <label>NIS:</label>
            <input type="text" name="nis" required><br>

            <label>Nama:</label>
            <input type="text" name="nama" required><br>

            <label>Visi:</label>
            <textarea name="visi" required></textarea><br>

            <label>Misi:</label>
            <textarea name="misi" required></textarea><br>

            <label>Deskripsi:</label>
            <textarea name="deskripsi" required></textarea><br>

            <button type="submit" name="submit_kandidat">Simpan Kandidat</button>
        </form>
    </main>

    <?php if (isset($_GET['status'])): ?>
        <?php if (isset($_GET['status']) && $_GET['status'] == 'sukses'): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data kandidat berhasil ditambahkan.',
                        confirmButtonColor: '#0066FF'
                    });
                });
            </script>
        <?php endif; ?>

        <?php if (isset($_GET['status']) && $_GET['status'] == 'gagal'): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat menambahkan data.',
                        confirmButtonColor: '#FC0134'
                    });
                });
            </script>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>