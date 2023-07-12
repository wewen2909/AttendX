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

$title = 'Divisi';

include 'layout/header.php';

$data_divisi = select("SELECT * FROM divisi ORDER BY id_divisi ASC");

?>

<div class="container mt-5">
    <h1><i class="fas fa-building"></i>Data Divisi</h1>
    <hr>

    <a href="tambah-divisi.php" class="btn btn-primary mb-3"><i class="fas fa-plus-circle mx-1"></i>Tambah</a>

    <table class="table table-bordered table-striped mt-3" id="table">
        <thead>
            <tr>
                <th>No</th>
                <!-- <th>Id</th> -->
                <th>Nama Divisi</th>
                <th>Singkatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($data_divisi as $divisi) : ?>
            <tr>
                <td><?= $no++; ?></td>  
                <td><?= $divisi['divisi']; ?></td>
                <td><?= $divisi['singkatan']; ?></td>
                <td width="15%" class="text-center">
                    <a href="ubah-divisi.php?id_divisi=<?=$divisi['id_divisi']; ?> " class="btn btn-success"><i class="fas fa-edit "></i>Ubah</a>
                    <a href="hapus-divisi.php?id_divisi=<?=$divisi['id_divisi']; ?>" class="btn btn-danger" onclick="return confirm ('Yakin data Divisi akan dihapus.?')"><i class="fas fa-trash "></i>Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'layout/footer.php'; ?>
