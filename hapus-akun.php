<?php
session_start();
// membatasi halaman sebelum login
if (!isset($_SESSION["login"])) {
    echo "<script>
        alert('Anda harus login!');
        document.location.href = 'login.php';
    </script>";
    exit;
}

$title = 'Hapus Akun';

include 'config/app.php';

// Menerima id akun yang dipilih pengguna
$id_akun = (int) $_GET['id_akun'];

// Hapus akun dan data karyawan terkait
if (delete_akun_with_karyawan($id_akun)) {
    echo "<script>
            alert('Data akun dan data karyawan terkait berhasil dihapus');
            document.location.href = 'akun.php';
          </script>";
} else {
    echo "<script>
            alert('Data akun dan data karyawan terkait gagal dihapus');
            document.location.href = 'akun.php';
          </script>";
}

// Fungsi untuk menghapus akun dan data karyawan terkait
function delete_akun_with_karyawan($id_akun)
{
    global $db;

    // Mulai transaksi
    mysqli_begin_transaction($db);

    try {
        // Hapus data karyawan terkait
        $query_karyawan = "DELETE FROM karyawan WHERE id_karyawan IN (
                            SELECT id_karyawan FROM akun WHERE id_akun = $id_akun
                          )";
        mysqli_query($db, $query_karyawan);

        // Hapus akun
        $query_akun = "DELETE FROM akun WHERE id_akun = $id_akun";
        mysqli_query($db, $query_akun);

        // Commit transaksi jika berhasil
        mysqli_commit($db);

        return true;
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        mysqli_rollback($db);
        return false;
    }
}
?>
