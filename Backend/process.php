<?php 
include 'db.php';
$dbsuara = new Database();

$action = $_GET['action'];

if ($action == "add") {
    if(isset($_FILES['foto'])){
        $file_name = $_FILES['foto']['name'];
        $tmp_file = $_FILES['foto']['tmp_name'];
        $folder   = "uploads/";

        if(move_uploaded_file($tmp_file, $folder . $file_name)){
            $dbsuara->inputKandidat($file_name, $_POST['nis'], $_POST['nama'], $_POST['visi'], $_POST['misi']);
            header("location:data_kandidat.php");
        } else {
            echo "Upload gagal!";
        }
    }
} else if ($action == "edit") {
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
}
?>