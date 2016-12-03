<?php
include 'db.php';

$satuan = $db->query("SELECT id,nama_petugas FROM fee_produk ");
while($mm = mysqli_fetch_array($satuan))
{

$barang = $db->query("SELECT id,nama FROM user WHERE nama = '$mm[nama_petugas]' ");
$out = mysqli_num_rows($barang);
$kel = mysqli_fetch_array($barang);


if ($out > 0 )
{
	$update = $db->query("UPDATE fee_produk SET nama_petugas = '$kel[id]' WHERE id = '$mm[id]' ");
}	


}
?>