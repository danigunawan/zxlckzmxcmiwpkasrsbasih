<?php include 'session_login.php';
include 'header.php';
include 'navbar.php';
include 'db.php';
 
$q_penetapan = $db->query("SELECT * FROM penetapan_petugas");
$v_penetapan = mysqli_fetch_array($q_penetapan);
$nama_dokter  = $v_penetapan['nama_dokter'];

$settt = $db->query("SELECT tampil_ttv FROm setting_registrasi");
$datasett = mysqli_fetch_array($settt);

?>

 

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
        
        <button type="button" class="btn btn-danger" data-dismiss="modal">Closed</button>
    </div>
    </div>
  </div>
</div>
<!--modal end Layanan Perusahaan-->


<div class="container">
   <h3><b>REGISTRASI RAWAT JALAN BARU</b></h3> <hr>


<form id="form_cari" action="" method="get" accept-charset="utf-8">
  
  <div class="form-group">
    <label for=""><u>C</u>ari Migrasi Pasien</label>
    <input style="height: 20px;" type="text" accesskey="c" class="form-control" name="cari" id="cari_migrasi" autocomplete="off" placeholder="Cari Nama Pasien">
  </div>
  <button id="submit_cari" class="btn btn-success"><i class="fa fa-search"></i> Cari</button>

</form>

<span id="hasil_migrasi"></span>

<div class="row">
  <div class="col-sm-3">
  	
  <div class="card card-block">


 <form role="form" id="formku" action="proses_pendaftaran.php" method="POST" >

<div class="form-group">
    <input style="height: 20px;" type="hidden" class="form-control" id="no_rm_lama" name="no_rm_lama" readonly="">
</div>


<div class="form-group">
  <label for="sel1">Perujuk </label>
  <select class="form-control ss" id="rujukan" name="rujukan" required=""  autocomplete="off">
   
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
  <label for="sel1">Penjamin *</label>
  <select class="form-control ss" id="penjamin" name="penjamin" required="" autocomplete="off">

 <?php 
  $query = $db->query("SELECT nama FROM penjamin ");
  while ( $data = mysqli_fetch_array($query)) 
  {
  echo "<option value='".$data['nama']."'>".$data['nama']."</option>";
  }
 ?>
  </select>
</div>

<button class="btn btn-warning" id="lay"><i class="fa fa-list"></i> Lihat Layanan </button>
     
   <br>
   <br>
  <div class="form-group">
    <label for="nama_lengkap">Nama Lengkap Pasien:</label>
    <input style="height: 20px;" type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required="" autocomplete="off">
  </div>


<div class="form-group">
  <label for="sel1">Jenis Kelamin</label>
  <select class="form-control ss" name="jenis_kelamin" id="jenis_kelamin" required="" autocomplete="off">
    <option value="laki-laki">Laki-Laki</option>
    <option value="perempuan">Perempuan</option> 
  </select>
</div>


<div class="form-group">
    <label for="tempat_lahir">Tempat Lahir:</label>
    <input style="height: 20px;" type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required="" autocomplete="off">
  </div>

<div class="form-group">
    <label for="tanggal_lahir">Tanggal Lahir:</label>
    <input style="height: 20px;" type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required="" autocomplete="off">
</div>

<div class="form-group">
    <label for="umur">Umur:</label>
    <input style="height: 20px;" type="text" class="form-control" id="umur" name="umur" autocomplete="off">
</div>


<div class="form-group">
  <label for="sel1">Golongan Darah</label>
  <select class="form-control ss" id="gol_darah" name="gol_darah" autocomplete="off">
    <option value="-">-</option>
    <option value="A">A</option>
    <option value="B">B</option>
    <option value="O">O</option>
    <option value="AB">AB</option>
   
  </select>
</div>


<div class="form-group">
    <label for="alamat_sekarang">Alamat Sekarang:</label>
    <textarea class="form-control" id="alamat_sekarang" name="alamat_sekarang" required="" autocomplete="off"></textarea>
</div>


</div><!--penutup div card-block-->
</div> <!--col no 1-->


<div class="col-sm-3">


  <div class="card card-block">


<div class="form-group">
    <label for="no_telepon">No Telpon / HP:</label>
    <input style="height: 20px;" type="text" class="form-control" id="no_telepon" name="no_telepon" autocomplete="off">
</div>



<div class="form-group">
    <label for="no_ktp">No Keluarga:</label>
    <input style="height: 20px;" type="text" class="form-control" id="no_kk" name="no_kk" autocomplete="off">
  </div>

  <div class="form-group">
    <label for="no_ktp">Nama KK:</label>
    <input style="height: 20px;" type="text" class="form-control" id="nama_kk" name="nama_kk" autocomplete="off">
  </div>


