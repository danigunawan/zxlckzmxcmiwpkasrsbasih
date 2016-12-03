<?php include 'session_login.php';
include 'header.php';
include 'navbar.php';
include 'db.php';
include_once 'sanitasi.php';

$tanggal = date("Y-m-d");


$query7 = $db->query("SELECT * FROM registrasi WHERE (jenis_pasien = 'Rawat Jalan' AND  status = 'Proses') OR status = 'Rujuk Keluar Ditangani' ORDER BY id ASC");

$pilih_akses_penjualan = $db->query("SELECT penjualan_tambah FROM otoritas_penjualan WHERE id_otoritas = '$_SESSION[otoritas_id]'");
$penjualan = mysqli_fetch_array($pilih_akses_penjualan);

$pilih_akses_rekam_medik = $db->query("SELECT rekam_medik_rj_lihat FROM otoritas_rekam_medik WHERE id_otoritas = '$_SESSION[otoritas_id]'");
$rekam_medik = mysqli_fetch_array($pilih_akses_rekam_medik);

$pilih_akses_registrasi_rj = $db->query("SELECT registrasi_rj_lihat, registrasi_rj_tambah, registrasi_rj_edit, registrasi_rj_hapus FROM otoritas_registrasi WHERE id_otoritas = '$_SESSION[otoritas_id]'");
$registrasi_rj = mysqli_fetch_array($pilih_akses_registrasi_rj);



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
<div id="rujuk_penanganan" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>       
    </div>
    <div class="modal-body">

      <span id="tampil_layanan">

<h3>Keterangan Rujuk Rawat Jalan Dengan Penanganan</h3>
<form role="form" action="proses_keterangan_rujuk" method="POST">

<div class="form-group">
  <textarea type="text" class="form-control" id="keterangan2" name="keterangan2"></textarea>
</div>


<button type="submit" id="submit_rujuk_penanganan" data-id="" data-reg="" class="btn btn-info"><i class='fa fa-plus'></i>Input Keterangan</button>
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
<div id="rujuk_non_penanganan" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>       
    </div>
    <div class="modal-body">

      <span id="tampil_layanan">

      <h3>Keterangan Rujuk Rawat Jalan Tanpa Penanganan</h3>
<form role="form" method="POST">

<div class="form-group">
  <textarea type="text" class="form-control" id="keterangan12" name="keterangan12"></textarea>

</div>


<button type="submit" id="submit_rujuk_non_penanganan" data-id="" data-reg="" class="btn btn-info">Input Keterangan</button>
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
<form role="form" method="POST">
<div class="form-group">
  <label for="sel1">Keterangan Batal </label>
  <textarea type="text" class="form-control" id="keterangan_batal" name="keterangan"></textarea>
</div>


<button type="submit" class="btn btn-info" id="batal_jalan" data-id="" data-reg="">Input Keterangan</button>
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

<div style="padding-left: 5%; padding-right: 5%">

<h3>DATA PASIEN REGISTRASI RAWAT JALAN</h3><hr>

<ul class="nav nav-tabs yellow darken-4" role="tablist">
        <li class="nav-item"><a class="nav-link" href='registrasi_raja.php'> Antrian Pasien R. Jalan </a></li>
        <li class="nav-item"><a class="nav-link" href='pasien_sudah_panggil.php' > Pasien Dipanggil </a></li>
        <li class="nav-item"><a class="nav-link active" href='pasien_sudah_masuk.php' > Pasien Masuk R.Dokter </a></li>
        <li class="nav-item"><a class="nav-link" href='pasien_batal_rujuk.php' > Pasien Batal / Rujuk Ke Luar </a></li>
        <li class="nav-item"><a class="nav-link" href='pasien_registrasi_rj_belum_selesai.php' >Pasien Belum Selesai Pembayaran </a></li>
</ul>
<br><br>


<style>

