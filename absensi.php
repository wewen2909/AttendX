<?php
session_start();
include 'layout/header.php';
?>

<section class="content">

    <div class="row">

        <div class="col-md-6">
            <div class="box box-widget">
                <div class="box-header with-border">
                    <div class="user-block  text-center">

                        <h3 class="box-title" id="message-list">
                            <div class="callout bg-info"> <b class="fa fa-address-card"> Tempelkan Kartu
                                    Anda. </b> <i class="fa fa-fw fa-camera"></i></div>
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
            <div class="col-md-3">
</section>
<?php include 'layout/footer.php'; ?>