<?php
class Database {
    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "suarakita";
    var $connect; // Property untuk menyimpan koneksi

    // Method untuk connect ke database
    function __construct() {
        $this->connect = mysqli_connect($this->host, $this->username, $this->password, $this->database);

        if (!$this->connect) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }
    }

    // Method untuk tampil data kandidat
    function viewKandidat() {
        $query = mysqli_query($this->connect, "SELECT * FROM kandidat");

        $result = [];

        while ($data = mysqli_fetch_array($query)) {
            $result[] = $data;
        }
        return $result;
    }

    // Method untuk input data kandidat
    function inputKandidat($foto, $nis, $nama, $visi, $misi) {
        // Escape input untuk menghindari SQL injection
        $foto = mysqli_real_escape_string($this->connect, $foto);
        $nis = mysqli_real_escape_string($this->connect, $nis);
        $nama = mysqli_real_escape_string($this->connect, $nama);
        $visi = mysqli_real_escape_string($this->connect, $visi);
        $misi = mysqli_real_escape_string($this->connect, $misi);

        // Query untuk menyimpan data ke database
        $query = "INSERT INTO kandidat (foto, nis, nama, visi, misi) VALUES ('$foto', '$nis', '$nama', '$visi', '$misi')";

        // Eksekusi query
        if (mysqli_query($this->connect, $query)) {
            return true; // Berhasil
        } else {
            // Tampilkan pesan error
            echo "Error: " . mysqli_error($this->connect);
            return false; // Gagal
        }
    }
}

// Instansiasi
$dbsuara = new Database();
?>