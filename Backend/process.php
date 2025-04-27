<?php
include 'db.php';
$dbsuara = new Database();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// ✅ Tambahkan ini di awal
$action = $_GET['action'] ?? $_POST['action'] ?? null;

// submit kandidat
if (isset($_POST['submit_kandidat'])) {
    $foto = $_FILES['foto'];
    $poster = $_FILES['poster'];
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $visi = $_POST['visi'];
    $misi = $_POST['misi'];
    $deskripsi = $_POST['deskripsi'];

    // Upload foto
    $foto_name = uniqid() . '_' . $foto['name'];
    $foto_path = 'uploads/' . $foto_name;
    move_uploaded_file($foto['tmp_name'], $foto_path);

    // Upload poster
    $poster_name = uniqid() . '_' . $poster['name'];
    $poster_path = 'uploads/' . $poster_name;
    move_uploaded_file($poster['tmp_name'], $poster_path);

    $db = new Database();
    $db->inputKandidat($foto_path, $poster_path, $nis, $nama, $visi, $misi, $deskripsi);

    header("Location: data_kandidat.php");
    exit();
}

// tambah pemilih 
elseif ($action == "add_pemilih") {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];

    // Default values (password plain text)
    $username = $nis;
    $password = '123456'; // Tidak di-hash
    $role = 'user';
    $validasi_memilih = 'belum_memilih';

    $berhasil = $dbsuara->inputPemilih($nis, $password, $username, $nama, $role, $validasi_memilih);

    if ($berhasil) {
        header("location:data_pemilih.php?status=sukses");
    } else {
        header("location:upload_pemilih.php?status=gagal");
    }
    exit();
}

if ($action == "edit_kandidat") {
    $foto = $_POST['foto_lama'];
    $poster = $_POST['poster_lama'];

    // Upload foto baru jika ada
    if (!empty($_FILES['foto']['name'])) {
        $file_name = $_FILES['foto']['name'];
        $tmp_file = $_FILES['foto']['tmp_name'];
        $folder = "uploads/";

        if (!is_dir($folder)) mkdir($folder, 0777, true);

        if (move_uploaded_file($tmp_file, $folder . $file_name)) {
            $foto = $folder . $file_name;
        } else {
            echo "Upload foto baru gagal!";
            exit;
        }
    }

    // Upload poster baru jika ada
    if (!empty($_FILES['poster']['name'])) {
        $poster_name = $_FILES['poster']['name'];
        $tmp_poster = $_FILES['poster']['tmp_name'];
        $folder = "uploads/";

        if (!is_dir($folder)) mkdir($folder, 0777, true);

        if (move_uploaded_file($tmp_poster, $folder . $poster_name)) {
            $poster = $folder . $poster_name;
        } else {
            echo "Upload poster baru gagal!";
            exit;
        }
    }

    // Ambil data lainnya
    $no_urut = $_POST['no_urut'];
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $visi = $_POST['visi'];
    $misi = $_POST['misi'];
    $deskripsi = $_POST['deskripsi'];

    // Ambil koneksi
    $koneksi = $dbsuara->getConnection();

    // Update ke database
    $query = "UPDATE kandidat SET 
                nis = '$nis',
                nama = '$nama',
                visi = '$visi',
                misi = '$misi',
                foto = '$foto',
                deskripsi = '$deskripsi',
                poster = '$poster'
                WHERE no_urut = '$no_urut'";

    if ($koneksi->query($query)) {
        header("Location: data_kandidat.php");
        exit;
    } else {
        echo "Gagal mengupdate kandidat: " . $koneksi->error;
    }
}


