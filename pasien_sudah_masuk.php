<?php include 'session_login.php';
include 'header.php';
include 'navbar.php';
include 'db.php';
include_once 'sanitasi.php';

$tanggal = date("Y-m-d");


$query7 = $db->query("SELECT * FROM registrasi WHERE (jenis_pasien = 'Rawat Jalan' AND  status = 'Proses' AND tanggal = '$tanggal') ORDER BY id ASC");




?>

<style>
.disable1
{
background-color:#cccccc;
opacity: 0.9;
    cursor: not-allowed;
}
.disable2
{
background-color: #cccccc;
opacity: 0.9;
    cursor: not-allowed;
}
.disable3
{
background-color: #cccccc;
opacity: 0.9;
    cursor: not-allowed;
}
.disable4
{
background-color: #cccccc;
opacity: 0.9;
    cursor: not-allowed;
}
.disable5
{
background-color: #cccccc;
opacity: 0.9;
    cursor: not-allowed;
}
.disable6
{
background-color: #cccccc;
opacity: 0.9;
    cursor: not-allowed;
}

</style>

<!-- Modal Untuk Confirm rUJUKAN KE RAWAT INAP-->
<div id="modal_rujuk_ri" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>       
    </div>
    <div class="modal-body">
      <span id="tampil_rujuk_inap">
      </span>
    </div>
    <div class="modal-footer">    
       <center><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Closed</button></center>
    </div>
    </div>
  </div>
</div>
<!--modal end Layanan RUJUK KE RAWAT INAP--> 

<!-- Modal Untuk Confirm rujuk KE LUAR RS WITH PENANGANAN-->
<div id="detail" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>       
    </div>
    <div class="modal-body">

      <span id="tampil_layanan">

      <h3>Keterangan Rujuk Rawat Jalan Dengan Penanganan</h3>
<form role="form" action="proses_keterangan_rujuk.php" method="POST">

<div class="form-group">
  <textarea type="text" class="form-control" id="keterangan2" name="keterangan2"></textarea>
</div>

<input type="hidden" class="form-control" id="no_reg2" name="no_reg2" >

<button type="submit" class="btn btn-info"><i class='fa fa-plus'></i>Input Keterangan</button>
</form>

      </span>
    </div>
    <div class="modal-footer">       
        <button type="button" accesskey="e" class="btn btn-danger" data-dismiss="modal">Clos<u>e</u>d</button>
    </div>
    </div>
  </div>
</div>
<!--modal end RUJUK LUAR RS WITH PENANGANAN-->



<!-- Modal Untuk Confirm rujuk KE LUAR RS TANPA PENANGANAN-->
<div id="detail_non" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>       
    </div>
    <div class="modal-body">

      <span id="tampil_layanan">

      <h3>Keterangan Rujuk Rawat Jalan Tanpa Penanganan</h3>
<form role="form" action="proses_keterangan_rujuk_non.php" method="POST">

<div class="form-group">
  <textarea type="text" class="form-control" id="keterangan12" name="keterangan12"></textarea>
  <input type="hidden" class="form-control" id="no_reg12" name="no_reg12" >

</div>


<button type="submit" class="btn btn-info">Input Keterangan</button>
</form>

      </span>
    </div>
    <div class="modal-footer">       
        <button type="button" accesskey="e" class="btn btn-danger" data-dismiss="modal">Clos<u>e</u>d</button>
    </div>
    </div>
  </div>
</div>
<!--modal end RUJUK LUAR RS TANPA PENANGANAN-->

<!-- Modal Untuk Confirm BATAL RAWAT-->
<div id="detail2" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>       
    </div>
    <div class="modal-body">

      <span id="tampil_layanan">

      <h1>Keterangan Batal Rawat Jalan</h1>
<form role="form" action="proses_keterangan_batal.php" method="POST">
<div class="form-group">
  <label for="sel1">Keterangan Batal </label>
  <textarea type="text" class="form-control" id="keterangan" name="keterangan"></textarea>
</div>

<input type="hidden" class="form-control" id="no_reg" name="no_reg" >

<button type="submit" class="btn btn-info">Input Keterangan</button>
</form>

      </span>
    </div>
    <div class="modal-footer">
        
        <button type="button" accesskey="e" class="btn btn-danger" data-dismiss="modal">Clos<u>e</u>d</button>
    </div>
    </div>
  </div>
</div>
<!--modal end BATAL RAWAT-->

<div class="container">
<ul class="nav nav-tabs yellow darken-4" role="tablist">
        <li class="nav-item"><a class="nav-link" href='registrasi_raja.php'> Antrian Pasien Rawat Jalan </a></li>
        <li class="nav-item"><a class="nav-link" href='pasien_sudah_panggil.php' > Pasien Sudah Dipanggil </a></li>
        <li class="nav-item"><a class="nav-link  active" href='pasien_sudah_masuk.php' > Pasien Sudah Masuk R.Dokter </a></li>
        <li class="nav-item"><a class="nav-link" href='pasien_batal_rujuk.php' > Pasien Batal / Rujuk Ke Luar </a></li>
</ul>
<br><br>


<style>

