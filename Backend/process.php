<?php
include 'db.php';
$dbsuara = new Database();

$action = $_GET['action'];
if ($action == "add_kandidat") {
    // Proses untuk input data kandidat
    $dbsuara->inputKandidat($_FILES['foto']['name'], $_POST['nis'], $_POST['nama'], $_POST['visi'], $_POST['misi']);
    header("location:data_kandidat.php");
} elseif ($action == "add_pemilih") {
    // Proses untuk input data pemilih
    $dbsuara->inputPemilih($_POST['nis'], $_POST['password'], $_POST['username'], $_POST['nama'], $_POST['role'], $_POST['validasi_memilih']);
    header("location:data_pemilih.php");
}


if (isset($_FILES['foto'])) {
    $file_name = $_FILES['foto']['name'];
    $tmp_file = $_FILES['foto']['tmp_name'];
    $folder   = "uploads/";

    if (move_uploaded_file($tmp_file, $folder . $file_name)) {
        // Simpan $file_name ke database, misalnya:
        $query = "INSERT INTO foto_table (judul, nama_file) VALUES (:judul, :nama_file)";
        // Eksekusi query dengan prepared statement, dll.
    } else {
        echo "Upload gagal!";
    }
    // perubahan process.php
} else if ($action == "edit_kandidat") {
    // Ambil data file foto
    $foto = $_POST['foto_lama']; // Default: gunakan foto lama

    // Jika ada file foto baru diupload
    if (!empty($_FILES['foto']['name'])) {
        $file_name = $_FILES['foto']['name'];
        $tmp_file = $_FILES['foto']['tmp_name'];
        $folder   = "uploads/";

        if (move_uploaded_file($tmp_file, $folder . $file_name)) {
            $foto = $file_name; // Gunakan foto baru
        } else {
            echo "Upload foto baru gagal!";
            exit;
        }
    }

    // Panggil method editKandidat
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
} else if ($action == "delete_pemilih") {
    // Ambil nis dari URL
    $nis = $_GET['nis'];

    // Panggil method deletePemilih
    if ($dbsuara->deletePemilih($nis)) {
        header("location:data_pemilih.php"); // Redirect ke halaman data_pemilih.php setelah berhasil menghapus
    } else {
        echo "Hapus pemilih gagal!";
    }
} else if ($action == "delete_kandidat") {
    // Panggil method deleteKandidat
    if ($dbsuara->deleteKandidat($_GET['no_urut'])) {
        header("location:data_kandidat.php");
    } else {
        echo "Hapus kandidat gagal!";
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

