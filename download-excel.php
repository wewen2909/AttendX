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

require 'config/app.php';

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A2', 'No');
$sheet->setCellValue('B2', 'Id absensi');
$sheet->setCellValue('C2', 'RFID');
$sheet->setCellValue('D2', 'Foto');
$sheet->setCellValue('E2', 'Jam datang');
$sheet->setCellValue('F2', 'Jam pulang');

$data_absensi = select("SELECT * FROM absensi");


$no = 1;
$start = 3;


foreach ($data_absensi as $absensi){
    $sheet->setCellValue('A' . $start, $no++)->getColumnDimension('A')->setAutoSize(true);
    $sheet->setCellValue('B' . $start, $absensi['id_absensi'])->getColumnDimension('B')->setAutoSize(true);
    $sheet->setCellValue('C' . $start, $absensi['rfid'])->getColumnDimension('C')->setAutoSize(true);
    $sheet->setCellValue('D' . $start, 'http://localhost/absensi_ta/assets/img/'. $absensi['foto'])->getColumnDimension('D')->setAutoSize(true);
    $sheet->setCellValue('E' . $start, $absensi['jam_datang'])->getColumnDimension('E')->setAutoSize(true);
    $sheet->setCellValue('F' . $start, $absensi['jam_pulang'])->getColumnDimension('F')->setAutoSize(true);
  
    $start++;
}

//Table border
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            // 'color' => ['argb' => 'FFFF0000'],
        ],
    ],
];

$border = $start - 1 ;

$sheet->getStyle('A2:F2'.$border)->applyFromArray($styleArray);


$writer = new Xlsx($spreadsheet);
$filename = 'Laporan Rekap Absensi.xlsx';
$writer->save($filename);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Laporan Rekap Absensi.xlsx"');
header('Cache-Control: max-age=0');
readfile('Laporan Rekap Absensi.xlsx');
unlink('Laporan Rekap Absensi.xlsx');

// $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
// $writer->save('php://output');
exit;  