tr:nth-child(even){background-color: #f2f2f2}

</style>

<!-- PEMBUKA DATA TABLE -->

<span id="tabel-jalan">
<div class="table-responsive">
<table id="table_rawat_jalan" class="table table-bordered">
    <thead>
      <tr>
             <th style='background-color: #4CAF50; color: white' >No REG</th>
             <th style='background-color: #4CAF50; color: white' >No RM </th>
             <th style='background-color: #4CAF50; color: white' >Tanggal</th>       
             <th style='background-color: #4CAF50; color: white' >Nama Pasien</th>
             <th style='background-color: #4CAF50; color: white' >Penjamin</th>
             <th style='background-color: #4CAF50; color: white' >Umur</th>
             <th style='background-color: #4CAF50; color: white' >Jenis Kelamin</th>
             <th style='background-color: #4CAF50; color: white' >Keterangan</th>
             <th style='background-color: #4CAF50; color: white' >Dokter</th>
             <th style='background-color: #4CAF50; color: white' >Poli</th>               
             <th style='background-color: #4CAF50; color: white' >No Urut</th>
             <th style='background-color: #4CAF50; color: white' >Rujuk Dengan Penangan</th>
             <th style='background-color: #4CAF50; color: white' >Rujuk Tanpa Penanganan </th>
             <th style='background-color: #4CAF50; color: white' >Rujuk Rawat Inap</th>
             <th style='background-color: #4CAF50; color: white' >Batal</th>            
    </tr>
    </thead>
    <tbody>
    
   <?php while($data = mysqli_fetch_array($query7))
      
      {
      echo "<tr  class=''  >
          <td>". $data['no_reg']."</td>
          <td>". $data['no_rm']."</td>
          <td>". tanggal($data['tanggal'])."</td>              
          <td>". $data['nama_pasien']."</td>
          <td>". $data['penjamin']."</td>
          <td>". $data['umur_pasien']."</td>
          <td>". $data['jenis_kelamin']."</td>
          <td>". $data['keterangan']."</td>
          <td>". $data['dokter']."</td>
          <td>". $data['poli']."</td>
          <td>". $data['no_urut']."</td>
  <td><button class='btn btn-floating btn-small btn-primary pilih1' data-id='". $data['no_reg']."' ><i class='fa fa-bus '></button></td>

 <td><button class='btn btn-floating btn-small btn-succcess pilih12' data-id='". $data['no_reg']."'><i class='fa fa-cab'></button></td>

  <td> <button class='btn btn-floating btn-small btn-info rujuk_ri' data-reg='".$data['no_reg']."'><i class='fa fa-hotel'></button></td>

  <td><button class='btn btn-floating btn-small btn-danger pilih2' data-id='". $data['no_reg']."'><i class='fa fa-refresh'></button></td>";
      echo "</tr>";
      
      }
    ?>
  </tbody>
 </table>
</div><!--div responsive-->
 <!-- AKHIR TABLE -->





</span>

</div> <!--container-->
<script>
    
    $(document).ready(function(){
    $('#table_rawat_jalan').DataTable(
      {"ordering": false});
    });
</script>

<!-- cari untuk pegy natio -->
<script type="text/javascript">
  $("#cari").keyup(function(){
var q = $(this).val();

$.post('table_baru_sudah_masuk.php',{q:q},function(data)
{
  $("#tabel-jalan").html(data);
  
});
});
</script>
<!-- END script cari untuk pegy natio -->

<!--   script untuk detail layanan PERUSAHAAN PENJAMIN-->
<script type="text/javascript">
     $(".pilih1").click(function() 
{   
    var id = $(this).attr('data-id');

               $("#detail").modal('show');
          $("#no_reg2").val(id);

            });
//            tabel lookup mahasiswa         
</script>
<!--  end script untuk akhir detail layanan PERUSAHAAN -->


<!--   script untuk detail layanan PERUSAHAAN PENJAMIN-->
<script type="text/javascript">
     $(".pilih12").click(function() 
{   
    var id = $(this).attr('data-id');

               $("#detail_non").modal('show');
          $("#no_reg12").val(id);

            });
//            tabel lookup mahasiswa         
</script>
<!--  end script untuk akhir detail layanan PERUSAHAAN -->

<!--   script untuk detail layanan PERUSAHAAN PENJAMIN-->
<script type="text/javascript">
     $(".pilih2").click(function() 
{   
    var id = $(this).attr('data-id');

               $("#detail2").modal('show');
          $("#no_reg").val(id);

            });
//            tabel lookup mahasiswa         
</script>
<!--  end script untuk akhir detail layanan PERUSAHAAN -->


<!--   script untuk detail layanan MERUJUK-->
<script type="text/javascript">
     $(".rujuk_ri").click(function() 
{   
            var reg = $(this).attr('data-reg');
         
                $.post("rujuk_ri_ugd.php",{reg:reg},function(data){
                    $("#tampil_rujuk_inap").html(data);
               $("#modal_rujuk_ri").modal('show');
          
                });
            });
//            tabel lookup mahasiswa         
</script>
<!--  end script untuk akhir detail RUJUK-->

<!--footer -->
<?php
 include 'footer.php';
?>   
<!--end footer-->



















