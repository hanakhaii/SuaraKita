<?php
class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "suarakita";
    private $connect;

    function __construct()
    {
        $this->connect = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->connect->connect_error) {
            die("Koneksi gagal: " . $this->connect->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->connect;
    }

    // Tampilkan semua kandidat
    public function viewKandidat() {
        $query = $this->connect->query("SELECT * FROM kandidat");
        return $query->fetch_all(MYSQLI_ASSOC);
    }

    // Tampilkan semua pemilih
    function viewPemilih()
    {
        $query = $this->connect->query("SELECT * FROM pengguna WHERE role = 'user'");
        return $query->fetch_all(MYSQLI_ASSOC);
    }

    // Tambah pemilih
    function inputPemilih($nis, $password, $username, $nama, $role, $validasi_memilih)
    {
        $stmt = $this->connect->prepare("INSERT INTO pengguna (nis, password, username, nama, role, validasi_memilih) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $nis, $password, $username, $nama, $role, $validasi_memilih);
        return $stmt->execute();
    }


    // Tambah kandidat
    public function inputKandidat($foto, $poster, $nis, $nama, $visi, $misi, $deskripsi)
    {
        $stmt = $this->connect->prepare("INSERT INTO kandidat (foto, poster, nis, nama, visi, misi, deskripsi) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $foto, $poster, $nis, $nama, $visi, $misi, $deskripsi);
        $stmt->execute();
        $stmt->close();
    }



    // Edit pemilih
    function editPemilih($nis, $username, $nama, $password)
    {
        $stmt = $this->connect->prepare("UPDATE pengguna SET username=?, nama=?, password=? WHERE nis=?");
        $stmt->bind_param("ssss", $username, $nama, $hashed_password, $nis);
        return $stmt->execute();
    }

    // Edit kandidat
    function editKandidat($no_urut, $nis, $nama, $visi, $misi, $foto = null)
    {
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
    function deleteKandidat($no_urut)
    {
        $stmt = $this->connect->prepare("DELETE FROM kandidat WHERE no_urut=?");
        $stmt->bind_param("i", $no_urut);
        return $stmt->execute();
    }

    // Hapus semua kandidat
    public function deleteAllKandidat()
    {
        $stmt = $this->connect->prepare("DELETE FROM kandidat");
        return $stmt->execute();
    }

    // Hapus pemilih
    function deletePemilih($nis)
    {
        $stmt = $this->connect->prepare("DELETE FROM pengguna WHERE nis=?");
        $stmt->bind_param("s", $nis);
        return $stmt->execute();
    }

    // Hapus semua pemilih
    public function deleteAllPemilih()
    {
        $stmt = $this->connect->prepare("DELETE FROM pengguna WHERE role = 'user'");
        return $stmt->execute();
    }

    // Dapatkan data pemilih berdasarkan NIS
    function getPemilihById($nis)
    {
        $stmt = $this->connect->prepare("SELECT * FROM pengguna WHERE nis=?");
        $stmt->bind_param("s", $nis);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Dapatkan data kandidat berdasarkan No Urut
    function getKandidatById($no_urut)
    {
        $stmt = $this->connect->prepare("SELECT * FROM kandidat WHERE no_urut=?");
        $stmt->bind_param("i", $no_urut);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Login admin
    function loginAdmin($username, $password)
    {
        $stmt = $this->connect->prepare("SELECT * FROM admin WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        return ($result && password_verify($password, $result['password'])) ? $result : false;
    }

    // Login user
    function loginUser($nis, $password)
    {
        $stmt = $this->connect->prepare("SELECT * FROM pengguna WHERE nis=? AND role='user'");
        $stmt->bind_param("s", $nis);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if (!$result) return false;

        // Cek apakah password di-hash atau tidak
        if (password_get_info($result['password'])['algo']) {
            return password_verify($password, $result['password']) ? $result : false;
        } else {
            return ($password === $result['password']) ? $result : false;
        }
    }

    // Logout
    function logout()
    {
        session_start();
        session_destroy();
        header('Location: login.php');
        exit();
    }

    public function simpanPengaturanWaktu($waktu_mulai_memilih, $waktu_selesai_memilih, $waktu_quickcount, $waktu_selesai_quickcount)
    {
        $stmt = $this->getConnection()->prepare("INSERT INTO pengaturan_waktu 
            (waktu_mulai_memilih, waktu_selesai_memilih, waktu_quickcount, waktu_selesai_quickcount) 
            VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $waktu_mulai_memilih, $waktu_selesai_memilih, $waktu_quickcount, $waktu_selesai_quickcount);
        return $stmt->execute();
    }

    public function getPengaturanWaktu()
    {
        $query = "SELECT * FROM pengaturan_waktu ORDER BY id DESC LIMIT 1";
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result(); // ambil result
        return $result->fetch_assoc(); // ambil satu baris sebagai array asosiatif
    }

    public function getAllKandidat()
    {
        $stmt = $this->connect->prepare("SELECT no_urut, nama, jumlah_suara, foto FROM kandidat");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllSuara()
    {
        $query = "SELECT s.*, p.nama AS nama_pemilih, k.nama AS nama_kandidat 
                FROM suara s 
                JOIN pengguna p ON s.nis_pemilih = p.nis 
                JOIN kandidat k ON s.no_urut_kandidat = k.no_urut";
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Di dalam class Database di db.php
    public function getTotalSuara()
    {
        $query = "SELECT SUM(jumlah_suara) as total FROM kandidat";
        $result = $this->connect->query($query);
        $row = $result->fetch_assoc();
        return $row['total'] ?? 0;
    }
}

// Instansiasi database
$dbsuara = new Database();