<div class="form-group">
    <label for="no_ktp">No KTP:</label>
    <input style="height: 20px;" type="text" class="form-control" id="no_ktp" name="no_ktp" autocomplete="off">
  </div>



<div class="form-group">
    <label for="alamat_ktp">Alamat KTP:</label>
    <textarea class="form-control" id="alamat_ktp" name="alamat_ktp" autocomplete="off"></textarea>
</div>

  <div class="form-group">
  <label for="sel1">Status Perkawinan</label>
  <select class="form-control ss" id="sel1" name="status_kawin" autocomplete="off">
     <option value="-">-</option>
   <option value="belum menikah">Belum Menikah</option>
    <option value="menikah">Menikah</option>
    <option value="cerai">Cerai</option>
  </select>
</div>


<div class="form-group">
  <label for="sel1">Pendidikan Terakhir</label>
  <select class="form-control ss" id="sel1" name="pendidikan_terakhir" autocomplete="off">
    <option value="-">-</option>
    <option value="tidak sekolah">Tidak Sekolah</option>
    <option value="sd">SD</option>
    <option value="smp">SMP</option>
    <option value="sma">SMA / SMK</option>
    <option value="d1">D1</option>
    <option value="d2">D2</option>
    <option value="d3">D3</option>
    <option value="s1">S1</option>
    <option value="s2">S2</option>
    <option value="s3">S3</option>
  </select>
</div>

<div class="form-group">
  <label for="sel1">Agama</label>
  <select class="form-control ss" id="sel1" name="agama"  autocomplete="off">
      <option value="-">-</option>
    <option value="islam">Islam</option>
    <option value="khatolik">Khatolik</option>
    <option value="kristen">Kristen</option>
    <option value="hindu">Hindu</option>
    <option value="budha">Budha</option>
    <option value="khonghucu">Khonghucu</option>
    <option value="lain - lain">Lain - Lain</option>
  </select>
</div>
     
     <div class="form-group">
    <label for="nama_suamiortu">Nama Suami / Orangtua :</label>
    <input style="height: 20px;" type="text" class="form-control" id="nama_suamiortu" name="nama_suamiortu" autocomplete="off">
</div>


<div class="form-group">
    <label for="pekerjaan_pasien">Pekerjaan Pasien/Ortu :</label>
    <input style="height: 20px;" type="text" class="form-control" id="pekerjaan_pasien" name="pekerjaan_pasien" autocomplete="off">
</div>

  </div><!--penutup div colsm2-->

</div>
  
<div class="col-sm-3">


  <div class="card card-block">

<div class="form-group">
    <label for="pekerjaan_pasien">Nama Penganggung Jawab :</label>
    <input style="height: 20px;" type="text" class="form-control" id="nama_penanggungjawab" name="nama_penanggungjawab" autocomplete="off">
</div>


  <div class="form-group" >
  <label for="umur">Hubungan Dengan Pasien</label>
  <select id="hubungan_dengan_pasien" class="form-control ss" name="hubungan_dengan_pasien" autocomplete="off">
      <option value="-">-</option>
  <option value="Orang Tua">Orang Tua</option>
  <option value="Suami/Istri">Suami/Istri</option>
  <option value="Anak">Anak</option>
  <option value="Keluarga">Keluarga</option>
  <option value="Teman">Teman</option>
  <option value="Lain - Lain">Lain - Lain</option>  
  </select>  
  </div> 


<div class="form-group">
    <label for="no_hp_penanggung">No Hp Penganggung Jawab :</label>
    <input style="height: 20px;" type="text" class="form-control" id="no_hp_penanggung" name="no_hp_penanggung" autocomplete="off">
</div>

<div class="form-group">
    <label for="alamat_penanggung">Alamat Penanggung Jawab:</label>
    <textarea class="form-control" id="alamat_penanggung" name="alamat_penanggung" autocomplete="off"></textarea>
</div>

  
<div class="form-group">
  <label for="sel1"><u>K</u>eadaan Umum Pasien</label>
  <select class="form-control" accesskey="k"id="kondisi" name="kondisi" required="" autocomplete="off">
    <option value="Tampak Normal">Tampak Normal</option>
    <option value="Pucat dan Lemas">Pucat dan Lemas</option>
    <option value="Sadar dan Cidera">Sadar dan Cidera</option>
    <option value="Pingsan / Tidak Sadar">Pingsan / Tidak Sadar</option>
    <option value="Meninggal Sebelum Tiba">Meninggal Sebelum Tiba</option>
  </select>
</div>

<div class="form-group ">
  <label >Alergi Obat *</label>
  <input style="height: 20px;" type="text" class="form-control" id="alergi" name="alergi" required="" value="Tidak Ada" placeholder="Wajib Isi" autocomplete="off"> 
</div>


</div> <!-- penutup CARD-BLOCK -->

