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

$title = 'Data Akun';
include 'layout/header.php';

//tampil seluruh data 
$data_akun = select("SELECT * FROM akun");


//tampil data berdasarkan user login
$id_akun = $_SESSION['id_akun'];
$data_bylogin = select("SELECT * FROM akun WHERE id_akun = $id_akun");



// jika tombol ubah ditekan, jalankan script berikut
if (isset($_POST['ubah'])) {
    if (update_akun($_POST) > 0) {
        echo "<script>
        alert('Data Akun Berhasil Diubah');
        document.location.href = 'akun-karyawan.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Akun Gagal Diubah');
        document.location.href = 'akun-karyawan.php';
        </script>";
    }
}

//ambil id karyawan dari url



//tampil data berdasarkan user login
$id_karyawan = $_SESSION['id_karyawan'];
$data_bylogin2 = select("SELECT * FROM karyawan WHERE id_karyawan = $id_karyawan");
// cek apakah tombol ubah ditekan

if (isset($_POST['ubah_karyawan'])) {
    if (update_karyawan($_POST) > 0) {
        echo "<script>
      alert('Data karyawan Berhasil Diubah');
      document.location.href = 'akun-karyawan.php';
      </script>";
    } else {
        echo "<script>
      alert('Data karyawan Gagal Diubah');
      document.locetion.href = 'akun-karyawan.php';
      </script>";
    }
}

?>
<div class="container mt-5">
    <h1><i class="fas fa-user-circle mx-1"></i>Data Karyawan</h1>
    <hr>
    <!-- Tampil Data berdasarkan user login -->
     <!-- Form Data Karyawan -->
    <?php foreach ($data_bylogin2 as $karyawan): ?>
            <table class="table">
                <tr>
                    <th>Nama Karyawan</th>
                    <td>
                        <?= $karyawan['nama']; ?>
                    </td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>
                        <?= $karyawan['jk']; ?>
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>
                        <?= $karyawan['email']; ?>
                    </td>
                </tr>
                <tr>
                    <th>Divisi</th>
                    <td>
                        <?= $karyawan['divisi']; ?>
                    </td>
                </tr>
                <tr>
                    <th>Foto</th>
                    <td>
                        <a href="assets/img/<?= $karyawan['foto']; ?>">
                            <img src="assets/img/<?= $karyawan['foto']; ?>" alt="foto" width="20%">
                        </a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="button" class="btn btn-success mb-1 float-end" data-bs-toggle="modal"
                            data-bs-target="#modalUbahKaryawan<?= $karyawan['id_karyawan']; ?>"><i class="fas fa-edit"></i>
                            Ubah Data Karyawan</button>
                    </td>
                </tr>
            </table>
        <?php endforeach; ?>

        <!-- Form Data Akun -->
        <h1><i class="fas fa-user-circle mx-1"></i>Data Akun</h1>
    <hr>
    <?php if ($_SESSION['level'] == 2): ?>
        <?php foreach ($data_bylogin as $akun): ?>
            <table class="table">
                <tr>
                    <th>Nama</th>
                    <td>
                        <?= $akun['nama']; ?>
                    </td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>
                        <?= $akun['username']; ?>
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>
                        <?= $akun['email']; ?>
                    </td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td>Password Ter-enkripsi</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="button" class="btn btn-success mb-1 float-end" data-bs-toggle="modal"
                            data-bs-target="#modalUbah<?= $akun['id_akun']; ?>"><i class="fas fa-edit"></i> Ubah Data Akun</button>
                    </td>
                </tr>
            </table>
        <?php endforeach; ?>

       
    <?php endif; ?>
</div>

<!-- --------------------MODALS---------------------- -->

    <!-- Modal Ubah Data Akun-->
    <?php foreach ($data_akun as $akun): ?>
        <div class="modal fade" id="modalUbah<?= $akun['id_akun']; ?>" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <input type="hidden" name="id_akun" value="<?= $akun['id_akun']; ?>">

                            <div class="mb-3">
                                <label for="karyawan">Id Karyawan</label>
                                <input type="text" name="karyawan" id="karyawan" class="form-control" required
                                    value="<?= $akun['id_karyawan']; ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" required
                                    value="<?= $akun['nama']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required
                                    value="<?= $akun['username']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required
                                    value="<?= $akun['email']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="password">Password<small>(*Masukkan password baru/lama*)</small></label>
                                <input type="password" name="password" id="password" class="form-control" required
                                    minlength="6">
                            </div>
                            <?php if ($_SESSION['level'] == 1): ?>
                                <div class="mb-3">
                                    <label for="level">Level</label>
                                    <select name="level" id="level" class="form-control" required>
                                        <?php $level = $akun['level']; ?>
                                        <option value="1" <?= $level == '1' ? 'selected' : null ?>>Admin</option>
                                        <option value="2" <?= $level == '2' ? 'selected' : null ?>>Karyawan</option>
                                    </select>
                                </div>
                            <?php else: ?>
                                <input type="hidden" name="level" value="<?= $akun['level']; ?>">
                            <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>


    <!-- Modal Ubah Karyawan -->
<?php foreach ($data_bylogin2 as $karyawan): ?>
    <div class="modal fade" id="modalUbahKaryawan<?= $karyawan['id_karyawan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_karyawan" value="<?= $karyawan['id_karyawan']; ?>">
                        <input type="hidden" name="fotoLama" value="<?= $karyawan['foto']; ?>">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama karyawan</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama karyawan" required value="<?= $karyawan['nama']; ?>">
                        </div>

                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="jk" class="form-label">Jenis Kelamin</label>
                                <select name="jk" id="jk" class="form-control" required>
                                    <?php $jk = $karyawan['jk']; ?>
                                    <option value="">-- pilih jenis kelamin --</option>
                                    <option value="Laki-laki" <?= $jk == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                                    <option value="Perempuan" <?= $jk == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="divisi" class="form-label">Divisi</label>
                                <select name="divisi" id="divisi" class="form-control" required>
                                    <?php $selectedDivisi = $karyawan['divisi']; ?>
                                    <option value="">-- pilih divisi --</option>
                                    <?php
                                    $query = $db->query("SELECT * FROM divisi");
                                    while ($divisi = $query->fetch_assoc()) {
                                        $divisiName = $divisi['divisi'];
                                        ?>
                                        <option value="<?= $divisiName; ?>" <?php echo ($selectedDivisi == $divisiName) ? 'selected' : ''; ?>>
                                            <?= $divisiName; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required value="<?= $karyawan['email']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto" placeholder="Upload Foto" onchange="previewImg()">

                            <img src="assets/img/<?= $karyawan['foto']; ?>" alt="" class="img-thumbnail img-preview mt-2" width="100px">
                        </div>

                        <a href="karyawan.php" class="btn btn-secondary mx-3" style="float:right">Kembali</a>
                        <button type="submit" name="ubah_karyawan" class="btn btn-primary" style="float:right">Ubah</button>
                    </form>
                </div>

                <!-- preview image -->
                <script>
                    function previewImg() {
                        const foto = document.querySelector('#foto');
                        const imgPreview = document.querySelector('.img-preview');

                        const fileFoto = new FileReader();
                        fileFoto.readAsDataURL(foto.files[0]);

                        fileFoto.onload = function (e) {
                            imgPreview.src = e.target.result;
                        }
                    }
                </script>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php include 'layout/footer.php'; ?>