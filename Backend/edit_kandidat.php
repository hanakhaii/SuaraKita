<?php 
include 'db.php';
$dbsuara = new Database(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet" />
    <title>Edit Data Kandidat</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin: 20px auto;
            padding: 20px;
        }
        
        .logo{
            display: flex;
            align-items: center;
        }

        h2 {
            font-weight: bold;
            font-size: 40px;
            text-align: center;
        }

        h3{
            margin-top: -20px;
            font-weight: bold;
            font-size: 27px;
            text-align: center;
        }

        span{
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
            box-shadow:0px 0px 7px 0px black;
            margin: 0 auto; /* Ini akan membuatnya berada di tengah */
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
            margin-left: 461px;
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
        <h2>Edit Data Kandidat</h2>
        <h3><Span>Suara</Span>Kita</h3>
    
        <form action="process.php?action=edit_kandidat" method="post" enctype="multipart/form-data">

        <?php
        $editKandidat = $dbsuara->getKandidatById($_GET['no_urut']);
        ?>

            <!-- hidden input no_urut kandidat -->
            <input type="hidden" name="no_urut" value="<?php echo $editKandidat['no_urut']; ?>">

            <!-- hidden input untuk foto lama -->
            <input type="hidden" name="foto_lama" value="<?php echo $editKandidat['foto']; ?>">

            <!-- edit foto kandidat -->
            <div class="form-group">
                <label for="foto">Foto:</label>
                <input type="file" name="foto">
                <img src="uploads/<?php echo $editKandidat['foto']; ?>" width="100" height="100">
            </div>

            <!-- edit nis kandidat -->
            <div class="form-group">
                <label for="nis">NIS:</label>
                <input type="number" name="nis" value="<?php echo $editKandidat['nis']; ?>">
            </div>

            <!-- edit nama kandidat -->
            <div class="form-group">
                <label for="nama">Nama Kandidat:</label>
                <input type="text" id="nama" name="nama" value="<?php echo $editKandidat['nama']; ?>" required>
            </div>

            <!-- edit visi kandidat -->
            <div class="form-group">
                <label for="visi">Visi:</label>
                <textarea id="visi" name="visi" required><?php echo $editKandidat['visi']; ?></textarea>
            </div>

            <!-- edit misi kandidat -->
            <div class="form-group">
                <label for="misi">Misi:</label>
                <textarea id="misi" name="misi" required><?php echo $editKandidat['misi']; ?></textarea>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" name="submit">Edit Kandidat</button>
            </div>
        </form>
    </main>
</body>
</html>