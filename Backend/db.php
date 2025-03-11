<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "suarakita";
    private $connect;

    function __construct() {
        $this->connect = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->connect->connect_error) {
            die("Koneksi gagal: " . $this->connect->connect_error);
        }
    }

    public function getConnection() {
        return $this->connect;
    }
    
    // Tampilkan semua kandidat
    function viewKandidat() {
        $query = $this->connect->query("SELECT * FROM kandidat");
        return $query->fetch_all(MYSQLI_ASSOC);
    }

    // Tampilkan semua pemilih
    function viewPemilih() {
        $query = $this->connect->query("SELECT * FROM pengguna");
        return $query->fetch_all(MYSQLI_ASSOC);
    }

    // Tambah pemilih dengan password hashed
    function inputPemilih($nis, $password, $username, $nama) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->connect->prepare("INSERT INTO pengguna (nis, password, username, nama, role, validasi_memilih) VALUES (?, ?, ?, ?, 'user', 'belum_memilih')");
        $stmt->bind_param("ssss", $nis, $hashed_password, $username, $nama);
        return $stmt->execute();
    }

    // Tambah kandidat
    function inputKandidat($foto, $nis, $nama, $visi, $misi) {
        $stmt = $this->connect->prepare("INSERT INTO kandidat (foto, nis, nama, visi, misi) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $foto, $nis, $nama, $visi, $misi);
        return $stmt->execute();
    }

    // Edit pemilih
    function editPemilih($nis, $username, $nama, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->connect->prepare("UPDATE pengguna SET username=?, nama=?, password=? WHERE nis=?");
        $stmt->bind_param("ssss", $username, $nama, $hashed_password, $nis);
        return $stmt->execute();
    }

    // Edit kandidat
    function editKandidat($no_urut, $nis, $nama, $visi, $misi, $foto = null) {
        if ($foto) {
            $stmt = $this->connect->prepare("UPDATE kandidat SET nis=?, nama=?, visi=?, misi=?, foto=? WHERE no_urut=?");
            $stmt->bind_param("sssssi", $nis, $nama, $visi, $misi, $foto, $no_urut);
        } else {
            $stmt = $this->connect->prepare("UPDATE kandidat SET nis=?, nama=?, visi=?, misi=? WHERE no_urut=?");
            $stmt->bind_param("ssssi", $nis, $nama, $visi, $misi, $no_urut);
        }
        return $stmt->execute();
    }
    

    // Hapus kandidat
    function deleteKandidat($no_urut) {
        $stmt = $this->connect->prepare("DELETE FROM kandidat WHERE no_urut=?");
        $stmt->bind_param("i", $no_urut);
        return $stmt->execute();
    }

    // Hapus pemilih
    function deletePemilih($nis) {
        $stmt = $this->connect->prepare("DELETE FROM pengguna WHERE nis=?");
        $stmt->bind_param("s", $nis);
        return $stmt->execute();
    }

    // Dapatkan data pemilih berdasarkan NIS
    function getPemilihById($nis) {
        $stmt = $this->connect->prepare("SELECT * FROM pengguna WHERE nis=?");
        $stmt->bind_param("s", $nis);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Dapatkan data kandidat berdasarkan No Urut
    function getKandidatById($no_urut) {
        $stmt = $this->connect->prepare("SELECT * FROM kandidat WHERE no_urut=?");
        $stmt->bind_param("i", $no_urut);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

     // Login admin
    function loginAdmin($username, $password) {
        $stmt = $this->connect->prepare("SELECT * FROM admin WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        return ($result && password_verify($password, $result['password'])) ? $result : false;
    }

    // Login user
    function loginUser($nis, $password) {
        $stmt = $this->connect->prepare("SELECT * FROM pengguna WHERE nis=? AND role='user'");
        $stmt->bind_param("s", $nis);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        return ($result && password_verify($password, $result['password'])) ? $result : false;
    }
    // Logout
    function logout() {
        session_start();
        session_destroy();
        header('Location: login.php');
        exit();
    }
}

// Instansiasi database
$dbsuara = new Database();
?>
