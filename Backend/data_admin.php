<?php
require_once 'db.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Admin</title>
    <!-- Masukkan CSS yang sama dengan data_pemilih -->
    <link rel="stylesheet" href="styles.css">
    <script>
        function confirmDelete(nis) {
            if (confirm('Yakin ingin menghapus admin dengan NIS ' + nis + '?')) {
                window.location.href = 'process.php?action=delete_admin&nis=' + nis;
            }
        }
        function confirmDeleteAll() {
            if (confirm('Yakin ingin menghapus semua data admin?')) {
                window.location.href = 'process.php?action=delete_all_admin';
            }
        }
    </script>
</head>
<body>
    <h1>Halaman Data Admin</h1>
    <section class="table_body_admin">
        <table align="center" border="1" class="tablemilih">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NIS</th>
                    <th>NAMA</th>
                    <th>USERNAME</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $search = isset($_GET['search']) ? $_GET['search'] : '';

                $admins = $dbsuara->viewAdmin($search);
                if (empty($admins)) : ?>
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 30px;">
                            Tidak ada data ditemukan
                        </td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($admins as $admin) : ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($admin['nis']); ?></td>
                            <td><?php echo htmlspecialchars($admin['nama']); ?></td>
                            <td><?php echo htmlspecialchars($admin['username']); ?></td>
                            <td>
                                <a href="edit_admin.php?nis=<?php echo $admin['nis']; ?>">Edit</a> |
                                <a href="#" onclick="confirmDelete('<?php echo $admin['nis']; ?>')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </section>
    <div class="tombol-aksi-pengguna">
        <a href="upload_admin.php">Tambah Admin</a>
        <a href="#" onclick="confirmDeleteAll()">Hapus Semua</a>
    </div>
</body>
</html>