<?php include 'session_login.php';
include 'header.php';
include 'navbar.php';
include 'sanitasi.php';
include_once 'db.php';
 ?>

<div class="container">

 <h3>FILTER REKAM MEDIK RAWAT JALAN</h3><hr>

<div class="col-sm-12">
  
<ul class="nav nav-tabs md-pills pills-ins" role="tablist">
      <li class="nav-item"><a class="nav-link " href='rekam_medik_raja.php'> Pencarian Rekam Medik </a></li>
        <li class="nav-item"><a class="nav-link active" href='filter_rekam_medik.php' > Filter Rekam Medik </a></li>
</ul>
<br><br>
</div>

<div class="row">

 	<div class="col-sm-2">
 		<form role="form" action="tampil_rekam_medik.php" id="formcari" method="post">


<div class="form-group">
	<label>Dari Tanggal</label>
	<input style="height: 15px" type="text" id="dari_tanggal" class="form-control" autocomplete="off" name="dari_tanggal">
</div>	

<div class="form-group">
	<label>Sampai Tanggal</label>
	<input style="height: 15px" type="text" id="sampai_tanggal" class="form-control" autocomplete="off" name="sampai_tanggal">
</div>	



<div class="form-group">
	<label>Cari Berdasarkan :</label>
	 <select id="cari_berdasarkan" class="form-control" autocomplete="off" name="cari_berdasarkan">
		<option value="">Silakan Pilih </option>
		<option value="no_rm">No RM</option>
		<option value="nama">Nama</option>
	</select> 
</div>	

<div class="form-group">
	<label>Pencarian</label>
	<input style="height: 15px" type="text" id="pencarian" autocomplete="off" class="form-control" name="pencarian">
</div>	

<button type="submit" class="btn btn-info" id="submit" > <i class="fa fa-search"></i>  Cari</button>
<br>
<br>

</form>
<br>

 </div><!-- akhir div col-sm-3 form data pasien -->
 <div class="col-sm-10">
   
<span id="result">
  <br>

<div class="table-responsive">
 <table id="table-group" class="table table-bordered"> 
    <thead>
      <tr>

         <th>No Reg </th>
         <th>Nama Pasien</th>
         <th>Tanggal Periksa</th>
         <th>Nama Dokter</th>
         <th>Poli</th>

    </tr>
    </thead>
    <tbody>
  
  </tbody>
 </table>
</div>
 </span>


<span id="result1">


</span>

 </div>

 	




</div><!-- akhir container -->

<script>
  $(document).ready(function() {
  $( "#sampai_tanggal" ).pickadate({ selectYears: 100, format: 'yyyy-mm-dd'});
  });
  </script>
<!--end script datepicker-->

<script>
  $(document).ready(function() {
  $( "#dari_tanggal" ).pickadate({ selectYears: 100, format: 'yyyy-mm-dd'});
  });
  </script>
<!--end script datepicker-->


<!--   datatable  -->
 <script type="text/javascript">

  $(document).ready(function () {
  $("#table-group").dataTable();
  });
  </script>
<!--   end table  -->

<!-- modal form caeri  -->
<script type="text/javascript">

$("#submit").click(function() {
    $.post($("#formcari").attr("action"), $("#formcari :input").serializeArray(), function(info) { $("#result").html(info); });
    clearInput();
});

$("#formcari").submit(function(){
    return false;
});

function clearInput(){
    $("#formcari :input").each(function(){
        $(this).val('');
    });
};
</script>
<!-- end modal form cari  -->



<!-- modal tampil rm  -->
<script type="text/javascript">
//            jika dipilih, nim akan masuk ke input dan modal di tutup
            $(document).on('click', '.rekam-medik', function (e) {
                var id = $(this).attr('data-no');

               $.post("tampil-data-rekam-medik.php",{id:id},function(info){
               	$("#result1").html(info);

               });
            });
      
</script>
<!--  end mdoal RM -->

<?php 
include 'footer.php';
 ?>