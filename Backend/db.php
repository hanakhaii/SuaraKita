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
        $connect = mysqli_connect ($this->host, $this->username, $this->password, $this->database);   
        $query = mysqli_query($connect, "SELECT * FROM kandidat");

        $result = [];

        while ($data = mysqli_fetch_array($query)) {
            $result[] = $data;
        }
        return $result;
    }

    function viewPemilih() {
        $connect = mysqli_connect ($this->host, $this->username, $this->password, $this->database);   
        $query = mysqli_query($connect, "SELECT * FROM pengguna");

        $result = [];

        while ($data = mysqli_fetch_array($query)) {
            $result[] = $data;
        }
        return $result;
    }
    

    function inputPemilih($nis, $password, $username, $nama, $role, $validasi_memilih) {
        $connect = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        mysqli_query($connect, "
        INSERT INTO pengguna (nis, password, username, nama, role, validasi_memilih)
        VALUES ('$nis', '$password', '$username', '$nama', '$role', '$validasi_memilih')");
    }
    

    // Method untuk input data kandidat
    function inputKandidat($foto, $nis, $nama, $visi, $misi) {
        // Escape input untuk menghindari SQL injection
        $connect = mysqli_connect ($this->host, $this->username, $this->password, $this->database);   

        // Query untuk menyimpan data ke database
        mysqli_query($connect, "
        INSERT INTO kandidat (foto, nis, nama, visi, misi)
        VALUES ('$foto', '$nis', '$nama', '$visi', '$misi')
    ");
    }
}

// Instansiasi
$dbsuara = new Database();
?>