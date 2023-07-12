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

$title = 'Hapus Karyawan';

include 'config/app.php';

//menerima id karyawan yang dipilih pengguna
$id_karyawan = (int) $_GET['id_karyawan'];

if (delete_karyawan($id_karyawan) > 0) {
    echo "<script>
            alert('Data Karyawan berhasil dihapus');
            document.location.href = 'karyawan.php';
            </script>";
} else {
    echo "<script>
    alert('Data Karyawan gagal dihapus');
    document.location.href = 'karyawan.php';
    </script>";
}