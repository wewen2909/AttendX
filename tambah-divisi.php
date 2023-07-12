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

$title = 'Tambah Divisi';

include 'layout/header.php';

// cek apakah tombol tambah ditekan

if (isset($_POST['tambah'])) {
  if (create_divisi($_POST) > 0) {
      echo "<script>
      alert('Data divisi Berhasil Ditambahkan');
      document.location.href = 'divisi.php';
      </script>";
  } else { 
      echo "<script>
      alert('Data divisi Gagal Ditambahkan');
      document.locetion.href = 'divisi.php';
      </script>";
  }
}
?>

<div class="container mt-5">
  <h1>Tambah Divisi</h1>
  <hr>

  <form action="" method="post">
  <!-- <div class="mb-3">
      <label for="id" class="form-label">Id Divisi</label>
      <input type="text" class="form-control" id="id_divisi" name="id_divisi" placeholder="Masukkan Id divisi">
    </div> -->

    <div class="mb-3">
      <label for="divisi" class="form-label">Nama Divisi</label>
      <input type="text" class="form-control" id="divisi" name="divisi" placeholder="Masukkan nama divisi" required>
    </div>

    <div class="mb-3">
      <label for="singkatan" class="form-label">Singkatan Divisi</label>
      <input type="text" class="form-control" id="singkatan" name="singkatan" placeholder="Singkatan divisi" required>
    </div>

    <button type="submit" name="tambah" class="btn btn-primary" style="float:right">Tambah</button>
    
  </form>
</div>

<?php include 'layout/footer.php'; ?>