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
}
// installasi
$db = new Database();

?>