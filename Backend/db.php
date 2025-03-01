<?php 

// class untuk Database
class Database {
    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "suarakita";

    // method untuk connect ke database
    function __construct() {
        $koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);

        if ($koneksi) {
            echo "Connection successful";
        } else {
            echo "Connection failed";
        }
    }

    //method untuk insert data kandidat
    function tambahkandidat($foto, $nis, $nama, $visi, $misi){
        $koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        mysqli_query($koneksi, "INSERT INTO kandidat VALUES( '$foto' , '$nis' , '$nama', '$visi' , '$misi')");
    }
}
// installasi
$db = new Database();

?>