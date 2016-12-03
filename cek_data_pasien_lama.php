<?php 
include 'db.php';
include 'sanitasi.php';
$cari = stringdoang($_POST['cari']);


$query = $db->query("SELECT id,kode_pelanggan,nama_pelanggan,jenis_kelamin,alamat_sekarang,tgl_lahir,no_telp,gol_darah,tanggal FROM pelanggan WHERE (kode_pelanggan LIKE '%$cari%' OR nama_pelanggan LIKE '%$cari%' OR alamat_sekarang LIKE '%$cari%') AND kode_pelanggan != '' ");


 ?>
<div class="table-responsive">
 <table id="pasien_lama" class="table">
 	<thead>
 		<tr>
 			<th>NO RM </th>
 			<th>Nama Lengkap</th>
 			<th>Jenis Kelamin</th>
 			<th>Alamat Sekarang </th>
 			<th>Tanggal Lahir </th>
 			<th>No HP</th>
 			<th>Tanggal Terdaftar </th>

 		</tr>
 	</thead>
 	<tbody>
 		<?php
 		while ($data = mysqli_fetch_array($query)) {
 			# code...
 			echo "<tr class='pilih tr-id-".$data['id']."'
 			data-darah='". $data['gol_darah']."'
 			data-no='". $data['kode_pelanggan']."'
         data-nama='".$data['nama_pelanggan']."'
         data-lahir='". tanggal($data['tgl_lahir'])."'
         data-alamat='". $data['alamat_sekarang']."' 
         data-jenis-kelamin='". $data['jenis_kelamin']. "'
         data-hp ='". $data['no_telp']."'
 			><td>".$data['kode_pelanggan']."</td>
 			<td>".$data['nama_pelanggan']."</td>
 			<td>".$data['jenis_kelamin']."</td>
 			<td>".$data['alamat_sekarang']."</td>
 			<td>".tanggal($data['tgl_lahir'])."</td>
 			<td>". $data['no_telp']."</td>
 			<td>".tanggal($data['tanggal'])."</td>
      </tr>
 			";
 		}


 		?>
 	</tbody>
 </table>
 </div>
<script type="text/javascript">
  $(function () {
  $("#pasien_lama").dataTable({"ordering": false});
  });  
</script>
<script type="text/javascript">
$(".delete").click(function(){

  var id = $(this).attr('data-id');

$("#modale-delete").modal('show');
$("#id2").val(id);  

});


</script>


