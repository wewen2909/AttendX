<?php
session_start();
// membatasi halaman sebelum login
if(!isset($_SESSION["login"])) {
    echo "<script>
        alert('Anda harus login !');
        document.location.href = 'login.php';
    </script>";
    exit;
}
$title = 'Hapus Divisi';

include 'config/app.php';

//menerima id divisi yang dipilih pengguna
$id_divisi = (int) $_GET['id_divisi'];

if (delete_divisi($id_divisi) > 0) {
    echo "<script>
            alert('Data Divisi berhasil dihapus');
            document.location.href = 'divisi.php';
            </script>";
} else {
    echo "<script>
    alert('Data Divisi gagal dihapus');
    document.location.href = 'divisi.php';
    </script>";
}