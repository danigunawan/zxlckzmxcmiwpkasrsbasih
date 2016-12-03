<?php 
include 'db.php';
include 'sanitasi.php';
$cari = stringdoang($_POST['cari']);


$query = $db->query("SELECT penjamin,kode_pelanggan,nama_pelanggan,jenis_kelamin,alamat_sekarang,tgl_lahir,no_telp,gol_darah FROM pelanggan WHERE (kode_pelanggan LIKE '%$cari%' OR nama_pelanggan LIKE '%$cari%' OR alamat_sekarang LIKE '%$cari%') AND kode_pelanggan != '' ");


 ?>

<style>

tr:nth-child(even){background-color: #f2f2f2}

</style>

 <table id="pasien_lama" class="table table-bordered">
 	<thead>
 		<tr>
 			<th style='background-color: #4CAF50; color: white' >No. RM </th>
 			<th style='background-color: #4CAF50; color: white' >Nama Lengkap</th>
 			<th style='background-color: #4CAF50; color: white' >Jenis Kelamin</th>
 			<th style='background-color: #4CAF50; color: white' >Alamat Sekarang </th>
 			<th style='background-color: #4CAF50; color: white' >Tanggal Lahir </th>

 		</tr>
 	</thead>
 	<tbody>
 		<?php
 		while ($data = mysqli_fetch_array($query)) {
 			# code...
 			echo "<tr class='pilih'
				data-darah='". $data['gol_darah']."'
				data-no='". $data['kode_pelanggan']."'
				data-nama='".$data['nama_pelanggan']."'
				data-lahir='". tanggal($data['tgl_lahir'])."'
				data-alamat='". $data['alamat_sekarang']."' 
				data-jenis-kelamin='". $data['jenis_kelamin']. "'
				data-hp ='". $data['no_telp']."'
				data-penjamin ='". $data['penjamin']."'>

				<td>".$data['kode_pelanggan']."</td>
				<td>".$data['nama_pelanggan']."</td>
				<td>".$data['jenis_kelamin']."</td>
				<td>".$data['alamat_sekarang']."</td>
				<td>".$data['tgl_lahir']."</td></tr>";
 		}


 		?>
 	</tbody>
 </table>
<script type="text/javascript">
  $(function () {
  $("#pasien_lama").dataTable({"ordering": false});
  });  
</script>


