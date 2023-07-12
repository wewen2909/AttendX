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
$title = 'Detail Karyawan';

include 'layout/header.php';



//mengambil id karyawan dari url
$id_karyawan = (int) $_GET['id_karyawan'];

//menampilkan data karyawan
$karyawan = select("SELECT * FROM karyawan WHERE id_karyawan = $id_karyawan")[0];


?>

<div class="container mt-5">
    <h1>Data
        <?= $karyawan['nama'] ?>
    </h1>
    <hr>



    <table class="table table-bordered table-striped mt-3">
    <tr>
            <td>UID RFID</td>
            <td>:
                <?= $karyawan['rfid']; ?>
            </td>
        </tr>
 
        <tr>
            <td>Nama</td>
            <td>:
                <?= $karyawan['nama']; ?>
            </td>
        </tr>

        <tr>
            <td>Id</td>
            <td>:
                <?= $karyawan['id_karyawan']; ?>
            </td>
        </tr>

        <tr>
            <td>Jenis Kelamin</td>
            <td>:
                <?= $karyawan['jk']; ?>
            </td>
        </tr>

        <tr>
            <td>Divisi</td>
            <td>:
                <?= $karyawan['divisi']; ?>
            </td>
        </tr>

        <tr>
            <td>Email</td>
            <td>:
                <?= $karyawan['email']; ?>
            </td>
        </tr>

        <tr>
            <td width="50%">Foto</td>
            <td>
                <a href="assets/img/<?= $karyawan['foto']; ?>">
                    <img src="assets/img/<?= $karyawan['foto']; ?>" alt="foto" width="50%">
                </a>
            </td>
        </tr>

    </table>

    <a href="karyawan.php" class="btn btn-secondary btn-sm" style="float:right">Kembali</a>

</div>



<?php include 'layout/footer.php'; ?>