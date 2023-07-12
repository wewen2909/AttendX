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

$title = 'Ubah Divisi';

include 'layout/header.php';

//mengambil id divisi dari url
$id_divisi = (int)$_GET['id_divisi'];

$divisi = select("SELECT * FROM divisi WHERE id_divisi = $id_divisi")[0];
// cek apakah tombol ubah ditekan

if (isset($_POST['ubah'])) {
  if (update_divisi($_POST) > 0) {
      echo "<script>
      alert('Data divisi Berhasil Diubah');
      document.location.href = 'divisi.php';
      </script>";
  } else { 
      echo "<script>
      alert('Data divisi Gagal Diubah');
      document.locetion.href = 'divisi.php';
      </script>";
  }
}
?>

<div class="container mt-5">
  <h1>Ubah Divisi</h1>
  <hr>

  <form action="" method="post">
    <input type="hidden" name="id_divisi" value="<?= $divisi['id_divisi']; ?>">
  <!-- <div class="mb-3">
      <label for="id" class="form-label">Id Divisi</label>
      <input type="text" class="form-control" id="id_divisi" name="id_divisi" placeholder="Masukkan Id divisi">
    </div> -->

    <div class="mb-3">
      <label for="divisi" class="form-label">Nama Divisi</label>
      <input type="text" class="form-control" id="divisi" name="divisi" value="<?= $divisi['divisi']; ?>" placeholder="Masukkan nama divisi">
    </div>

    <div class="mb-3">
      <label for="singkatan" class="form-label">Singkatan Divisi</label>
      <input type="text" class="form-control" id="singkatan" name="singkatan" value="<?= $divisi['singkatan']; ?>" placeholder="Singkatan divisi">
    </div>

    <a href="divisi.php" class="btn btn-secondary mx-3" style="float:right">Kembali</a>
    <button type="submit" name="ubah" class="btn btn-primary" style="float:right">Ubah</button>
  </form>
</div>

<?php include 'layout/footer.php'; ?>