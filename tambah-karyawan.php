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




$title = 'Tambah Karyawan';

include 'layout/header.php';

// cek apakah tombol tambah ditekan

if (isset($_POST['tambah'])) {
    if (create_karyawan($_POST) > 0) {
        echo "<script>
      alert('Data karyawan Berhasil Ditambahkan');
      document.location.href = 'karyawan.php';
      </script>";
    } else {
        echo "<script>
      alert('Data karyawan Gagal Ditambahkan');
      document.locetion.href = 'karyawan.php';
      </script>";
    }
}
?>
<?php


?>

<div class="container mt-5">
    <h1>Tambah karyawan</h1>
    <hr>

    <form action="" method="post" enctype="multipart/form-data">


        <div class="mb-3">
            <label for="nama" class="form-label">Nama karyawan</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama karyawan" required>
        </div>

        <div class="row">
            <div class="mb-3 col-6">
                <label for="jk" class="form-label">Jenis Kelamin</label>
                <select name="jk" id="jk" class="form-control" required>
                    <option value="">-- pilih jenis kelamin --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="mb-3 col-6">
                <label for="divisi" class="form-label">Divisi</label>
                <select name="divisi" id="divisi" class="form-control" required>
                    <option value="divisi">-- pilih divisi --</option>
                    <?php
                    $query = $db->query("SELECT * FROM divisi");
                    while ($divisi = $query->fetch_assoc()) {
                        ?>
                        <option value="<?= $divisi['id_divisi']; ?>"> <?= $divisi['divisi']; ?></option>
                        <?php
                    }
                    ?>
                    <!-- <option value="Digital Marketing">Digital Marketing</option>
                    <option value="Mobile Development">Mobile Development</option>
                    <option value="Data Analist">Data Analist</option> -->
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" placeholder="Upload Foto"
                onchange="previewImg()">
            <img src="" alt="" class="img-thumbnail img-preview mt-2" width="100px ">
        </div>

        <div id="hasil_scan" style="display:none">
            <div class="mb-3">
                <div class="form-group">
                    <label>ID Kartu </label>
                    <input class="form-control" name="rfid" id="rfid" required="required">
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label>Foto </label>

                    <img id="myfoto" src="#" class="img-circle" width="60px" height="60px" alt="User Image">

                    <input class="form-control" type="hidden" name="photo" id="photo" required="required">
                </div>
            </div>
        </div>

        <button type="submit" name="tambah" class="btn btn-primary mx-3" style="float:right">Tambah</button>
        <button type="button" class="btn btn-success pull-left" id="getrfid" style="float:right">Ambil Data RFID
            & Foto</button>
        </br>
        <hr>
        <small style="float:right">*) Mohon Scan Kartu & Foto dahulu, sebelum ambil data.</small>

    </form>
</div>

<!-- UID RFID -->

<?php include('layout/javascript.php'); ?>

<!-- DataTables -->

<script src="./bower_components/datatables/datatables.net/js/jquery.dataTables.js"></script>
<script src="./bower_components/datatables/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
<script src="./bower_components/datatables/datatables.net-buttons/js/dataTables.buttons.js"></script>
<script src="./bower_components/datatables/datatables.net-buttons-bs/js/buttons.bootstrap.js"></script>
<script src="./bower_components/datatables/datatables.net-buttons/js/buttons.colVis.js"></script>
<script src="./bower_components/datatables/datatables.net-buttons/js/buttons.flash.js"></script>
<script src="./bower_components/datatables/datatables.net-buttons/js/buttons.html5.js"></script>
<script src="./bower_components/datatables/datatables.net-buttons/js/buttons.print.js"></script>
<script src="./bower_components/datatables/datatables.net-keytable/js/dataTables.keyTable.js"></script>
<script src="./bower_components/datatables/datatables.net-responsive/js/dataTables.responsive.js"></script>
<script src="./bower_components/datatables/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>

<script type="text/javascript">
    // document.ready function
    $(document).ready(function () {

        // selector has to be . for a class name and # for an ID
        $('#getrfid').click(function () {


            $.ajax({
                url: 'face_recognation/rfid.txt',
                cache: false,
                beforeSend: function () {
                    $("#getrfid").prop("disabled", true).html(
                        '<sup><em class="fa fa-cog text-muted fa-spin"></em></sup> Mohon Tunggu, Sedang Mencari Hasil Scan Kartu.'
                    );

                },

                'success': function (data) {
                    setTimeout(function () {
                        delaySuccess(data);
                    }, 3000);
                },
                error: function () {
                    alert('Error');
                }
            });
        });

        function delaySuccess(data) {
            let str = data;
            const myArr = str.split("|");
            $('#hasil_scan').show();
            $('#rfid').val(myArr[0]);
            $('#photo').val(myArr[1]);
            $("#getrfid").prop("disabled", false).html(
                'Ambil Data RFID & Foto'
            );
            $('#myfoto').prop("src", myArr[1]);
        }


    });
</script>
<script>
    $(function () {

        $('#example1').DataTable({
            responsive: true
        });
    })
</script>

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

<?php include 'layout/footer.php'; ?>