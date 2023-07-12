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

// membatasi halaman sesuai user login
if ($_SESSION["level"] == 2  ) {
    echo "<script>
        alert('Perhatian anda tidak punya hak akses');
        document.location.href = 'akun.php';
    </script>";
    exit;
}
$title = 'Karyawan';

include 'layout/header.php';



//menampilkan data mahasiswa
$data_karyawan = select("SELECT * FROM karyawan ORDER BY id_karyawan DESC");


?>

<div class="container mt-5">
    <h1><i class="fas fa-users mx-1"></i>Data Karyawan</h1>
    <hr>

    <a href="tambah-karyawan.php" class="btn btn-primary mb-3 "> <i class="fas fa-plus-circle mx-1"></i>Tambah</a>

    <table class="table table-bordered table-striped mt-3" id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>UID RFID</th>
                <th>Nama Karyawan</th>
                <th>Id Karyawan</th>  
                <th>Jenis Kelamin</th>
                <th>Divisi</th>
                 <th>Email</th>
               <!-- <th>Foto</th> -->
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($data_karyawan as $karyawan) : ?>
                <tr>
                    <td><?= $no++;?></td> 
                    <td><?= $karyawan['rfid']?></td>
                    <td><?= $karyawan['nama']?></td>
                     <td><?= $karyawan['id_karyawan']?></td>
                    <td><?= $karyawan['jk']?></td>
                    <td><?= $karyawan['divisi']?> 
                    <?php 
                    $query = $db->query("SELECT * FROM divisi");
                    while ($divisi = $query->fetch_assoc()) {
                    ?><?php
                    }
                    ?>
                    </td>
                    <td><?= $karyawan['email']?></td>
                    <td class="text-center" width="20%">
                        <a href="detail-karyawan.php?id_karyawan=<?= $karyawan['id_karyawan']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i>Detail</a>
                        <a href="ubah-karyawan.php?id_karyawan=<?= $karyawan['id_karyawan'];?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i>Ubah</a>
                        <a href="hapus-karyawan.php?id_karyawan=<?= $karyawan['id_karyawan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Data Karyawan akan dihapus?');"><i class="fas fa-trash"></i>Hapus</a>
                    </td>
                    <!-- <td><?= $karyawan['photo']?></td> -->
                </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'layout/footer.php'; ?>