<?php
include 'db.php'; // pastikan path-nya benar

if (isset($_GET['nama'])) {
    $nama = $_GET['nama'];
    $stmt = $dbsuara->getConnection()->prepare("SELECT * FROM kandidat WHERE nama = ?");
    $stmt->bind_param("s", $nama);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (!$data) {
        echo "Data kandidat tidak ditemukan.";
        exit();
    }
} else {
    echo "Nama kandidat tidak diberikan.";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="apple-touch-icon" sizes="180x180" href="../Backend/img/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../Backend/img/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../Backend/img/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest"><link rel="icon" type="image/x-con" href="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tampilan_kandidat.css">
    <title><?php echo htmlspecialchars($data['nama']); ?></title>
</head>

<body>
    <header>
        <div class="konten">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="#0066FF"
                    d="M13 8V4q0-.425.288-.712T14 3h6q.425 0 .713.288T21 4v4q0 .425-.288.713T20 9h-6q-.425 0-.712-.288T13 8M3 12V4q0-.425.288-.712T4 3h6q.425 0 .713.288T11 4v8q0 .425-.288.713T10 13H4q-.425 0-.712-.288T3 12m10 8v-8q0-.425.288-.712T14 11h6q.425 0 .713.288T21 12v8q0 .425-.288.713T20 21h-6q-.425 0-.712-.288T13 20M3 20v-4q0-.425.288-.712T4 15h6q.425 0 .713.288T11 16v4q0 .425-.288.713T10 21H4q-.425 0-.712-.288T3 20m2-9h4V5H5zm10 8h4v-6h-4zm0-12h4V5h-4zM5 19h4v-2H5zm4-2" />
            </svg>
            <a href="dashboardser.php">Dashboard</a>
        </div>
    </header>

    <section class="sec1">
        <div class="gambal">
            <center>
                <img src="<?php echo $data['foto']; ?>" alt="Foto Kandidat">
                <div class="nama">
                    <h1><?php echo htmlspecialchars($data['nama']); ?></h1>
                    <p style="width: 900px;"><?php echo htmlspecialchars($data['deskripsi']); ?></p>
                </div>
            </center>
        </div>
    </section>

    <section class="sec2">
        <div class="visi">
            <h1>Visi</h1>
            <ul>
                <?php
                $visi_lines = explode("\n", $data['visi']);
                foreach ($visi_lines as $i => $line) {
                    echo "<li>" . ($i + 1) . ". " . htmlspecialchars($line) . "</li>";
                }
                ?>
            </ul>
        </div>
    </section>

    <section class="sec3">
        <div class="misi">
            <h1>Misi</h1>
            <ul>
                <?php
                $misi_lines = explode("\n", $data['misi']);
                foreach ($misi_lines as $i => $line) {
                    echo "<li>" . ($i + 1) . ". " . htmlspecialchars($line) . "</li>";
                }
                ?>
            </ul>
        </div>
    </section>

    <section class="sec4">
        <center>
            <img src="<?php echo $data['poster']; ?>" alt="Poster Kandidat">
        </center>
    </section>

    <footer>
        <p>&copy; 2025, SuaraKita. All rights reserved.</p>
    </footer>
</body>

</html>