<div class="card card-block">

<div class="form-group">
  <label for="sel1">Poli / Penunjang Medik</label>
  <select class="form-control ss" id="sel1" name="poli" required="" autocomplete="off">
  
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
  <label for="sel1">Dokter</label>
  <select class="form-control ss" id="sel1" name="dokter" required="" autocomplete="off">
    <option value="<?php echo $nama_dokter; ?>"><?php echo $nama_dokter; ?></option>
        <option value="Tidak Ada">Tidak Ada</option>
 <?php 
  $query = $db->query("SELECT nama FROM user WHERE otoritas = 'Dokter' ORDER BY status_pakai ASC "); 
 while ( $data = mysqli_fetch_array($query))
  {
  echo "<option value='".$data['nama']."'>".$data['nama']."</option>";
  }
  ?>
  </select>
</div>


</div><!-- end class="card card-block"-->

 <?php if ($datasett['tampil_ttv'] == 0): ?>
    <button accesskey="d" type="submit" id="submit_daftar" class="btn btn-info hug"><i class="fa fa-plus"></i><u>D</u>aftar Rawat Jalan</button>
  <?php endif ?>

</div><!--penutup col sm 3-->
 

<div class="col-sm-3">
 <?php if ($datasett['tampil_ttv'] == 1): ?>
   <div class="card card-block">

<center><h4>Tanda Tanda Vital</h4></center>
<div class="form-group">
 <label >Sistole / Diastole (mmHg)</label>
  <input style="height: 20px;" type="text" class="form-control" id="sistole_distole" name="sistole_distole" autocomplete="off"> 
</div>


<div class="form-group ">
  <label >Frekuensi Pernapasan (kali/menit)</label>
  <input style="height: 20px;" type="text" class="form-control" id="respiratory_rate" name="respiratory_rate" autocomplete="off"> 
</div>
 

<div class="form-group">
  <label >Suhu (°C)</label>
  <input style="height: 20px;" type="text" class="form-control" id="suhu" name="suhu" autocomplete="off"> 
</div>
  

<div class="form-group ">
   <label >Nadi (kali/menit)</label>
  <input style="height: 20px;" type="text" class="form-control" id="nadi" name="nadi" autocomplete="off"> 
</div>


<div class="form-group ">
  <label >Berat Badan (kg)</label>
  <input style="height: 20px;" type="text" class="form-control" id="berat_badan" name="berat_badan" autocomplete="off"> 
</div>

<div class="form-group ">
  <label >Tinggi Badan (cm)</label>
  <input style="height: 20px;" type="text" class="form-control" id="tinggi_badan" name="tinggi_badan" autocomplete="off"> 
</div>

  <input style="height: 20px;" type="hidden" class="form-control" id="token" name="token" value="Kosasih" autocomplete="off"> 




</div> <!-- nutup sm-->

  <button accesskey="d" type="submit" id="submit_daftar" class="btn btn-info hug"><i class="fa fa-plus"></i><u>D</u>aftar Rawat Jalan</button>

<?php endif ?>
</div><!--panel body-->

</form>

</div> <!--row utama--> 
</div> <!--container-->

<script>
  $(function() {
  $( "#tanggal_lahir" ).pickadate({ selectYears: 100, format: 'dd/mm/yyyy'});
  });
  </script>
<!--end script datepicker-->



<!--script chossen-->
<script>
$(".ss").chosen({no_results_text: "Oops, Tidak Ada !"});
</script>
<!--script end chossen-->



<!--script ambil data pasien modal-->
<script type="text/javascript">
//jika dipilih, nim akan masuk ke input dan modal di tutup
            $(document).on('click', '.pilih', function (e) {

              document.getElementById("no_rm_lama").value = $(this).attr('data-no');
              document.getElementById("nama_lengkap").value = $(this).attr('data-nama');
              document.getElementById("tanggal_lahir").value = $(this).attr('data-lahir');
              document.getElementById("alamat_sekarang").value = $(this).attr('data-alamat');
              document.getElementById("jenis_kelamin").value = $(this).attr('data-jenis-kelamin');
              document.getElementById("no_telepon").value = $(this).attr('data-hp');
              $('#hasil_migrasi').html(''); 
              $("#nama_lengkap").focus();
// untuk update umur ketika sudah beda bulan dan tahun

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


<!--   script untuk hitung umur -->
<script>
     $("#tanggal_lahir").change(function(){

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
<!--   script untuk hitung umur -->



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
  $("#hasil_migrasi").html('Loading...');
 $.post("cek_pasien_migrasi.php",{cari:cari},function(data){
    $("#hasil_migrasi").html(data);

  });

  }
 

});

$("#form_cari").submit(function(){
  return false;
});

</script>

<!--footer-->
<?php 
include 'footer.php';
?>
<!--end footer-->



