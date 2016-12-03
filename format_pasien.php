<?php
include 'db.php';
include 'sanitasi.php';


require_once "excel.class.php";
 
#koneksi ke mysql
if ($db->connect_error) {
    die('Connect Error (' . $db->connect_error . ') ');
}
#akhir koneksi

 
$excel = new Excel();
#Send Header
$excel->setHeader('Format Import Data Pasien.xls');
$excel->BOF();

#header tabel
$excel->writeLabel(0, 0, "No RM Lama");
$excel->writeLabel(0, 1, "Nama Lengkap Pasien");
$excel->writeLabel(0, 2, "Tanggal Lahir Pasien (yyyy-mm-dd)");
$excel->writeLabel(0, 3, "Alamat Tinggal Sekarang");
$excel->writeLabel(0, 4, "No Handphone");
$excel->writeLabel(0, 5, "Jenis Kelamin (contoh : Pria/laki-laki | contoh: Wanita/perempuan) bisa pilih salah satunya **note penulisan sesuai dengan yang ada pada contoh! ");

$excel->writeLabel(2, 0, "Option 1 : Gunakan Excell 2007 ");
$excel->writeLabel(3, 0, "Option 2 : Membuat Datanya di Excell Google Drive 'spreadsheets' Setelah Selesai Input Data ");
$excel->writeLabel(4, 1, "Klik File -> Unduh Sebagai");
$excel->writeLabel(5, 1, "Klik Nilai Yang Dipisahkan Koma (.CSV, sheet saat ini)");

 
$excel->EOF();
 
exit();
?>