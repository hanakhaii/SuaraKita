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

    // Method untuk edit data kandidat
    function editKandidat($no_urut, $nis, $nama, $visi, $misi, $foto) {
        $connect = mysqli_connect($this->host, $this->username, $this->password, $this->database);   
    
        // Query untuk mengedit data kandidat, termasuk foto
        $query = "UPDATE kandidat SET 
                nis='$nis', 
                nama='$nama', 
                visi='$visi', 
                misi='$misi', 
                foto='$foto' 
                WHERE no_urut='$no_urut'";
        
        $result = mysqli_query($connect, $query);
    
        return $result; // Tambahkan return supaya bisa dicek berhasil atau tidak
    }

    function editPemilih($nis, $username, $nama, $password, $role, $validasi_memilih) {
        $connect = mysqli_connect($this->host, $this->username, $this->password, $this->database);   
    
        // Query untuk mengedit data pemilih
        $query = "UPDATE pengguna SET 
                username='$username', 
                nama='$nama', 
                password='$password', 
                role='$role', 
                validasi_memilih='$validasi_memilih' 
                WHERE nis='$nis'";
        
        $result = mysqli_query($connect, $query);
    
        return $result; // Tambahkan return supaya bisa dicek berhasil atau tidak
    }

    // Method untuk mendapatkan data pemilih berdasarkan NIS
    function getPemilihById($nis) {
        $connect = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        $query = mysqli_query($connect, "SELECT * FROM pengguna WHERE nis='$nis'");
        return mysqli_fetch_assoc($query); // Mengembalikan data satu pemilih sebagai array asosiatif
    }


    function getKandidatById($no_urut) {
        $connect = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        $query = mysqli_query($connect, "SELECT * FROM kandidat WHERE no_urut='$no_urut'");
        return mysqli_fetch_assoc($query); // Mengembalikan data satu kandidat sebagai array asosiatif
    }
    
    // Method untuk hapus data kandidat
    function deleteKandidat($no_urut) {
        $connect = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        $query = mysqli_query($connect, "DELETE FROM kandidat WHERE no_urut='$no_urut'");
        return $query;
    }

    function deletePemilih($nis) {
        $connect = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        $query = mysqli_query($connect, "DELETE FROM pengguna WHERE nis='$nis'");
        return $query;
    }
}

// Instansiasi
$dbsuara = new Database();
?>