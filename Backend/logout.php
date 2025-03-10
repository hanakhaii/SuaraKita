<?php
session_start();
session_destroy(); // Hapus semua sesi
// Mengarahkan ke halaman welcome
echo "<script>
    alert('Anda telah berhasil logout');
    window.location.href = 'home.php';
</script>";
exit;
?>
