<?php 
include 'db.php';
include 'sanitasi.php';
$cari = stringdoang($_POST['cari']);


$query = $db->query("SELECT no_rm_lama,nama_pelanggan,jenis_kelamin,alamat_sekarang,tgl_lahir,no_telp FROM pelanggan 
				WHERE (kode_pelanggan LIKE '%$cari%' OR nama_pelanggan LIKE '%$cari%' OR alamat_sekarang LIKE '%$cari%') AND (kode_pelanggan IS NULL OR kode_pelanggan = '') ");


 ?>

<div class="table-responsive">
 <table class="table" id="tableer">
 	<thead>
 		<tr>
 			<th>No. RM Lama</th>
 			<th>Nama Lengkap</th>
 			<th>Jenis Kelamin</th>
 			<th>Alamat Sekarang </th>
 			<th>Tanggal Lahir</th>
 		</tr>
 	</thead>
 	<tbody>
 		<?php
 		while ($data = mysqli_fetch_array($query)) 
 		{
 			# code...
				echo "<tr class='pilih'
				data-no='". $data['no_rm_lama']."'
				data-nama='".$data['nama_pelanggan']."'
				data-lahir='". tanggal($data['tgl_lahir'])."'
				data-alamat='". $data['alamat_sekarang']."' 
				data-jenis-kelamin='". $data['jenis_kelamin']. "'
				data-hp ='". $data['no_telp']."'
 			><td>".$data['no_rm_lama']."</td>
 			<td>".$data['nama_pelanggan']."</td>
 			<td>".$data['jenis_kelamin']."</td>
 			<td>".$data['alamat_sekarang']."</td>
 			<td>".$data['tgl_lahir']."</td></tr>";
 		}
?>
 	</tbody>
 </table>
 </div>

 <br>
 <br>

<script type="text/javascript">
  $(function () {
  $("#tableer").dataTable({"ordering": false});
  });  
</script>
