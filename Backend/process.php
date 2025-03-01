<?php 
include 'db.php';
$dbsuara = new Database();

$action = $_GET['action'];
if ($action == "add") {
    $dbsuara->inputKandidat($_FILES['foto']['name'], $_POST['nis'], $_POST['nama'], $_POST['visi'], $_POST['misi']);
    header("location:data_kandidat.php");
} 
// elseif ($aksi == "hapus") {
//     $dbsuara->hapus($_GET['no_urut']);
//     header("location:data_kandidat.php");
// } elseif ($aksi == "update") {
//     $dbsuara->update($_POST['no_urut'], $_POST['foto'], $_POST['nis'], $_POST['nama'], $_POST['visi'], $_POST['misi']);
//     header("location:data_kandidat.php");
// }

if(isset($_FILES['foto'])){
    $file_name = $_FILES['foto']['name'];
    $tmp_file = $_FILES['foto']['tmp_name'];
    $folder   = "uploads/";
    
    if(move_uploaded_file($tmp_file, $folder . $file_name)){
        // Simpan $file_name ke database, misalnya:
        $query = "INSERT INTO foto_table (judul, nama_file) VALUES (:judul, :nama_file)";
        // Eksekusi query dengan prepared statement, dll.
    } else {
        echo "Upload gagal!";
    }
}
