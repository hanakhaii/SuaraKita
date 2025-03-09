<?php
require_once 'db.php';

// Ambil koneksi database
$connect = $dbsuara->getConnection();

// Ambil semua data admin
$query = "SELECT username, password FROM pengguna";
$result = $connect->query($query);

while ($row = $result->fetch_assoc()) {
    $username = $row['username'];
    $plain_password = $row['password'];

    // Cek apakah password sudah di-hash atau belum
    if (!password_get_info($plain_password)['algo']) {
        // Hash password jika masih dalam bentuk teks biasa
        $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

        // Update password di database
        $updateQuery = "UPDATE pengguna SET password = ? WHERE username = ?";
        $stmt = $connect->prepare($updateQuery);
        $stmt->bind_param("ss", $hashed_password, $username);
        $stmt->execute();

        echo "Password untuk Username: $username berhasil di-hash!<br>";
    }
}

echo "Semua password admin telah di-hash!";
?>
