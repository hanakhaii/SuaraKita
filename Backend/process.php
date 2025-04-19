<?php
include 'db.php';
$dbsuara = new Database();

error_reporting(E_ALL);
ini_set('display_errors', 1);


// tambah kandidat
$action = $_GET['action'];
if ($action == "add_kandidat") {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);

    // Pindahkan file ke folder uploads
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        $dbsuara->inputKandidat($_FILES['foto']['name'], $_POST['nis'], $_POST['nama'], $_POST['visi'], $_POST['misi']);
        header("location:data_kandidat.php");
    } else {
        die("Gagal upload file!"); // Tampilkan pesan error upload
    }
}

// tambah pemilih 
elseif ($action == "add_pemilih") {
    // Proses untuk input data pemilih
    $dbsuara->inputPemilih($_POST['nis'], $_POST['password'], $_POST['username'], $_POST['nama'], $_POST['role'], $_POST['validasi_memilih']);
    header("location:data_pemilih.php");
}

if ($action == "edit_kandidat") {
    // Ambil data file foto
    $foto = $_POST['foto_lama']; // Default: gunakan foto lama

    // Jika ada file foto baru diupload
    if (!empty($_FILES['foto']['name'])) {
        $file_name = $_FILES['foto']['name'];
        $tmp_file = $_FILES['foto']['tmp_name'];
        $folder = "uploads/";

        // Pastikan folder uploads ada
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        // Pindahkan file baru ke folder uploads
        if (move_uploaded_file($tmp_file, $folder . $file_name)) {
            $foto = $file_name; // Gunakan nama file baru
        } else {
            echo "Upload foto baru gagal!";
            exit;
        }
    }

    // Panggil method editKandidat dengan foto yang sesuai
    if ($dbsuara->editKandidat($_POST['no_urut'], $_POST['nis'], $_POST['nama'], $_POST['visi'], $_POST['misi'], $foto)) {
        header("location:data_kandidat.php");
    } else {
        echo "Edit kandidat gagal!";
    }
} elseif ($action == "edit_pemilih") {
    // Ambil data dari form
    $nis = $_POST['nis'];
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $validasi_memilih = $_POST['validasi_memilih'];

    // Panggil method editPemilih
    if ($dbsuara->editPemilih($nis, $username, $nama, $password, $role, $validasi_memilih)) {
        header("location:data_pemilih.php");
    } else {
        echo "Edit pemilih gagal!";
    }
} elseif ($action == "delete_pemilih") {
    // Ambil nis dari URL
    $nis = $_GET['nis'];

    // Panggil method deletePemilih
    if ($dbsuara->deletePemilih($nis)) {
        header("location:data_pemilih.php");
    } else {
        echo "Hapus pemilih gagal!";
    }
} // Di bagian delete_kandidat
if ($action == "delete_kandidat") {
    // Pastikan no_urut ada
    if (!isset($_GET['no_urut'])) {
        die("Parameter no_urut tidak ditemukan!");
    }

    $no_urut = (int)$_GET['no_urut']; // Konversi ke integer

    if ($dbsuara->deleteKandidat($no_urut)) {
        header("location:data_kandidat.php");
        exit();
    } else {
        die("Gagal menghapus kandidat!");
    }
}


// Login Admin
if ($action == "login") {
    $result = $dbsuara->loginAdmin($_POST['username'], $_POST['password']);

    if ($result) {
        $_SESSION['admin'] = $result['username'];
        $_SESSION['role'] = 'admin';
        header("Location: dashboardmin.php"); // Redirect ke dashboard admin
        exit();
    } else {
        echo "<script>alert('Username atau password salah!'); window.location.href='login.php';</script>";
    }
}

// Login User
if ($action == "loginUser") {
    $result = $dbsuara->loginUser($_POST['nis'], $_POST['password']);

    if ($result) {
        $_SESSION['nis'] = $result['nis'];
        $_SESSION['nama'] = $result['nama'];
        $_SESSION['role'] = $result['role'] ?? 'user'; // Role default 'user'
        header("Location: dashboardser.php"); // Arahkan ke dashboardser.php
        exit();
    } else {
        echo "<script>alert('NIS atau password salah!'); window.location.href='login-user.php';</script>";
    }
}


