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

include 'layout/header.php';

?>

<div class="container mt-5">
    <h1><i class="fas fa-users mx-1"></i>Data Absensi Karyawan</h1>
    <hr>

    <a href="download" class="btn btn-primary mb-3 "> <i class="fas fa-plus-circle mx-1"></i>Download</a>

    <table class="table table-bordered table-striped mt-3" id="table">
        <thead>
            <tr>
                <th>No</th>
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
