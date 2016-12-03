<?php
	//memasukkan file db.php
    include 'sanitasi.php';
    include 'db.php';
    // mengirim data, menggunakan metode POST
    $id = stringdoang($_POST['id']);

    // merubah seluruh data yang ada pada tabel user, berdasarkan masing masing kolom
    $query = $db->prepare("UPDATE user SET username = ?, nama = ?, alamat = ?,	jabatan= ?, otoritas = ?, status =?, status_sales = ? , tipe = ?
 	WHERE id = ?");
    
    $query->bind_param("sssssssss",
        $username, $nama, $alamat, $jabatan, $otoritas, $status, $status_sales,$tipe,$id);

        $id = stringdoang($_POST['id']);
        $username = stringdoang($_POST['username']);
        $nama = stringdoang($_POST['nama']);
        $alamat = stringdoang($_POST['alamat']);
        $jabatan = stringdoang($_POST['jabatan']);
        $otoritas = stringdoang($_POST['otoritas']);
        $status = stringdoang($_POST['status']);
        $tipe = stringdoang($_POST['tipe']);
        $status_sales = stringdoang($_POST['status_sales']);

    $query->execute();

if (!$query) 
{
 die('Query Error : '.$db->errno.
 ' - '.$db->error);
}
else 
{
      echo '<META HTTP-EQUIV="Refresh" Content="0; URL=user.php">';
}

//Untuk Memutuskan Koneksi Ke Database
mysqli_close($db);   

?>