// pengaturan waktu
if ($action == "simpan_pengaturan") {
    // Tampilkan debugging (opsional, bisa dihapus jika sudah tidak diperlukan)
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    // Ambil data dari form
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $waktu_mulai_input = $_POST['waktu_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];
    $waktu_selesai_input = $_POST['waktu_selesai'];
    $tanggal_quickcount = $_POST['tanggal_quickcount'];
    $waktu_quickcount_input = $_POST['waktu_quickcount'];
    $tanggal_selesai_quickcount = $_POST['tanggal_selesai_quickcount'];
    $waktu_selesai_quickcount_input = $_POST['waktu_selesai_quickcount'];

    // Gabungkan tanggal dan waktu untuk pemilihan
    $waktu_mulai_memilih = "$tanggal_mulai $waktu_mulai_input:00";
    $waktu_selesai_memilih = "$tanggal_selesai $waktu_selesai_input:00";

    // Gabungkan tanggal dan waktu untuk quick count
    $waktu_quickcount = "$tanggal_quickcount $waktu_quickcount_input:00";
    $waktu_selesai_quickcount = "$tanggal_selesai_quickcount $waktu_selesai_quickcount_input:00";

    // Simpan ke database dengan semua parameter
    if ($dbsuara->simpanPengaturanWaktu($waktu_mulai_memilih, $waktu_selesai_memilih, $waktu_quickcount, $waktu_selesai_quickcount)) {
        header("Location: pengaturan.php?status=sukses");
        exit();
    } else {
        die("Gagal menyimpan pengaturan waktu!");
    }
}

if ($action === 'vote') {
    session_start();
    if (!isset($_SESSION['nis'])) {
        header("Location: login-user.php");
        exit();
    }
    $nis = $_SESSION['nis'];

    // 1. Cek status pemilih
    $pemilih = $dbsuara->getPemilihById($nis);
    if ($pemilih['validasi_memilih'] === 'sudah_memilih') {
        die("Anda sudah melakukan voting.");
    }

    // 2. Ambil kandidat terpilih
    if (empty($_POST['kandidat'])) {
        die("Anda belum memilih kandidat.");
    }
    $noUrut = (int) $_POST['kandidat'];

    // 3. Validasi kandidat
    $k = $dbsuara->getKandidatById($noUrut);
    if (!$k) {
        die("Kandidat tidak valid.");
    }

    // 4. Simpan voting
    $conn = $dbsuara->getConnection();
    $conn->begin_transaction();
    try {
        // a) INSERT ke tabel suara, kolom nya nis_pemilih
        $stmt1 = $conn->prepare(
            "INSERT INTO suara (no_urut_kandidat, nis_pemilih) VALUES (?, ?)"
        );
        $stmt1->bind_param("is", $noUrut, $nis);
        $stmt1->execute();

        // b) UPDATE jumlah_suara di kandidat
        $stmt2 = $conn->prepare(
            "UPDATE kandidat SET jumlah_suara = jumlah_suara + 1 WHERE no_urut = ?"
        );
        $stmt2->bind_param("i", $noUrut);
        $stmt2->execute();

        // c) UPDATE status pemilih
        $stmt3 = $conn->prepare(
            "UPDATE pengguna SET validasi_memilih = 'sudah_memilih' WHERE nis = ?"
        );
        $stmt3->bind_param("s", $nis);
        $stmt3->execute();

        $conn->commit();

        echo "<script>
            alert('Terima kasih, suara Anda berhasil disimpan!');
            window.location.href = 'dashboardser.php';
        </script>";
        exit;
    } catch (Exception $e) {
        $conn->rollback();
        die("Gagal memproses voting: " . $e->getMessage());
    }
}
 
