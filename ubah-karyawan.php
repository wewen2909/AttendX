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

$title = 'Ubah Karyawan';

include 'layout/header.php';

// cek apakah tombol ubah ditekan

if (isset($_POST['ubah'])) {
    if (update_karyawan($_POST) > 0) {
        echo "<script>
      alert('Data karyawan Berhasil Diubah');
      document.location.href = 'karyawan.php';
      </script>";
    } else {
        echo "<script>
      alert('Data karyawan Gagal Diubah');
      document.locetion.href = 'karyawan.php';
      </script>";
    }
}

//ambil id karyawan dari url

$id_karyawan = (int)$_GET['id_karyawan'];

//query ambil data karyawan

$karyawan = select("SELECT * FROM karyawan WHERE id_karyawan = $id_karyawan")[0];
?>

<div class="container mt-5">
    <h1>Ubah karyawan</h1>
    <hr>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_karyawan" value="<?= $karyawan['id_karyawan']; ?>">
        <input type="hidden" name="fotoLama" value="<?= $karyawan['foto']; ?>">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama karyawan</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama karyawan" required 
            value="<?= $karyawan['nama']; ?>">
        </div>

        <div class="row">
            <div class="mb-3 col-6">
                <label for="jk" class="form-label">Jenis Kelamin</label>
                <select name="jk" id="jk" class="form-control" required>
                    <?php $jk = $karyawan['jk']; ?>
                    <option value="">-- pilih jenis kelamin --</option>
                    <option value="Laki-laki" <?= $jk == 'Laki-laki' ? 'selected' : null ?>>Laki-laki</option>
                    <option value="Perempuan" <?= $jk == 'Perempuan' ? 'selected' : null ?>>Perempuan</option>
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
            <input type="file" class="form-control" id="foto" name="foto" placeholder="Upload Foto"
            onchange="previewImg()">
           
            <img src="assets/img/<?= $karyawan['foto']; ?>" alt="" class="img-thumbnail img-preview mt-2" width="100px " >

        </div>

        <a href="karyawan.php" class="btn btn-secondary mx-3" style="float:right">Kembali</a>
        <button type="submit" name="ubah" class="btn btn-primary" style="float:right">Ubah</button>
    </form>
</div>

<!-- preview image -->
<script>
    function previewImg() {
        const foto = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview');

        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload =function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>

<?php include 'layout/footer.php'; ?>