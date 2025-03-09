<?php
require_once 'db.php';

// Ambil koneksi database
$connect = $dbsuara->getConnection();

// Ambil semua data pengguna
$query = "SELECT nis, password FROM pengguna";
$result = $connect->query($query);

while ($row = $result->fetch_assoc()) {
    $nis = $row['nis'];
    $plain_password = $row['password'];

    // Cek apakah password sudah di-hash atau belum
    if (!password_get_info($plain_password)['algo']) {
        // Hash password jika masih dalam bentuk teks biasa
        $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

        // Update password di database
        $updateQuery = "UPDATE pengguna SET password = ? WHERE nis = ?";
        $stmt = $connect->prepare($updateQuery);
        $stmt->bind_param("ss", $hashed_password, $nis);
        $stmt->execute();

        echo "Password untuk NIS: $nis berhasil di-hash!<br>";
    }
}

echo "Semua password telah di-hash!";
?>
