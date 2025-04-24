<?php
session_start();
include 'db.php';

if (isset($_SESSION['nis'])) {
    $nis = $_SESSION['nis'];
    
    $query = $conn->prepare("DELETE FROM pengguna WHERE nis = ?");
    $query->bind_param("s", $nis);

    if ($query->execute()) {
        session_destroy();
        http_response_code(200); // sukses
    } else {
        http_response_code(500); // gagal
    }
}
exit;
