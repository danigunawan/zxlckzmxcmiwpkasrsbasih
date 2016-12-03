<?php include 'session_login.php';
include 'header.php';
include 'navbar.php';
include 'db.php';
include_once 'sanitasi.php';

$tanggal = date("Y-m-d");


$query7 = $db->query("SELECT * FROM registrasi WHERE jenis_pasien = 'Rawat Jalan' AND  status != 'Proses' AND status != 'Sudah Pulang' AND status != 'Batal Rawat' AND status != 'Rujuk Keluar Klinik Ditangani' AND status != 'Rujuk Rawat Jalan' AND status != 'Rujuk Keluar Klinik Tidak Ditangani' AND tanggal = '$tanggal'  ORDER BY id ASC ");


$qertu= $db->query("SELECT nama_dokter,nama_paramedik,nama_farmasi FROM penetapan_petugas ");
$ss = mysqli_fetch_array($qertu);

$sett_registrasi= $db->query("SELECT * FROM setting_registrasi ");
$data_sett = mysqli_fetch_array($sett_registrasi);

?>


<style>
.disable1{
background-color:#cccccc;
opacity: 0.9;
    cursor: not-allowed;
}
.disable2{
background-color: #cccccc;
opacity: 0.9;
    cursor: not-allowed;
}
.disable3{
background-color: #cccccc;
opacity: 0.9;
    cursor: not-allowed;
}
.disable4{
background-color: #cccccc;
opacity: 0.9;
    cursor: not-allowed;
}
.disable5{
background-color: #cccccc;
opacity: 0.9;
    cursor: not-allowed;
}
.disable6{
background-color: #cccccc;
opacity: 0.9;
    cursor: not-allowed;
}

</style>

<!-- Modal Untuk Confirm LAYANAN PERUSAHAAN-->
<div id="detail" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>       
    </div>
    <div class="modal-body">

      <span id="tampil_layanan">
      </span>
    </div>
    <div class="modal-footer">
        
        <button type="button" accesskey="e" class="btn btn-danger" data-dismiss="modal">Clos<u>e</u>d</button>
    </div>
    </div>
  </div>
</div>
<!--modal end Layanan Perusahaan-->


<!-- Modal Untuk Confirm LAYANAN PERUSAHAAN-->
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

<input style="height: 20px;" type="hidden" class="form-control" id="no_reg" name="no_reg" >

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
<!--modal end Layanan Perusahaan-->



<div class="container">

<h3>DATA PASIEN REGISTRASI RAWAT JALAN</h3><hr>


<!-- Nav tabs -->

<ul class="nav nav-tabs yellow darken-4" role="tablist">
        <li class="nav-item"><a class="nav-link active" href='registrasi_raja.php'> Antrian Pasien Rawat Jalan </a></li>
        <li class="nav-item"><a class="nav-link" href='pasien_sudah_panggil.php' > Pasien Sudah Dipanggil </a></li>
        <li class="nav-item"><a class="nav-link" href='pasien_sudah_masuk.php' > Pasien Sudah Masuk R.Dokter </a></li>
        <li class="nav-item"><a class="nav-link" href='pasien_batal_rujuk.php' > Pasien Batal / Rujuk Ke Luar </a></li>
</ul>
<br><br>
<button id="coba" type="submit" class="btn btn-primary" data-toggle="collapse" accesskey="r" ><i class='fa fa-plus'> </i>&nbsp;Tambah</button>

  <button id="kembali" style="display:none" data-toggle="collapse" accesskey="k"  class="btn btn-default"><i class="fa fa-reply"></i> <u>K</u>embali</button>


   <a href="rawat_jalan_baru.php" accesskey="b" class="btn btn-info"><i class="fa fa-plus"></i> Pasien <u>B</u>aru</a>

  <br>
 <br>

<div id="demo" class="collapse">

  <form id="form_cari" action="" method="get" accept-charset="utf-8">
  
  <div class="form-group">
    <label for=""><u>C</u>ari Pasien Lama</label>
    <input style="height: 20px;" type="text" accesskey="c" class="form-control" name="cari" autocomplete="off" id="cari_migrasi" style="width:370px;" placeholder="Cari Nama Pasien Lama">

  </div>
  <button id="submit_cari" accesskey="a" class="btn btn-success"><i class="fa fa-search"></i> C<u>a</u>ri</button>

</form>


<span id="hasil_migrasi"></span>
<br>


<div class="row">
  <div class="col-sm-4">
  <div class="card card-block">


