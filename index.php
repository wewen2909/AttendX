<?php
session_start();

$title = 'Absensi';
include 'layout/header1.php';
require_once('config/app.php');
require_once('config/controller.php');

?>
<section class="content">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="box box-widget">
          <div class="box-header with-border">
            <div class="user-block text-center">
              <h3 class="box-title" id="message-list">
                <div class="callout" style="background-color: #80D2FF;"> <b class="fa fa-address-card"> Tempelkan Kartu Anda. </b> <i class="fa fa-fw fa-camera"></i></div>
              </h3>
            </div>
            <div class="box-body">
              <img class="img-responsive pad" src="http://192.168.1.5:8080/" alt="Photo">
            </div>
            <div class="overlay" id="loading" style="display:none">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include('layout/javascript.php'); ?>
<script>

    function check() {
        $.ajax({
            type: 'GET',
            url: '<?= $path; ?>/text.txt',
            cache: false
        }).done(function (response) {

            var resp = response;
            var mess = '';
            if (resp == 1) {
                $("#loading").hide();
                mess =
                    '<div class="callout bg-green"> <p> Selamat Anda Sudah Absensi :) </p> </div> <audio controls autoplay style="display:none;"><source src="<?= $path; ?>/song/terimakasih.mp3" type="audio/mp3"></audio>';

            } else if (resp == 2) {
                mess =
                    '<div class="callout bg-orange"> <p> Anda Sudah Melakukan Absensi Sebelumnya :) </p> </div>';
            } else if (resp == 3) {
                mess =
                    '<div class="callout bg-red"> <p>  Wajah Tidak Cocok, Silahkan Ulangi </p> </div>';
            } else if (resp == 4) {
                mess =
                    '<div class="callout bg-orange"> <p> Kartu Tidak Terdaftar </p> </div>';
            } else if (resp == 5) {
                mess =
                    '<div class="callout bg-black"> <p> Mohon Tunggu Sebentar </p> </div>';
            } else if (resp == 11) {
                mess =
                    '<div class="callout bg-navy"> <p> Data siap diproses. </p> </div>';
                $("#loading").show();
            } else if (resp == 10) {
                mess =
                    '<div class="callout bg-teal"> <p  class="fa fa-address-card"> PROSES VERIFIKASI. </p> <i class="fa fa-fw fa-camera"></i></div>';

            } else if (resp == 0) {
                mess =
                    '<div class="callout bg-info"> <b class="fa fa-address-card"> Tempelkan Kartu Anda. </b> <i class="fa fa-fw fa-camera"></i></div>';
                $("#loading").hide();
            }

            $('#message-list').html(mess);
            

        });
    function check1() {
        $.ajax({
            type: 'GET',
            url: '<?= $path; ?>/data_absen.php',
            cache: false
        }).done(function (response) {

            $("#data_absen").show();

            $('#data_absen').html(response);

        });
    }
    setInterval(check, 2000);
    setInterval(check1, 1000);
</script>
<?php include 'layout/footer.php'; ?>