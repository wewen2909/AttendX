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

$title = 'Dashboard';

include 'layout/header.php';

// Query untuk menghitung jumlah Divisi
$query = "SELECT COUNT(*) as total_divisi FROM divisi";
$result = mysqli_query($db, $query);

// Periksa apakah query berhasil
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDivisi = $row['total_divisi'];
} else {
    // Handle jika terjadi kesalahan saat menjalankan query
    $totalDivisi = 0;
}

// Query untuk menghitung jumlah karyawan
$query = "SELECT COUNT(*) as total_karyawan FROM karyawan";
$result = mysqli_query($db, $query);

// Periksa apakah query berhasil
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalKaryawan = $row['total_karyawan'];
} else {
    // Handle jika terjadi kesalahan saat menjalankan query
    $totalKaryawan = 0;
}


// Query untuk menghitung jumlah Akun
$query = "SELECT COUNT(*) as total_akun FROM akun";
$result = mysqli_query($db, $query);

// Periksa apakah query berhasil
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalAkun = $row['total_akun'];
} else {
    // Handle jika terjadi kesalahan saat menjalankan query
    $totalKaryawan = 0;
}
?>

<div class="container mt-5">
    <h1><i class="fas fa-tachometer-alt mx-2"></i>Dashboard</h1>
    <hr>

    <div class="row text-white">
        <div class="card bg-info mx-3 my-3" style="width: 18rem;">
            <div class="card-body">
                <div class="card-body-icon ">
                    <i class="fas fa-building mx-4"></i>
                </div>
                <h5 class="card-title">Jumlah Divisi</h5>
                <div class="display-4"><?php echo $totalDivisi;?></div>
                <a href="divisi.php" class="card-text text-white no-underline">Lihat Detail <i
                        class="fas fa-angle-double-right ml-2"></i></a>
            </div>
        </div>

        <div class="card bg-success mx-3 my-3" style="width: 18rem;">
            <div class="card-body">
                <div class="card-body-icon ">
                    <i class="fas fa-users mx-4"></i>
                </div>
                <h5 class="card-title">Jumlah Karyawan</h5>
                <div class="display-4"><?php echo $totalKaryawan;?></div>
                <a href="karyawan.php" class="card-text text-white no-underline">Lihat Detail <i
                        class="fas fa-angle-double-right ml-2"></i></a>
            </div>
        </div>

        <div class="card bg-danger mx-3 my-3" style="width: 18rem;">
            <div class="card-body">
                <div class="card-body-icon ">
                <i class="fas fa-user-circle mx-4"></i>
                </div>
                <h5 class="card-title">Jumlah Akun</h5>
                <div class="display-4"><?php echo $totalAkun;?></div>
                <a href="akun.php" class="card-text text-white no-underline">Lihat Detail <i
                        class="fas fa-angle-double-right ml-2"></i></a>
            </div>
        </div>

    </div>
</div>


<?php include 'layout/footer.php'; ?>