<form role="form" action="proses_rawat_jalan.php" method="POST">



<div class="form-group">
  <label for="no_rm">No RM:</label>
  <input style="height: 20px;" type="text" class="form-control" id="no_rm" name="no_rm" required="" readonly="" autocomplete="off" >
</div>

<div class="form-group">
  <label for="sel1">Perujuk</label>
  <select class="form-control" id="rujukan" name="rujukan" autocomplete="off">  
  <option value="Non Rujukan">Non Rujukan</option>
  <?php 
  $query = $db->query("SELECT nama FROM perujuk ");
  while ( $data = mysqli_fetch_array($query))
   {
  echo "<option value='".$data['nama']."'>".$data['nama']."</option>";
   }
    ?>
  </select>
</div>

<div class="form-group">
  <label for="sel1">Penjamin</label>
  <select class="form-control" id="penjamin" name="penjamin" required="" autocomplete="off">
 
  <?php 
  $query = $db->query("SELECT nama FROM penjamin ");
  while ( $data = mysqli_fetch_array($query)) 
  {
  echo "<option value='".$data['nama']."'>".$data['nama']."</option>";
  }
  ?>

  </select>
</div>

<button type="button" accesskey="l" class="btn btn-warning" id="lay"><i class="fa fa-list"></i> Lihat <u>L</u>ayanan </button>
     <br>
      <br>
<div class="form-group">
  <label for="nama_lengkap">Nama Lengkap Pasien:</label>
  <input style="height: 20px;" type="text" class="form-control disable5" id="nama_lengkap" name="nama_lengkap" readonly="" autocomplete="off" required="" >
</div>

<div class="form-group">
  <label for="alamat">Alamat Sekarang</label>
  <textarea class="form-control" id="alamat" name="alamat" required="" autocomplete="off"></textarea>
</div>
   
<div class="form-group">
    <label for="alamat">Tanggal Lahir</label>
    <input style="height: 20px;" type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required="" autocomplete="off">
</div>

<div class="form-group" >
  <label for="umur">Umur</label>
  <input style="height: 20px;" type="text" class="form-control disable5" id="umur" readonly="" name="umur" required="" autocomplete="off">
</div>

</div>
</div> <!--col-sm-4-->

<div class="col-sm-4">



<div class="card card-block">

<div class="form-group">
  <label for="sel1">Jenis Kelamin</label>

  <input class="form-control disable6" id="jenis_kelamin" name="jenis_kelamin" required="" readonly="" autocomplete="off">

</div>

<div class="form-group" >
  <label for="umur">No Telp</label>
  <input style="height: 20px;" type="text" class="form-control " id="hp" name="hp" autocomplete="off">
</div>

</div>

<div class="card card-block">


<div class="form-group">
  <label for="sel1">Dokter</label>
  <select class="form-control ss" id="sel1 " name="dokter" required="" autocomplete="off">
<option value="<?php echo $ss['nama_dokter'];?>"><?php echo $ss['nama_dokter'];?></option>
        <option value="Tidak Ada">Tidak Ada</option>
   <?php 
   $query = $db->query("SELECT nama FROM user WHERE otoritas = 'Dokter' ORDER BY status_pakai DESC");
   while ( $data = mysqli_fetch_array($query)) 
   {
   echo "<option value='".$data['nama']."'>".$data['nama']."</option>";
   }
   ?>
   <option value="">Tidak Ada </option>
  </select>
</div>

<div class="form-group">
  <label for="sel1">Poli / Penunjang Medik</label>
  <select class="form-control" id="sel1" name="poli" required="" autocomplete="off">
   <?php 
   $query = $db->query("SELECT nama FROM poli ");
   while ( $data = mysqli_fetch_array($query)) 
   {
   echo "<option value='".$data['nama']."'>".$data['nama']."</option>";
   }
   ?>
   </select>
</div>

<div class="form-group">
  <label for="sel1">Keadaan Umum Pasien</label>
  <select class="form-control" id="kondisi" name="kondisi" required="" autocomplete="off">
    <option value="Tampak Normal">Tampak Normal</option>
    <option value="Pucat dan Lemas">Pucat dan Lemas</option>
    <option value="Sadar dan Cidera">Sadar dan Cidera</option>
    <option value="Pingsan / Tidak Sadar">Pingsan / Tidak Sadar</option>
    <option value="Meninggal Sebelum Tiba">Meninggal Sebelum Tiba</option>
  </select>
