<?php 
include 'db.php';
include 'sanitasi.php';

$no_reg = stringdoang($_POST['no_reg2']);
$keterangan = stringdoang($_POST['keterangan2']);

$query = $db->query("UPDATE registrasi SET status = 'Rujuk Keluar Klinik Ditangani' , keterangan = '$keterangan' WHERE no_reg = '$no_reg' AND jenis_pasien = 'Rawat Jalan' ");  

header('location:rawat_jalan_lama.php');

 ?>