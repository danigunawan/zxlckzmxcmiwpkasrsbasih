<?php include 'session_login.php';


//memasukkan file session login, header, navbar, db.php
include 'header.php';
include 'navbar.php';
include 'sanitasi.php';
include 'db.php';


$dari_tanggal = stringdoang($_POST['dari_tanggal']);
$sampai_tanggal = stringdoang($_POST['sampai_tanggal']);
//menampilkan seluruh data yang ada pada tabel penjualan
$perintah = $db->query("SELECT * FROM item_masuk WHERE  tanggal >= '$dari_tanggal' AND tanggal <= '$sampai_tanggal'");




 ?>


<style>
tr:nth-child(even){background-color: #f2f2f2}
</style>

<div class="container"><!--start of container-->

<h3><b><center> Data Item Masuk Dari <?php echo $dari_tanggal; ?> s/d <?php echo $sampai_tanggal; ?></center></b></h3><hr>

<!--membuat link-->

<?php
include 'db.php';

$pilih_akses_item_masuk = $db->query("SELECT * FROM otoritas_item_masuk WHERE id_otoritas = '$_SESSION[otoritas_id]'");
$item_masuk = mysqli_fetch_array($pilih_akses_item_masuk);

if ($item_masuk['item_masuk_tambah'] > 0) {

echo '<a href="form_item_masuk.php" id="tambah_item" class="btn btn-info"> <i class="fa fa-plus"> </i> ITEM MASUK</a>';

}

?>
<br>
<button type="submit" name="submit" id="filter_1" class="btn btn-primary" > Filter Faktur </button>
<button type="submit" name="submit" id="filter_2" class="btn btn-primary" > Filter Detail </button>


<!--START FILTER FAKTUR-->
<span id="fil_faktur">
<form class="form-inline" action="show_filter_item_masuk.php" method="post" role="form">
          
          <div class="form-group"> 
          
          <input type="text" name="dari_tanggal" id="dari_tanggal" class="form-control" placeholder="Dari Tanggal" required="">
          </div>
          
          <div class="form-group"> 
          
          <input type="text" name="sampai_tanggal" id="sampai_tanggal" class="form-control" placeholder="Sampai Tanggal" value="<?php echo date("Y-m-d"); ?>" required="">
          </div>
          
          <button type="submit" name="submit" id="submit_filter_1" class="btn btn-success" ><i class="fa fa-eye"> </i> Lihat Faktur</button>

          
</form>
<span id="result"></span>  
</span>
<!--END FILTER FAKTUR-->

<!--START FILTER DETAIl-->
<span id="fil_detail">
<form class="form-inline" action="show_filter_item_masuk_detail.php" method="post" role="form">
          
          <div class="form-group"> 
          
          <input type="text" name="dari_tanggal" id="dari_tanggal2" class="form-control" placeholder="Dari Tanggal" required="">
          </div>
          
          <div class="form-group"> 
          
          <input type="text" name="sampai_tanggal" id="sampai_tanggal2" class="form-control" placeholder="Sampai Tanggal" value="<?php echo date("Y-m-d"); ?>" required="">
          </div>
          
          <button type="submit" name="submit" id="submit_filter_2"  class="btn btn-success" ><i class="fa fa-eye"> </i> Lihat Detail </button>

          
</form>
<span id="result"></span>  
</span>
<!--END FILTER DETAIl-->

<div id="modal_alert" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 style="color:orange" class="modal-title"><span class="glyphicon glyphicon-info-sign">Info</span></h3>
        
      </div>

      <div class="modal-body">
      <div class="table-responsive">
      <span id="modal-alert">
       </span>
      </div>

     </div>

      <div class="modal-footer">
        
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal Hapus data -->
<div id="modal_hapus" class="modal fade" role="dialog">
  <div class="modal-dialog">



    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Konfirmasi Hapus Data Item Masuk</h4>
      </div>

      <div class="modal-body">
   
   <p>Apakah Anda yakin Ingin Menghapus Data ini ?</p>
   <form >
    <div class="form-group">
    <label> Nomor Faktur :</label>
     <input type="text" id="data_faktur" class="form-control" readonly="">
    
    </div>
   
   </form>
   
  <div class="alert alert-success" style="display:none">
   <strong>Berhasil!</strong> Data berhasil Di Hapus
  </div>
 

     </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-id="" id="btn_jadi_hapus"> <span class='glyphicon glyphicon-ok-sign'> </span> Ya</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal"> <span class='glyphicon glyphicon-remove-sign'> </span> Batal</button>
      </div>
    </div>

  </div>
</div><!-- end of modal hapus data  -->

<div id="modal_detail" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detail Item Masuk </h4>
      </div>

      <div class="modal-body">
      <div class="table-responsive">
      <span id="modal-detail"> </span>
      </div>

     </div>

      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<style>
tr:nth-child(even){background-color: #f2f2f2}
</style>


<div class="table-responsive"><!--membuat agar ada garis pada tabel disetiap kolom-->
<span id="tabel_baru">
<table id="tableuser" class="table table-bordered">
		<thead>
			<th style='background-color: #4CAF50; color:white'> Nomor Faktur </th>
			<th style='background-color: #4CAF50; color:white'> Tanggal </th>
			<th style='background-color: #4CAF50; color:white'> Jam </th>
			<th style='background-color: #4CAF50; color:white'> User </th>
			<th style='background-color: #4CAF50; color:white'> User Edit </th>
			<th style='background-color: #4CAF50; color:white'> Tanggal Edit </th>
			<th style='background-color: #4CAF50; color:white'> Keterangan </th>
			<th style='background-color: #4CAF50; color:white'> Total </th>
			<th style='background-color: #4CAF50; color:white'> Detail </th>

<?php
if ($item_masuk['item_masuk_edit'] > 0) {

				echo "<th style='background-color: #4CAF50; color:white'> Edit </th>";

			}
?>

<?php
if ($item_masuk['item_masuk_hapus'] > 0) {
			echo "<th style='background-color: #4CAF50; color:white'> Hapus </th>";
		}
 ?>
			

			
			
		</thead>
		
		<tbody>
		<?php

			//menyimpan data sementara yang ada pada $perintah
			while ($data1 = mysqli_fetch_array($perintah))
			{
				//menampilkan data
			echo "<tr class='tr-id-".$data1['id']."'>
			<td>". $data1['no_faktur'] ."</td>
			<td>". $data1['tanggal'] ."</td>
			<td>". $data1['jam'] ."</td>
			<td>". $data1['user'] ."</td>
			<td>". $data1['user_edit'] ."</td>
			<td>". $data1['tanggal_edit'] ."</td>
			<td>". $data1['keterangan'] ."</td>
			<td>". rp($data1['total']) ."</td>


			<td> <button class='btn btn-info detail' no_faktur='". $data1['no_faktur'] ."' ><span class='glyphicon glyphicon-th-list'></span> Detail </button> </td>";

if ($item_masuk['item_masuk_edit'] > 0) {
			 	echo "<td> <a href='proses_edit_item_masuk.php?no_faktur=". $data1['no_faktur']."' class='btn btn-success'> <span class='glyphicon glyphicon-edit'></span> Edit </a> </td>";
			 }


if ($item_masuk['item_masuk_tambah'] > 0) {

$hpp_keluar = $db->query ("SELECT no_faktur FROM hpp_keluar WHERE no_faktur_hpp_masuk = '$data1[no_faktur]'");
$row_hpp_keluar = mysqli_num_rows($hpp_keluar);

		
		if ($row_hpp_keluar > 0 ) 
		{

			echo"<td> <button class='btn btn-danger btn-alert' data-faktur='". $data1['no_faktur'] ."'> <span class='glyphicon glyphicon-trash'> </span> Hapus </button> </td>";

		} 

		else
		{

			echo"<td> <button class='btn btn-danger btn-hapus' data-id='".$data1['id']."' data-item='". $data1['no_faktur'] ."'> <span class='glyphicon glyphicon-trash'> </span> Hapus </button> </td>";			
		
		}
			
			echo "</tr>";
			}
	
}

//Untuk Memutuskan Koneksi Ke Database
mysqli_close($db);   
		?>
		</tbody>

	</table>
</span>
</div>
<br>
	<button type="submit" id="submit_close" class="glyphicon glyphicon-remove btn btn-danger" style="display:none"></button> 
		<span id="demo"> </span>
</div><!--end of container-->
		

		<!--menampilkan detail penjualan-->
		<script>
		
		$(document).ready(function(){
		$('#tableuser').DataTable();
		});
		
		
		$(".detail").click(function(){
		var no_faktur = $(this).attr('no_faktur');
		
		
		$("#modal_detail").modal('show');
		
		$.post('detail_item_masuk.php',{no_faktur:no_faktur},function(info) {
		
		$("#modal-detail").html(info);
		
		
		});
		
		});
		
		</script>

		<script>
			
	//fungsi hapus data 
		$(".btn-hapus").click(function(){
		var nama_item = $(this).attr("data-item");
		var id = $(this).attr("data-id");
		$("#data_faktur").val(nama_item);
		$("#modal_hapus").modal('show');
		$("#btn_jadi_hapus").attr("data-id", id);


		
		
		});


		$("#btn_jadi_hapus").click(function(){
		
		var no_faktur = $("#data_faktur").val();
		var id = $(this).attr("data-id");


		$.post("hapus_item_masuk.php",{no_faktur:no_faktur},function(data){
		

		
		$("#modal_hapus").modal('hide');
		$(".tr-id-"+id).remove();
		

		});
		
		});
// end fungsi hapus data

		</script>


<script type="text/javascript">
	$(document).on('click', '.btn-alert', function (e) {
			var no_faktur = $(this).attr("data-faktur");
						
			$.post('modal_alert_hapus_data_item_masuk.php',{no_faktur:no_faktur},function(data){


			$("#modal_alert").modal('show');
			$("#modal-alert").html(data);

			});
	});
</script>

<!--============-->
<script>
    $(function() {
    $( "#dari_tanggal" ).datepicker({dateFormat: "yy-mm-dd"});
    });
    </script>


    <script>
    $(function() {
    $( "#sampai_tanggal" ).datepicker({dateFormat: "yy-mm-dd"});
    });
    </script>

    <script>
    $(function() {
    $( "#dari_tanggal2" ).datepicker({dateFormat: "yy-mm-dd"});
    });
    </script>


    <script>
    $(function() {
    $( "#sampai_tanggal2" ).datepicker({dateFormat: "yy-mm-dd"});
    });
    </script>


<script type="text/javascript">
    $(document).ready(function(){
      $("#fil_faktur").hide();
      $("#fil_detail").hide();
  });
</script>


<script type="text/javascript">
    $(document).ready(function(){
        $("#filter_1").click(function(){    
      $("#fil_faktur").show();
      $("#filter_2").show();
      $("#filter_1").hide();  
      $("#fil_detail").hide();
      });

        $("#filter_2").click(function(){    
      $("#fil_detail").show();  
      $("#fil_faktur").hide();
      $("#filter_2").hide();
      $("#filter_1").show();
      });

  });

</script>
<?php 
include 'footer.php';
 ?>