</div>

<div class="form-group ">
  <label >Alergi Obat *</label>
  <input style="height: 20px;" type="text" class="form-control" id="alergi" name="alergi" value="Tidak Ada" required="" autocomplete="off"> 
</div>

</div>

<?php if ($data_sett['tampil_ttv'] == 0): ?>

  <button type="submit" accesskey="d" class="btn btn-info hug"><i class="fa fa-plus"></i> <u>D</u>aftar Rawat Jalan</button> 
  
<?php endif ?>

</div> <!--  CLOSE col sm 4 -->


<?php if ($data_sett['tampil_ttv'] == 1): ?>

<div class="col-sm-4">

<div class="card card-block">


<center><h4>Tanda Tanda Vital</h4></center>
<div class="form-group">

  <label >Sistole / Diastole (mmHg)</label>
  <input style="height: 20px;" type="text" class="form-control" id="sistole_distole" name="sistole_distole"  autocomplete="off"> 
</div>

<div class="form-group">
  <label >Frekuensi Pernapasan (kali/menit)</label>
  <input style="height: 20px;" type="text" class="form-control" id="respiratory_rate" name="respiratory_rate"  autocomplete="off"> 
</div>

<div class="form-group">
  <label >Suhu (°C)</label>
  <input style="height: 20px;" type="text" class="form-control" id="suhu" name="suhu" autocomplete="off"> 
</div>

<div class="form-group ">
   <label >Nadi (kali/menit)</label>
   <input style="height: 20px;" type="text" class="form-control" id="nadi" name="nadi"  autocomplete="off"> 
</div>

<div class="form-group ">
  <label >Berat Badan (kg)</label>
  <input style="height: 20px;" type="text" class="form-control" id="berat_badan" name="berat_badan"  autocomplete="off"> 
</div>

<div class="form-group ">
  <label >Tinggi Badan (cm)</label>
  <input style="height: 20px;" type="text" class="form-control" id="tinggi_badan" name="tinggi_badan"  autocomplete="off"> 
</div>


  <input style="height: 20px;" type="hidden" class="form-control" id="token" name="token" value="Kosasih" autocomplete="off"> 


</div> <!--card-block-->


  <button type="submit" accesskey="d" class="btn btn-info hug"><i class="fa fa-plus"></i> <u>D</u>aftar Rawat Jalan</button> 

</div> <!-- col-sm-4-->
  
<?php endif ?>





</form>



 </div> <!--row utama-->
 </div><!-- penutup collapse -->


<!-- PEMBUKA DATA TABLE -->
<style>

