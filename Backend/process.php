<?php
include 'db.php';
$dbsuara = new Database();

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == "add") {
    // Pastikan folder uploads ada
    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true); // Buat direktori jika tidak ada
    }

    $target_dir = "uploads/";
    $file_name = time() . '_' . basename($_FILES["foto"]["name"]); // Nama file unik
    $target_file = $target_dir . $file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek apakah file adalah gambar
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if ($check === false) {
        echo "File bukan gambar.";
        exit();
    }

    // Cek ukuran file (maksimal 5MB)
    $max_file_size = 5 * 1024 * 1024; // 5MB
    if ($_FILES["foto"]["size"] > $max_file_size) {
        echo "Ukuran file terlalu besar. Maksimal 5MB.";
        exit();
    }

    // Cek tipe file yang diizinkan
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowed_types)) {
        echo "Hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.";
        exit();
    }

    // Coba upload file
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        // Simpan data ke database
        $nis = $_POST['nis'];
        $nama = $_POST['nama'];
        $visi = $_POST['visi'];
        $misi = $_POST['misi'];

        if ($dbsuara->inputKandidat($file_name, $nis, $nama, $visi, $misi)) {
            header("location: data_kandidat.php");
            exit();
        } else {
            echo "Gagal menyimpan data ke database.";
        }
    } else {
        echo "Gagal mengupload foto.";
    }
} else {
    echo "Aksi tidak valid.";
}
// elseif ($action == "hapus") {
    //     $dbsuara->hapus($_GET['no_urut']);
    //     header("location:data_kandidat.php");
    // } elseif ($action == "update") {
        //     $dbsuara->update($_POST['no_urut'], $_POST['foto'], $_POST['nis'], $_POST['nama'], $_POST['visi'], $_POST['misi']);
        //     header("location:data_kandidat.php");
        // }
        ?>