elseif ($action == "edit_pemilih") {
    $nis_lama = $_POST['nis_lama'];
    $nis_baru = $_POST['nis_baru'];
    $nama = $_POST['nama'];

    if ($dbsuara->editPemilih($nis_lama, $nis_baru, $nama)) {
        header("location:data_pemilih.php?status=success&message=Data berhasil diupdate");
        exit();
    } else {
        header("location:data_pemilih.php?status=error&message=Gagal mengupdate data");
        exit();
    }
} elseif ($action == "delete_pemilih") {
    $nis = $_GET['nis'];
    if ($dbsuara->deletePemilih($nis)) {
        header("location:data_pemilih.php?status=success&message=Data pemilih berhasil dihapus");
        exit();
    } else {
        header("location:data_pemilih.php?status=error&message=Gagal menghapus pemilih");
        exit();
    }
} elseif ($action == "delete_kandidat") {
    if (!isset($_GET['no_urut'])) {
        die("Parameter no_urut tidak ditemukan!");
    }
    $no_urut = (int)$_GET['no_urut'];
    if ($dbsuara->deleteKandidat($no_urut)) {
        header("location:data_kandidat.php");
        exit();
    } else {
        die("Gagal menghapus kandidat!");
    }
}   elseif ($action == "delete_all_pemilih") {
    if ($dbsuara->deleteAllPemilih()) {
        header("Location: data_pemilih.php?status=success&message=Semua data pemilih berhasil dihapus");
        exit();
    } else {
        header("Location: data_pemilih.php?status=error&message=Gagal menghapus semua pemilih");
        exit();
    }
}
elseif ($action == "add_admin") {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];

    // Default values
    $password = 'admin1234'; // Password tidak di-hash
    $role = 'admin';
    $validasi_memilih = 'belum_memilih';

    $berhasil = $dbsuara->inputPemilih($nis, $password, $username, $nama, $role, $validasi_memilih);

    if ($berhasil) {
        header("location:data_admin.php?status=sukses");
    } else {
        header("location:upload_admin.php?status=gagal");
    }
    exit();
} elseif ($action === "edit_admin") {
    $nis_lama = $_POST['nis_lama'];
    $nis_baru = $_POST['nis'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];

    if ($dbsuara->editAdmin($nis_lama, $nis_baru, $nama, $username)) {
        header("Location: data_admin.php?status=success&message=Data admin berhasil diupdate");
    } else {
        header("Location: data_admin.php?status=error&message=Gagal mengupdate data admin");
    }
    exit();
}

// Hapus admin
elseif ($action === "delete_admin") {
    $nis = $_GET['nis'];
    if ($dbsuara->deleteAdmin($nis)) {
        header("Location: data_admin.php?status=success&message=Admin berhasil dihapus");
    } else {
        header("Location: data_admin.php?status=error&message=Gagal menghapus admin");
    }
    exit();
}

// Hapus semua admin
elseif ($action === "delete_all_admin") {
    if ($dbsuara->deleteAllAdmin()) {
        header("Location: data_admin.php?status=success");
    } else {
        header("Location: data_admin.php?status=error&message=Gagal menghapus semua admin");
    }
    exit();
}

elseif ($action === "delete_all_kandidat") {
    // panggil method yang baru saja kita buat
    if ($dbsuara->deleteAllKandidat()) {
        header("Location: data_kandidat.php");
        exit();
    } else {
        die("Gagal menghapus semua kandidat!");
    }
}
elseif ($action == "login") {
    $result = $dbsuara->loginAdmin($_POST['username'], $_POST['password']);
    if ($result) {
        session_start();
        $_SESSION['admin'] = $result['username'];
        $_SESSION['role'] = 'admin';
        header("Location: dashboardmin.php");
        exit();
    } else {
        echo "<script>alert('Username atau password salah!'); window.location.href='login.php';</script>";
    }
} elseif ($action == "loginUser") {
    $result = $dbsuara->loginUser($_POST['nis'], $_POST['password']);
    if ($result) {
        session_start();
        $_SESSION['nis'] = $result['nis'];
        $_SESSION['nama'] = $result['nama'];
        $_SESSION['role'] = $result['role'] ?? 'user';
        header("Location: dashboardser.php");
        exit();
    } else {
        echo "<script>alert('NIS atau password salah!'); window.location.href='login-user.php';</script>";
    }
} elseif ($action == "simpan_pengaturan") {
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $waktu_mulai_input = $_POST['waktu_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];
    $waktu_selesai_input = $_POST['waktu_selesai'];
    $tanggal_quickcount = $_POST['tanggal_quickcount'];
    $waktu_quickcount_input = $_POST['waktu_quickcount'];
    $tanggal_selesai_quickcount = $_POST['tanggal_selesai_quickcount'];
    $waktu_selesai_quickcount_input = $_POST['waktu_selesai_quickcount'];

    $waktu_mulai_memilih = "$tanggal_mulai $waktu_mulai_input:00";
    $waktu_selesai_memilih = "$tanggal_selesai $waktu_selesai_input:00";
    
    // Gabungkan tanggal dan waktu untuk quick count
    $waktu_quickcount = "$tanggal_quickcount $waktu_quickcount_input:00";
    $waktu_selesai_quickcount = "$tanggal_selesai_quickcount $waktu_selesai_quickcount_input:00";

    if ($dbsuara->simpanPengaturanWaktu($waktu_mulai_memilih, $waktu_selesai_memilih, $waktu_quickcount, $waktu_selesai_quickcount)) {
        header("Location: pengaturan.php?status=sukses");
        exit();
    } else {
        die("Gagal menyimpan pengaturan waktu!");
    }
}

// voting ae voting
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