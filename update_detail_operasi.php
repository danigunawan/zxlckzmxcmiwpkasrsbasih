<?php
include 'sanitasi.php';
include 'db.php';

$query = $db->prepare("UPDATE detail_operasi SET nama_detail_operasi = ?, id_jabatan = ?, jumlah_persentase = ? WHERE id_detail_operasi = ?");

$query->bind_param("ssss",  $nama, $jabatan, $persentase, $id);
	
	$nama = stringdoang($_POST['nama']);
	$jabatan = stringdoang($_POST['jabatan']);
    $persentase = stringdoang($_POST['persentase']);
    $id = stringdoang($_POST['id']);


$query->execute();


    if (!$query) 
    {
    die('Query Error : '.$db->errno.
    ' - '.$db->error);
    }
    else 
    {
    echo "sukses";
    }

    //Untuk Memutuskan Koneksi Ke Database
mysqli_close($db);   
?>