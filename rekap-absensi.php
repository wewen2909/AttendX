<?php 
session_start();
// membatasi halaman sebelum login
if (!isset($_SESSION["login"])) {
    echo "<script>
        alert('Anda harus login !');
        document.location.href = 'login.php';
    </script>";
    exit;
}
$title = 'Rekap Absensi';
include 'layout/header.php';

?>

<div class="container mt-5">
    <h1><i class="fas fa-users mx-1"></i>Data Absensi Karyawan</h1>
    <hr>

    <a href="download-excel.php" class="btn btn-success mb-3 "> <i class="fas fa-file-excel mx-1"></i>Download Excel</a>
    <a href="download-pdf.php" class="btn btn-danger mb-3 "> <i class="fas fa-file-pdf mx-1"></i>Download PDF</a>

    <table class="table table-bordered table-striped mt-3" id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Email</th>
                <th>Divisi</th>
                <th>Tanggal</th>
                <th>Jam kedatangan</th>  
                <th>Jam kepulangan</th>
                <th>Keterangan </th>
            </tr>
        </thead>
    </table>
</div>    

<?php include 'layout/footer.php'; ?>