tr:nth-child(even){background-color: #f2f2f2}

</style>

<!-- PEMBUKA DATA TABLE -->

<span id="tabel-jalan">
<div class="table-responsive">
<table id="table_rawat_jalan" class="table table-bordered table-sm">
    <thead>
      <tr>
             <th style='background-color: #4CAF50; color: white' >Transaksi Penjualan</th>
             <th style='background-color: #4CAF50; color: white' >Rujuk Dengan Penanganan</th>
             <th style='background-color: #4CAF50; color: white' >Rujuk Tanpa Penanganan </th>
             <th style='background-color: #4CAF50; color: white' >Rujuk Rawat Inap</th>
             <th style='background-color: #4CAF50; color: white' >Rekam Medik</th>
             <th style='background-color: #4CAF50; color: white' >Batal</th>               
             <th style='background-color: #4CAF50; color: white' >No Urut</th>
             <th style='background-color: #4CAF50; color: white' >Poli</th> 
             <th style='background-color: #4CAF50; color: white' >Dokter</th>   
             <th style='background-color: #4CAF50; color: white' >No REG</th>
             <th style='background-color: #4CAF50; color: white' >No RM </th>
             <th style='background-color: #4CAF50; color: white' >Tanggal</th>       
             <th style='background-color: #4CAF50; color: white' >Nama Pasien</th>
             <th style='background-color: #4CAF50; color: white' >Penjamin</th>
             <th style='background-color: #4CAF50; color: white' >Umur</th>
             <th style='background-color: #4CAF50; color: white' >Jenis Kelamin</th>
             <th style='background-color: #4CAF50; color: white' >Keterangan</th>        
    </tr>
    </thead>
    <tbody id="tbody">
    
   <?php while($data = mysqli_fetch_array($query7))
      
      {

$penjual = $db->query("SELECT status FROM penjualan WHERE no_reg = '$data[no_reg]' ");
$sttus = mysqli_num_rows($penjual);

      echo "<tr  class='tr-id-".$data['id']."'>";

      $query_z = $db->query("SELECT p.status,p.no_faktur,p.nama,p.kode_gudang,g.nama_gudang FROM penjualan p INNER JOIN gudang g ON p.kode_gudang = g.kode_gudang WHERE p.no_reg = '$data[no_reg]' ");
      $data_z = mysqli_fetch_array($query_z);



if ($penjualan['penjualan_tambah'] > 0) {
  if ($data_z['status'] == 'Simpan Sementara') {

       echo "<td> <a href='proses_pesanan_barang_raja.php?no_faktur=".$data_z['no_faktur']."&no_reg=".$data['no_reg']."&no_rm=".$data['no_rm']."&nama_pasien=".$data_z['nama']."&kode_gudang=".$data_z['kode_gudang']."&nama_gudang=".$data_z['nama_gudang']."'class='btn btn-floating btn-small btn btn-info'><i class='fa fa-credit-card'></i></a> </td>"; 
      }
      else
      {
      echo"<td> <a href='form_penjualan_kasir.php?no_reg=". $data['no_reg']."' class='btn btn-floating btn-small btn-info penjualan' ><i class='fa fa-shopping-cart'></i></a></td>";

      }
}
else{


       echo "<td> </td>";

}
      
  ?>
  <?php
if ($registrasi_rj['registrasi_rj_lihat'] > 0) {
    if ($data['status'] == 'Rujuk Keluar Ditangani')
  {
    echo "<td style='color:red;'>Silakan Transaksi Penjualan</td>";
  } 
  else
  {
    echo "<td><button class='btn btn-floating btn-small btn-info pilih1' data-reg='". $data['no_reg']."' data-id='". $data['id']."' ><i class='fa fa-bus '></button></td>";
  }

if ($sttus > 0 )
{
  echo "<td></td>";
}
else
{
   echo "
 <td><button class='btn btn-floating btn-small btn-info pilih12' data-reg='". $data['no_reg']."' data-id='". $data['id']."'><i class='fa fa-cab'></button></td>";
}
 

  echo "<td> <button class='btn btn-floating btn-small btn-info rujuk_ri' data-reg='".$data['no_reg']."'><i class='fa fa-hotel'></button></td>";
}

else{
  echo "<td> </td>";
  echo "<td> </td>";
  echo "<td> </td>";
}


if ($rekam_medik['rekam_medik_rj_lihat'] > 0) {
  echo "<td> <a href='rekam_medik_raja.php' class='btn btn-floating btn-small btn-info penjualan' ><i class='fa fa-medkit'></i></a></td>";
}
else{
  echo "<td> </td>";
}
  
 

if ($registrasi_rj['registrasi_rj_hapus'] > 0) {

  if ($sttus > 0 )
{
  echo "<td></td>";
}
else
{
  echo "<td><button class='btn btn-floating btn-small btn-info pilih2' data-id='". $data['id']."' data-reg='".$data['no_reg']."'><b> X </b></button></td>";
}

}
else{
  echo "<td> </td>";
}
  
  
          echo "<td>". $data['no_urut']."</td>
          <td>". $data['poli']."</td>
          <td>". $data['dokter']."</td>
          <td>". $data['no_reg']."</td>
          <td>". $data['no_rm']."</td>
          <td>". tanggal($data['tanggal'])."</td>              
          <td>". $data['nama_pasien']."</td>
          <td>". $data['penjamin']."</td>
          <td>". $data['umur_pasien']."</td>
          <td>". $data['jenis_kelamin']."</td>
          <td>". $data['keterangan']."</td>
          </tr>";
      
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


<!--   script untuk detail layanan PERUSAHAAN PENJAMIN-->
  <script type="text/javascript">
     $(".pilih1").click(function(){   

    var id = $(this).attr('data-id');
    var reg = $(this).attr('data-reg');

          $("#rujuk_penanganan").modal('show');
          $("#submit_rujuk_penanganan").attr("data-id",id);
          $("#submit_rujuk_penanganan").attr("data-reg",reg);

  });

  $("#submit_rujuk_penanganan").click(function(){  
    var keterangan = $("#keterangan2").val();
    var reg = $(this).attr("data-reg");
    var id = $(this).attr("data-id");

            $("#rujuk_penanganan").modal('hide');
            $(".tr-id-"+id+"").remove();
            $.post("proses_keterangan_rujuk.php",{reg:reg,keterangan:keterangan},function(data){
            
            $("#tbody").prepend(data);


            });


   });
     

   $("form").submit(function(){
       return false;
       });
//            tabel lookup mahasiswa         
</script>


<!--   script untuk detail layanan PERUSAHAAN PENJAMIN-->
  <script type="text/javascript">
     $(".pilih12").click(function(){   

    var id = $(this).attr('data-id');
    var reg = $(this).attr('data-reg');

          $("#rujuk_non_penanganan").modal('show');
          $("#submit_rujuk_non_penanganan").attr("data-id",id);
          $("#submit_rujuk_non_penanganan").attr("data-reg",reg);

  });

  $("#submit_rujuk_non_penanganan").click(function(){  
    var keterangan = $("#keterangan12").val();
    var reg = $(this).attr("data-reg");
    var id = $(this).attr("data-id");

            $("#rujuk_non_penanganan").modal('hide');
            
            $.post("proses_keterangan_rujuk_non.php",{reg:reg,keterangan:keterangan},function(data){
            
            $(".tr-id-"+id+"").remove();


            });


   });
     

   $("form").submit(function(){
       return false;
       });
//            tabel lookup mahasiswa         
</script>



<!--   script untuk detail layanan PERUSAHAAN PENJAMIN-->
  <script type="text/javascript">
     $(".pilih2").click(function(){   

    var id = $(this).attr('data-id');
    var reg = $(this).attr('data-reg');

          $("#detail2").modal('show');
          $("#batal_jalan").attr("data-id",id);
          $("#batal_jalan").attr("data-reg",reg);

  });

  $("#batal_jalan").click(function(){  
    var keterangan = $("#keterangan_batal").val();
    var id = $(this).attr("data-id");
    var reg = $(this).attr("data-reg");

        if (keterangan == '') {
          alert("Keterangan batal Harus Diisi");
          $("#keterangan_batal").focus();
        }
        else
        {
            
            $.post("proses_keterangan_batal.php",{reg:reg,keterangan:keterangan},function(data){
            $(".tr-id-"+id+"").remove();
            $("#detail2").modal('hide');

            });
        }

   });
     

   $("form").submit(function(){
       return false;
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
