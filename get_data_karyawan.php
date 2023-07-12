<?php
// Koneksi ke database
$db = mysqli_connect('localhost', 'root', '', 'absensi_ta');

// Mengecek apakah request POST dan terdapat data karyawanId
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['karyawanId'])) {
    // Mengambil nilai karyawanId dari request POST
    $karyawanId = $_POST['karyawanId'];

    // Mengeksekusi query untuk mendapatkan data karyawan berdasarkan ID karyawan
    $query = "SELECT id_karyawan, nama, email FROM karyawan WHERE id_karyawan = $karyawanId";
    $result = mysqli_query($db, $query);

    // Mengecek apakah query berhasil dieksekusi
    if ($result) {
        // Mengecek apakah terdapat data karyawan
        if (mysqli_num_rows($result) > 0) {
            // Mengambil data karyawan dari hasil query
            $karyawan = mysqli_fetch_assoc($result);

            // Mengembalikan data karyawan dalam format JSON
            echo json_encode([
                'status' => 'success',
                'id_karyawan' => $karyawan['id_karyawan'],
                'nama' => $karyawan['nama'],
                'email' => $karyawan['email']
            ]);
            exit; // Menghentikan eksekusi kode selanjutnya
        }
    }
}

// Jika terdapat kesalahan atau tidak ditemukan data karyawan, mengembalikan response dengan status error
echo json_encode(['status' => 'error']);
?>
