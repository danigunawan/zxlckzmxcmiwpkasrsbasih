<?php 
include 'db.php';
include 'sanitasi.php';

$no_reg = stringdoang($_POST['no_reg12']);
$keterangan = stringdoang($_POST['keterangan12']);

$query = $db->query("UPDATE registrasi SET status = 'Rujuk Keluar Klinik Tidak Ditangani' , keterangan = '$keterangan' WHERE no_reg = '$no_reg' AND jenis_pasien = 'Rawat Jalan' ");

$query_del = "DELETE FROM rekam_medik WHERE no_reg = '$no_reg'";
if ($db->query($query_del) === TRUE) {
    
} 
else {
    echo "Error: " . $query_del . "<br>" . $db->error;
     }

header('location:registrasi_raja.php');


 ?>`