tr:nth-child(even){background-color: #f2f2f2}

</style>

<span id="tabel-jalan">
<div class="table-responsive">
<table id="table_rawat_jalan" class="table table-bordered">
    <thead>
      <tr>
             <th style='background-color: #4CAF50; color: white'>No REG</th>
             <th style='background-color: #4CAF50; color: white'>No RM </th>
             <th style='background-color: #4CAF50; color: white'>Tanggal</th>       
             <th style='background-color: #4CAF50; color: white'>Nama Pasien</th>
             <th style='background-color: #4CAF50; color: white'>Penjamin</th>
             <th style='background-color: #4CAF50; color: white'>Umur</th>
             <th style='background-color: #4CAF50; color: white'>Jenis Kelamin</th>
             <th style='background-color: #4CAF50; color: white'>Dokter</th>
             <th style='background-color: #4CAF50; color: white'>Poli</th>               
             <th style='background-color: #4CAF50; color: white'>No Urut</th> 
             <th style='background-color: #4CAF50; color: white'>Aksi</th>
             <th style='background-color: #4CAF50; color: white'>Batal </th>

    </tr>
    </thead>
    <tbody id="tbody">
    
   <?php while($data = mysqli_fetch_array($query7))
      
      {
      echo "<tr class='tr-id-".$data['id']."'>
          <td>". $data['no_reg']."</td>
          <td>". $data['no_rm']."</td>
          <td>". tanggal($data['tanggal'])."</td>              
          <td>". $data['nama_pasien']."</td>
          <td>". $data['penjamin']."</td>
          <td>". $data['umur_pasien']."</td>
          <td>". $data['jenis_kelamin']."</td>
          <td>". $data['dokter']."</td>
          <td>". $data['poli']."</td>
          <td>". $data['no_urut']."</td>";

        if ($data['status'] == 'menunggu') {

        echo "<td><button  class='btn btn-warning pilih1' data-id='".$data['id']."' id='panggil-".$data['id']."' data-status='di panggil' data-urut='". $data['no_urut']."'> Panggil  </button>";

        echo "<button style='display:none'  class='btn btn-success pilih00' data-id='".$data['id']."' id='proses-".$data['id']."' data-status='Proses'  data-urut='". $data['no_urut']."'> Masuk </button></td>";
          
        }
        elseif ($data['status'] == 'di panggil') {

        echo "<td><button  class='btn btn-success pilih00' data-id='".$data['id']."' id='proses-".$data['id']."' data-status='Proses'  data-urut='". $data['no_urut']."'> Masuk </button></td>";

        }

      echo "<td><button class='btn btn-danger pilih2' data-id='". $data['no_reg']."'> Batal </button></td>";

 
      echo "</tr>";
      
      }
    ?>
  </tbody>
 </table>
</div><!--div responsive-->
 <!-- AKHIR TABLE -->

</span>

   
 

</div> <!--container-->


<!--datatable-->
<script type="text/javascript">
  $(function () {
  $("table").dataTable({"ordering": false});
  }); 
</script>
<!--end datatable-->

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

<!--script ambil data pasien modal-->
<script type="text/javascript">
//jika dipilih, nim akan masuk ke input dan modal di tutup
            $(document).on('click', '.pilih', function (e) {


              document.getElementById("no_rm").value = $(this).attr('data-no');
              document.getElementById("nama_lengkap").value = $(this).attr('data-nama');
              document.getElementById("tanggal_lahir").value = $(this).attr('data-lahir');
              document.getElementById("alamat").value = $(this).attr('data-alamat');
              document.getElementById("jenis_kelamin").value = $(this).attr('data-jenis-kelamin');
              document.getElementById("hp").value = $(this).attr('data-hp');
              document.getElementById("penjamin").value = $(this).attr('data-penjamin');
              $('#hasil_migrasi').html('');
              $("#no_rm").focus();

function hitung_umur(tanggal_input){

var now = new Date(); //Todays Date   
var birthday = tanggal_input;
birthday=birthday.split("/");   

var dobMonth= birthday[0]; 
var dobDay= birthday[1];
var dobYear= birthday[2];

var nowDay= now.getDate();
var nowMonth = now.getMonth() + 1;  //jan=0 so month+1
var nowYear= now.getFullYear();

var ageyear = nowYear- dobYear;
var agemonth = nowMonth - dobMonth;
var ageday = nowDay- dobDay;
if (agemonth < 0) {
       ageyear--;
       agemonth = (12 + agemonth);
        }
if (nowDay< dobDay) {
      agemonth--;
      ageday = 30 + ageday;
      }


if (ageyear <= 0) {
 var val = agemonth + " Bulan";
}
else {

 var val = ageyear + " Tahun";
}
return val;
}



    var tanggal_lahir = $("#tanggal_lahir").val();
    var umur = hitung_umur(tanggal_lahir);
if (tanggal_lahir == '')
{

}
else
{
  $("#umur").val(umur);
}

});
        


// tabel lookup mahasiswa
</script>
<!--end script ambil data pasien modal-->

<script>
//script untuk mencari data pasien ketika di ketik di kolom no rm

$("#no_rm").blur(function(){
    var no_rm = $("#no_rm").val();
    if(no_rm == ''){

    }
    else{
      
   
    $.getJSON('cek_pasien_lama.php',{no_rm:no_rm}, function(json){

        $("#nama_lengkap").val(json.nama_lengkap);
         $("#alamat").val(json.alamat_sekarang);
          $("#hp").val(json.no_hp);
           $("#jenis_kelamin").val(json.jenis_kelamin);
            $("#tanggal_lahir").val(json.tanggal_lahir);
              var tanggal_lahir = json.tanggal_lahir;
$.post('cekumur.php',{tanggal_lahir:tanggal_lahir},function(data){
  $("#umur").val(data);
});

    });

 }

});

//
</script>


<!--script panggil pasien-->
<script type="text/javascript">
//jika dipilih, nim akan masuk ke input dan modal di tutup
            $(document).on('click', '.pilih1', function (e) {
                var id = $(this).attr('data-id');
                var status = $(this).attr('data-status');
                var no_urut = $(this).attr('data-urut');

                

                $.post("panggil_pasien.php",{id:id,status:status,no_urut:no_urut},function(data)
                  {

                  });
                  $("#panggil-"+id+"").hide();
                  $("#proses-"+id+"").show();


            });


//tabel lookup mahasiswa
</script>
<!--end script panggil pasien-->

<!--script panggil pasien-->
<script type="text/javascript">
//jika dipilih, nim akan masuk ke input dan modal di tutup
            $(document).on('click', '.pilih00', function (e) {
                var id = $(this).attr('data-id');
                var status = $(this).attr('data-status');
                var no_urut = $(this).attr('data-urut');

              
                $(".tr-id-"+id+"").remove();
                $.post("panggil_pasien.php",{id:id,status:status,no_urut:no_urut},function(data){

                  });


            });


//tabel lookup mahasiswa
</script>
<!--end script panggil pasien-->


<script>
  $(function() {
  $( "#tanggal_lahir" ).pickadate({ selectYears: 100, format: 'dd/mm/yyyy'});
  });
  </script>
<!--end script datepicker-->


<script>

function hitung_umur(tanggal_input){



var now = new Date(); //Todays Date   
var birthday = tanggal_input;
birthday=birthday.split("/");   

var dobMonth= birthday[0]; 
var dobDay= birthday[1];
var dobYear= birthday[2];

var nowDay= now.getDate();
var nowMonth = now.getMonth() + 1;  //jan=0 so month+1
var nowYear= now.getFullYear();

var ageyear = nowYear- dobYear;
var agemonth = nowMonth - dobMonth;
var ageday = nowDay- dobDay;
if (agemonth < 0) {
       ageyear--;
       agemonth = (12 + agemonth);
        }
if (nowDay< dobDay) {
      agemonth--;
      ageday = 30 + ageday;
      }


if (ageyear <= 0) {
 var val = agemonth + " Bulan";
}
else {

 var val = ageyear + " Tahun";
}
return val;
}


$( "#tanggal_lahir" ).change(function(){
    var tanggal_lahir = $("#tanggal_lahir").val();
    var umur = hitung_umur(tanggal_lahir);
if (tanggal_lahir == '')
{

}
else
{
  $("#umur").val(umur);
}

});
</script>






<!--   script untuk detail layanan PERUSAHAAN PENJAMIN-->
<script type="text/javascript">
     $("#lay").click(function() 
{   
    var penjamin = $("#penjamin").val();

                $.post("detail_layanan_perusahaan2.php",{penjamin:penjamin},function(data){
                    $("#tampil_layanan").html(data);
               $("#detail").modal('show');
          
                });
            });
//            tabel lookup mahasiswa         
</script>
<!--  end script untuk akhir detail layanan PERUSAHAAN -->

<script type="text/javascript">

$("#submit_cari").click(function(){

  var cari = $("#cari_migrasi").val();
  if (cari == '') {

$("#hasil_migrasi").html('');

  }
  else
  {
    $("#hasil_migrasi").html('Loading..');
 $.post("cek_pasien_lama_reg.php",{cari:cari},function(data){
    $("#hasil_migrasi").html(data);

  });

  }
 

});

$("#form_cari").submit(function(){
  return false;
});
</script>

<!--script disable hubungan pasien-->
<script type="text/javascript">
  $("#coba").click(function(){
  $("#demo").show();
  $("#kembali").show();
   $("#coba").hide();
  });
    
    $("#kembali").click(function(){
  $("#demo").hide();
  $("#coba").show();
  $("#kembali").hide();

  });

</script>

<script type="text/javascript">
//berfunsi untuk mencekal username ganda
 $(document).ready(function(){
  $(document).on('click', '.pilih', function (e) {
    var no_rm = $("#no_rm").val();
    var nama_pasien = $("#nama_pasien").val();

 $.post('cek_data_pasien_rawat_jalan.php',{no_rm:no_rm,nama_pasien:nama_pasien}, function(data){
  
  if(data == 1){
    alert("Anda Tidak Bisa Menambahkan Pasien Yang Sudah Ada!");
    $("#no_rm").val('');
    $("#nama_pasien").val('');
    $("#no_hp").val('');
    $("#tanggal_lahir").val('');
    $("#alamat").val('');
    $("#jenis_kelamin").val('');
    $("#penjamin").val('');
    $("#gol_darah").val('');
    $("#umur").val('');

   }//penutup if

    });////penutup function(data)

    });//penutup click(function()
  });//penutup ready(function()
</script>


<!--footer -->
<?php
 include 'footer.php';
?>
<!--end footer-->



















