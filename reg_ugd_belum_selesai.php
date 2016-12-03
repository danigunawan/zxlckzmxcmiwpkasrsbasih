<?php include 'session_login.php';
include 'header.php';
include 'navbar.php';
include 'db.php';
include_once 'sanitasi.php';



$query7 = $db->query("SELECT * FROM registrasi WHERE jenis_pasien = 'UGD' AND status = 'Masuk Ruang UGD' AND status != 'Batal UGD' AND status != 'Rujuk Rumah Sakit' AND TO_DAYS(NOW()) - TO_DAYS(tanggal) >= 7 ORDER BY id ASC ");


$qertu= $db->query("SELECT nama_dokter,nama_paramedik,nama_farmasi FROM penetapan_petugas ");
$ss = mysqli_fetch_array($qertu);

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


<!-- Modal Untuk Confirm rUJUKAN KE RS-->
<div id="modal_rujuk" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>       
    </div>
    <div class="modal-body">
      <span id="tampil_rujuk">

<form method="POST" accept-charset="utf-8">
  
<div class="form-group">
  <label>Keterangan</label>
  <textarea class="form-control" id="keterangan_rujuk" name="keterangan" required="" placeholder="Wajib Isi" autocomplete="off"></textarea> 
</div>
<input type="hidden" id="reg" name="reg" >
<button type="submit" id="rujukkkk" class="btn btn-primary" data-id="" data-reg="" ><i class='fa fa-send'></i> Rujuk</button>
  </form>

      </span>
    </div>
    <div class="modal-footer">    
        <button type="button" class="btn btn-danger" data-dismiss="modal">Closed</button>
    </div>
    </div>
  </div>
</div>
<!--modal end Layanan RUJUK KE RS-->

<!-- Modal Untuk Confirm rUJUKAN KE RAWAT INAP-->
<div id="modal_rujuk_ri" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>       
    </div>
    <div class="modal-body">

      <span id="tampil_rujuk_inap">
      <center>RUJUK RAWAT INAP<br>
<a href="" type="button" id="rujuk_ranap" class="btn btn-primary"> <i class="fa fa-bus"></i> Rujuk Rawat Inap</a>
  </form>
  </center>
      </span>
    </div>
    <div class="modal-footer">    
       <center><button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove-sign"></i> Closed</button></center>
    </div>
    </div>
  </div>
</div>
<!--modal end Layanan RUJUK KE RAWAT INAP-->


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


<!-- Modal Untuk Confirm rUJUKAN KE RS-->
<div id="modal_pulang" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>       
    </div>
    <div class="modal-body">

      <span id="tampil_pulang">

        <form method="POST" accept-charset="utf-8">
  
<div class="form-group">
  <label>Keterangan</label>
  <textarea class="form-control"  id="keterangan_pulang" name="keterangan" required="" placeholder="Wajib Isi" autocomplete="off"></textarea> 
</div>
<input type="hidden" id="reg2" name="reg2">

<button type="submit" class="btn btn-primary" id="pulang" data-id="" data-reg="" ><i class='fa fa-home'></i> Pulang
</button>

  </form>
      </span>
    </div>
    <div class="modal-footer">
        
        <button type="button" class="btn btn-danger" data-dismiss="modal">Closed</button>
    </div>
    </div>
  </div>
</div>
<!--modal end Layanan RUJUK KE RS-->

<div class="container">
<h3><b>Data Pasien UGD Belum Selesai Pembayaran</b></h3><hr>

  <!--<button id="coba" data-toggle="collapse" accesskey="u"  class="btn btn-primary"><i class="fa fa-plus"></i> Daftar <u>U</u>GD</button>-->
    <button id="kembali" style="display:none" data-toggle="collapse" accesskey="k"  class="btn btn-primary"><i class="fa fa-reply"></i> <u>K</u>embali</button>

<a href="registrasi_ugd_baru.php" accesskey="b" class="btn btn-info"> <i class="fa fa-plus"></i> Pasien <u>B</u>aru</a>

<a href="reg_ugd_belum_selesai.php" id="pasien_ugd_belum_selesai" accesskey="s" class="btn btn-danger"> <i class="fa fa-list"></i> Pasien Belum <u>S</u>elesai Pembayaran </a>
<br>

 <br>

<div id="demo" class="collapse">

<form id="form_cari" action="" method="get" accept-charset="utf-8">
  
  <div class="form-group">
    <label for=""><u>C</u>ari Pasien Lama</label>
    <input style="height: 20px;" type="text" accesskey="c" class="form-control" name="cari" id="cari_migrasi" autocomplete="off" style="width:370px;" placeholder="Cari Nama Pasien Lama">

  </div>
</form>
<button id="submit_cari" class="btn btn-warning"><i class="fa fa-search"></i> Cari</button>
<br>
<br>
<span id="hasil_migrasi"></span>
<br>





<div class="row">
  <div class="col-sm-4">

  

     <form role="form" method="POST">

<div class="card card-block">

<div class="form-group">	
	<label for="no_rm">No RM</label>
	<input style="height: 20px;" type="text" class="form-control disable1" readonly="" id="no_rm" name="no_rm"    >
</div>


<div class="form-group">
  <label for="sel1">Perujuk</label>
  <select class="form-control" id="rujukan" name="rujukan"  autocomplete="off">
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
  <input style="height: 20px;" type="hidden" class="form-control" id="token" name="token" value="Kosasih" autocomplete="off"> 

<div class="form-group">
  <label for="sel1">Penjamin</label>
  <select class="form-control" id="penjamin" name="penjamin"  autocomplete="off">
  <option value=""> --SILAKAN PILIH--</option>
    <?php 
    $query = $db->query("SELECT nama FROM penjamin ");
    while ( $data = mysqli_fetch_array($query)) 
    {
    echo "<option value='".$data['nama']."'>".$data['nama']."</option>";
    }
   ?>
  </select>
</div>


<button type="button" class="btn btn-success" id="lay"><i class="fa fa-list"></i> Lihat Layanan </button>
     
   <br>
  <br>


<div class="form-group">
  <label for="nama_lengkap">Nama Lengkap Pasien:</label>
  <input style="height: 20px;" type="text" class="form-control disable1" id="nama_pasien" readonly="" name="nama_pasien"  >
</div>


<div class="form-group" >
  <label for="umur">Jenis Kelamin</label>
  <input style="height: 20px;" type="text" class="form-control disable1" id="jenis_kelamin" readonly="" name="jenis_kelamin"  >
</div> 
  <input style="height: 20px;" type="hidden" class="form-control " id="tanggal_lahir" name="tanggal_lahir"  >

<div class="form-group" >
  <label for="umur">Umur</label>
  <input style="height: 20px;" type="text" class="form-control disable1" id="umur" name="umur" readonly=""  >
</div>





<div class="form-group">
  <label for="sel1">Golongan Darah</label>
  <select class="form-control" id="gol_darah" name="gol_darah" autocomplete="off">
    <option value="-">-</option>
    <option value="A">A</option>
    <option value="B">B</option>
    <option value="O">O</option>
    <option value="AB">AB</option>
  </select>
</div>

<div class="form-group" >
  <label for="umur">No Telphone / HP</label>
  <input style="height: 20px;" type="text" class="form-control " id="no_hp" name="no_hp"  >
</div> 


</div>
</div> <!--end col sm  1-->

<div class="col-sm-4"><!--col sm  2-->

<div class="card card-block">

<div class="form-group">
  <label for="alamat">Alamat Sekarang</label>
  <textarea style="height: 120px;" class="form-control " id="alamat" name="alamat"  ></textarea>
</div>


 
</div> 

	
<div class="card card-block">

<div class="form-group ">
  <label >Alergi Obat *</label>
  <input style="height: 20px;" type="text" class="form-control" id="alergi" name="alergi"  value="Tidak Ada" placeholder="Wajib Isi" autocomplete="off"> 
</div>

<div class="form-group">
  <label for="sel1">Keadaan Umum Pasien</label>
  <select class="form-control" id="kondisi" name="kondisi"  autocomplete="off">
    <option value="Tampak Normal">Tampak Normal</option>
    <option value="Pucat dan Lemas">Pucat dan Lemas</option>
    <option value="Sadar dan Cidera">Sadar dan Cidera</option>
    <option value="Pingsan / Tidak Sadar">Pingsan / Tidak Sadar</option>
    <option value="Meninggal Sebelum Tiba">Meninggal Sebelum Tiba</option>
  </select>
</div>
<br>

</div>

<div class="card card-block">


  <center><h4>Glassgow Coma Scale (GCS)</h4></center>

<div class="form-group">
  <label for="sel1">Respon Mata (Eye)</label>
  <select class="form-control" id="eye" name="eye"  autocomplete="off">
    <option value="Tidak ada Respon (Meski Dicubit)">Tidak ada Respon (Meski Dicubit)</option>
     <option value="Respon Terhadap nyeri (Dicubit)">Respon Terhadap nyeri (Dicubit)</option>
      <option value="Respon Terhadap suara (Suruh Buka Mata)">Respon Terhadap suara (Suruh Buka Mata)</option>
       <option value="Respon Spontan (Tanpa Stimulus / Rangsang)">Respon Spontan (Tanpa Stimulus / Rangsang)</option>
  </select>
</div>


<div class="form-group">
  <label for="sel1">Respon Ucapan (Verbal)</label>
  <select class="form-control" id="verbal" name="verbal"  autocomplete="off">
    <option value="Tidak ada Suara">Tidak ada Suara</option>
     <option value="Suara Tidak Jelas (Tanpa Arti, Mengeranga)">Suara Tidak Jelas (Tanpa Arti, Mengeranga)</option>
      <option value="Ucapan Jelas, Subtansi Tidak Jelas/Non-kalimat (Aduh, Ibu)">Ucapan Jelas, Subtansi Tidak Jelas/Non-kalimat (Aduh, Ibu)</option>
       <option value="Berbicara Mengacau (Bingung)">Berbicara Mengacau (Bingung)</option>
        <option value="Berorientasi Baik">Berorientasi Baik</option>   
  </select>
</div>


<div class="form-group">
  <label for="sel1">Respon Gerak (Motorik)</label>
  <select class="form-control" id="motorik" name="motorik"  autocomplete="off">
    <option value="Tidak Ada (flasid)">Tidak Ada (flasid)</option>
     <option value="Exstensi Abnormal">Exstensi Abnormal</option>
      <option value="Fleksi Abnormal">Fleksi Abnormal</option>
       <option value="Fleksi Normal (Menarik Anggota yang Dirangsang)">Fleksi Normal (Menarik Anggota yang Dirangsang)</option>
        <option value="Melokalisir Nyeri (Menjauhkan Saat Diberi Rangsang Nyeri)">Melokalisir Nyeri (Menjauhkan Saat Diberi Rangsang Nyeri)</option>
         <option value="Ikut Perintah">Ikut Perintah</option>  
  </select>
</div>


</div> <!-- PANEL UNTUK GCS -->



 

</div> <!--  CLODE col sm 2 -->

  <div class="col-sm-4"><!--col sm  3-->

<div class="card card-block">

<div class="form-group" >
  <label for="umur">Pengantar</label>
  <select id="pengantar" class="form-control " name="pengantar"  autocomplete="off">
      <option value="Datang Sendiri">Datang Sendiri</option>
      <option value="Diantar Keluarga/Family">Diantar Keluarga/Family</option>
     <option value="Diantar Orang Lain">Diantar Orang Lain</option>
      <option value="Diantar Polisi">Diantar Polisi</option>
 </select>  
</div> 


<div class="form-group">
  <label for="umur">Hubungan Dengan Pasien</label>
  <select id="hubungan_dengan_pasien" class="form-control " name="hubungan_dengan_pasien" autocomplete="off">
 <option value="">Silakan Pilih</option>
 <option value="Orang Tua">Orang Tua</option>
     <option value="Suami/Istri">Suami/Istri</option>
      <option value="Anak">Anak</option>
      <option value="Saudara">Saudara</option>
      <option value="Saudara Ipar">Saudara Ipar</option>

  </select>  
</div>


<div class="form-group" >
  <label for="umur">Nama Pengantar</label>
  <input style="height: 20px;" type="text" class="form-control " id="nama_pengantar" name="nama_pengantar" autocomplete="off">
</div> 



<div class="form-group">
  <label for="alamat">Alamat Pengantar</label>
  <textarea  style="height: 100px;" class="form-control " id="alamat_pengantar" name="alamat_pengantar" ></textarea>
</div>



<div class="form-group" >
  <label for="umur">No Telphone / HP Pengantar</label>
  <input style="height: 20px;" type="text" class="form-control" id="hp_pengantar" name="hp_pengantar"  autocomplete="off">
</div>

   
<div class="form-group" >
  <label for="umur">Keterangan</label>
  <input style="height: 20px;" type="text" class="form-control " id="keterangan" name="keterangan"  autocomplete="off" >
</div>


</div>


 <div class="card card-block">


<div class="form-group">
  <label for="sel1">Dokter Jaga</label>
  <select class="form-control" id="dokter_jaga" name="dokter_jaga"  autocomplete="off">
  <option value="<?php echo $ss['nama_dokter'];?>"><?php echo $ss['nama_dokter'];?></option>
          <option value="Tidak Ada">Tidak Ada</option>
 <?php 
  $query = $db->query("SELECT nama FROM user WHERE otoritas = 'Dokter' ORDER BY status_pakai DESC");
while ( $data = mysqli_fetch_array($query))
 {
  echo "<option value='".$data['nama']."'>".$data['nama']."</option>";
 }
   ?>
  </select>
</div>
 

  <button type="submit" class="btn btn-info hug" id="daftar_ugd"><i class="fa fa-plus"></i> Daftar UGD</button> 

</form>

</div> 
</div> <!-- row no 2-->

 </div> <!--row utama-->
 </div><!-- penutup collapse -->

<style>

tr:nth-child(even){background-color: #f2f2f2}

</style>

<!-- PEMBUKA DATA TABLE -->
<span id="table_baru">

<div class="table-responsive">
<table id="table_rawat_jalan" class="table table-bordered table-sm">
 
    <thead>
      <tr>
      <th style='background-color: #4CAF50; color: white'>Batal</th>

      <th style='background-color: #4CAF50; color: white'>Transaksi Penjualan</th>
      <th style='background-color: #4CAF50; color: white'>Rujuk Tempat Lain</th>
      <th style='background-color: #4CAF50; color: white'>Rujuk Rawat Inap</th>
      

      <th style='background-color: #4CAF50; color: white'>No REG</th>
      <th style='background-color: #4CAF50; color: white'>No RM </th>	
      <th style='background-color: #4CAF50; color: white'>Penjamin</th>  
      <th style='background-color: #4CAF50; color: white'>Nama Pasien</th>
      <th style='background-color: #4CAF50; color: white'>Jenis Kelamin</th>
      <th style='background-color: #4CAF50; color: white'>Umur</th>
      <th style='background-color: #4CAF50; color: white'>No Hp Pasien</th>
      <th style='background-color: #4CAF50; color: white'>Keterangan</th>
      <th style='background-color: #4CAF50; color: white'>Dokter</th>	
      <th style='background-color: #4CAF50; color: white'>Pengantar</th>		
      <th style='background-color: #4CAF50; color: white'>Nama Pengantar</th>
      <th style='background-color: #4CAF50; color: white'>Hp Pengantar</th>
      <th style='background-color: #4CAF50; color: white'>Tanggal</th>
      <th style='background-color: #4CAF50; color: white'>Alamat Pengantar</th>
      <th style='background-color: #4CAF50; color: white'>Hubungan Pengantar</th>

   </tr>
    </thead>
    <tbody id="tbody">
    
   <?php while($data = mysqli_fetch_array($query7))
      
      {
      $query_z = $db->query("SELECT status,no_faktur,nama,kode_gudang FROM penjualan WHERE no_reg = '$data[no_reg]' ");
      $data_z = mysqli_fetch_array($query_z);

      
      echo "<tr  class='tr-id-".$data['id']."'  >
        <td> <button type='button' data-reg='".$data['no_reg']."'  data-id='".$data['id']."'  class='btn btn-floating btn-small btn-info pulang_rumah' ><b> X </b></button></td>";

if ($data_z['status'] == 'Simpan Sementara') {

       echo "<td> <a href='proses_pesanan_barang_ugd.php?no_faktur=".$data_z['no_faktur']."&no_reg=".$data['no_reg']."&no_rm=".$data['no_rm']."&nama_pasien=".$data_z['nama']."&kode_gudang=".$data_z['kode_gudang']."'class='btn btn-floating btn-small btn btn-info'><i class='fa fa-credit-card'></i></a> </td>"; 
      }
      else
      {
      echo "<td> <a href='form_penjualan_ugd.php?no_reg=". $data['no_reg']."' class='btn btn-floating btn-small btn-info penjualan' ><i class='fa fa-shopping-cart'></a></td>";

      }
        
                                     
      echo "<td> <button  type='button' data-reg='".$data['no_reg']."' data-id='".$data['id']."'  class='btn btn-floating btn-small btn-info rujuk' ><i class='fa fa-bus'></i>   </button>
        </td>

        <td> <button  type='button' data-reg='".$data['no_reg']."' class='btn btn-floating btn-small btn-info rujuk_ri' ><i class='fa fa-hotel'></i>   </button></td>



                    <td>". $data['no_reg']."</td>
                    <td>". $data['no_rm']."</td>
                    <td>". $data['penjamin']."</td>														
                    <td>". $data['nama_pasien']."</td>
                    <td>". $data['jenis_kelamin']."</td>
                    <td>". $data['umur_pasien']."</td>
                    <td>". $data['hp_pasien']."</td>
                    <td>". $data['keterangan']."</td>
                    <td>". $data['dokter_jaga']."</td>
                    <td>". $data['pengantar_pasien']."</td>
                    <td >". $data['nama_pengantar']."</td>
                    <td>". $data['hp_pengantar']."</td>
                    <td>". tanggal($data['tanggal'])."</td>
                    <td>". $data['alamat_pengantar']."</td>
                    <td>". $data['hubungan_dengan_pasien']."</td>";
      echo "</tr>";
      
      }
    ?>
  </tbody>
 </table>
</div><!--end div class="table-responsive"-->

<!-- AKHIR TABLE -->


</span>
</div> <!--container-->


    <script>
    
    $(document).ready(function(){
    $('table').DataTable();
    });
</script>

   <script>
   //untuk menampilkan data yang diambil pada form tbs penjualan berdasarkan id=formtambahproduk
  $("#daftar_ugd").click(function(){

    var no_rm = $("#no_rm").val();
    var rujukan = $("#rujukan").val();
    var token = $("#token").val();
    var penjamin = $("#penjamin").val();
    var nama_pasien = $("#nama_pasien").val();
    var jenis_kelamin = $("#jenis_kelamin").val();
    var tanggal_lahir = $("#tanggal_lahir").val();
    var umur = $("#umur").val();
    var gol_darah = $("#gol_darah").val();
    var no_hp = $("#no_hp").val();
    var alamat = $("#alamat").val();
    var alergi = $("#alergi").val();
    var kondisi = $("#kondisi").val();
    var eye = $("#eye").val();
    var verbal = $("#verbal").val();
    var motorik = $("#motorik").val();
    var pengantar = $("#pengantar").val();
    var hubungan_dengan_pasien = $("#hubungan_dengan_pasien").val();
    var nama_pengantar = $("#nama_pengantar").val();
    var alamat_pengantar = $("#alamat_pengantar").val();
    var hp_pengantar = $("#hp_pengantar").val();
    var keterangan = $("#keterangan").val();
    var dokter_jaga = $("#dokter_jaga").val();
    var cari_migrasi = $("#cari_migrasi").val();

       if ( no_rm == ""){
      alert("Pasien Belum Ada!");
      $("#cari_migrasi").focus();
    }
    else if(penjamin == ""){

    alert("Kolom Penjamin Harus Disi");
    
        }
        else if (rujukan == ""){

    alert("Kolom Rujukan Harus Disi");
    
        }
  
        else if (nama_pasien == ""){

    alert("Kolom Nama Pasien Harus Disi");
   
        }
        else if (jenis_kelamin == ""){

    alert("Kolom Jenis Kelamin Harus Disi");
   
        }
        else if (tanggal_lahir== ""){

    alert("Kolom Tanggal Lahir Harus Disi");
    $("#tanggal_lahir").focus();
        }
        else if (umur == ""){

    alert("Kolom Umur Harus Disi");
    
        }
        else if (gol_darah == ""){

    alert("Kolom Golongan Darah Harus Disi");
    $("#gol_darah").focus();
        }
        else if (eye == ""){

    alert("Kolom Respon Mata Harus Disi");
    $("#eye").focus();
        }
        else if (verbal == ""){

    alert("Kolom Respon Ucapan Harus Disi");
    $("#verbal").focus();
        }
        else if (motorik == ""){

    alert("Kolom Respon Gerak Harus Disi");
    $("#motorik").focus();
        }
        else if (dokter_jaga == ""){

    alert("Kolom Dokter Jaga Harus Disi");
    $("#dokter_jaga").focus();
    }

else{

  
 $.post("proses_ugd.php",{no_rm:no_rm,rujukan:rujukan,token:token,penjamin:penjamin,nama_pasien:nama_pasien,jenis_kelamin:jenis_kelamin,tanggal_lahir:tanggal_lahir,umur:umur,gol_darah:gol_darah,no_hp:no_hp,alamat:alamat,alergi:alergi,kondisi:kondisi,eye:eye,verbal:verbal,motorik:motorik,pengantar:pengantar,hubungan_dengan_pasien:hubungan_dengan_pasien,nama_pengantar:nama_pengantar,alamat_pengantar:alamat_pengantar,hp_pengantar:hp_pengantar,keterangan:keterangan,dokter_jaga:dokter_jaga},function(data){
     
     $("#demo").hide();
     $("#tbody").prepend(data);
     $("#rujukan").val('');
     $("#token").val('');
     $("#penjamin").val('');
     $("#nama_pasien").val('');
     $("#jenis_kelamin").val('');
     $("#tanggal_lahir").val('');
     $("#umur").val('');
     $("#gol_darah").val('');
     $("#no_hp").val('');
     $("#alamat").val('');
     $("#alergi").val('');
     $("#kondisi").val('');
     $("#eye").val('');
     $("#verbal").val('');
     $("#motorik").val('');
     $("#pengantar").val('');
     $("#hubungan_dengan_pasien").val('');
     $("#nama_pengantar").val('');
     $("#alamat_pengantar").val('');
     $("#hp_pengantar").val('');
     $("#keterangan").val('');
     $("#dokter_jaga").val('');

     
     });


} // end else {}
      
  });



    $("form").submit(function(){
    return false;
    
    });


   </script>

<!--script disable hubungan pasien-->
<script type="text/javascript">
$(document).ready(function(){
var pengantar = $("#pengantar").val();

if (pengantar == 'Datang Sendiri')
{
  $("#hubungan_dengan_pasien").attr("disabled", true);
  $("#nama_pengantar").attr("disabled", true);
  $("#alamat_pengantar").attr("disabled", true);
  $("#hp_pengantar").attr("disabled", true);

  $("#hubungan_dengan_pasien").val('');
  $("#nama_pengantar").val('');
  $("#alamat_pengantar").val('');
  $("#hp_pengantar").val('');

}

$("#pengantar").change(function(){

var pengantar = $("#pengantar").val();


if (pengantar == 'Datang Sendiri')
{
  $("#hubungan_dengan_pasien").attr("disabled", true);
  $("#nama_pengantar").attr("disabled", true);
  $("#alamat_pengantar").attr("disabled", true);
  $("#hp_pengantar").attr("disabled", true);

   $("#hubungan_dengan_pasien").val('');
  $("#nama_pengantar").val('');
  $("#alamat_pengantar").val('');
  $("#hp_pengantar").val('');

}

else if (pengantar == 'Diantar Keluarga/Family')
{
$("#hubungan_dengan_pasien").attr("disabled", false);
  $("#nama_pengantar").attr("disabled", false);
    $("#alamat_pengantar").attr("disabled", false);
  $("#hp_pengantar").attr("disabled", false);

 $("#hubungan_dengan_pasien").val('');
  $("#nama_pengantar").val('');
  $("#alamat_pengantar").val('');
  $("#hp_pengantar").val('');


}

else{
  $("#hubungan_dengan_pasien").val('');
$("#hubungan_dengan_pasien").attr("disabled", true);
  $("#nama_pengantar").attr("disabled", false);
    $("#alamat_pengantar").attr("disabled", false);
  $("#hp_pengantar").attr("disabled", false);
}

});


});
</script>

<script type="text/javascript">
$(document).ready(function(){

  $("#pasien_ugd_belum_selesai").hide();
  $("#kembali").show();
	$("#kembali").click(function(){
		window.location.href="registrasi_ugd.php";
    });
});
</script>

<!--script disable hubungan pasien
<script type="text/javascript">
$(document).ready(function(){
	$("#pasien_ugd_belum_selesai").hide();

  $("#coba").click(function(){
  $("#demo").show();
  $("#kembali").show();
  $("#pasien_ugd_belum_selesai").hide();
   $("#coba").hide();
  });
    $("#kembali").click(function(){
  $("#demo").hide();
  $("#coba").show();
  $("#pasien_ugd_belum_selesai").hide();
  $("#kembali").hide();

  });
});
</script>-->

<!--   script untuk detail layanan MERUJUK-->
<script type="text/javascript">
     $("#rujukkkk").click(function() {   
                    var reg = $("#reg").val();
                    var keterangan = $("#keterangan_rujuk").val();
                    var id = $(this).attr("data-id");
                    
                    
                    $("#modal_rujuk").modal('hide');
                    $(".tr-id-"+id+"").remove();
                    $.post("proses_rujuk_rs.php",{reg:reg, keterangan:keterangan},function(data){

                    });
                    
                    }); 

     
</script>
<!--  end script untuk akhir detail RUJUK-->


<!--   script untuk detail layanan pulang-->
<script type="text/javascript">
     $(".rujuk").click(function(){   
            var reg = $(this).attr('data-reg');
            var id = $(this).attr('data-id');

               $("#reg").val(reg);
               $("#rujukkkk").attr('data-id',id);
               $("#modal_rujuk").modal('show');
       });
</script>
<!--  end script untuk akhir detail pulang-->





<!--   script untuk detail layanan pulang-->
<script type="text/javascript">
     $(".pulang_rumah").click(function(){   
            var reg = $(this).attr('data-reg');
            var id = $(this).attr('data-id');

               $("#reg2").val(reg);
               $("#pulang").attr('data-id',id);
               $("#modal_pulang").modal('show');
       });
</script>
<!--  end script untuk akhir detail pulang-->


<!--   script untuk detail layanan MERUJUK ri-->
<script type="text/javascript">
     $(".rujuk_ri").click(function(){   
            var reg = $(this).attr('data-reg');

              $("#rujuk_ranap").attr('href', 'rujuk_rawat_inap.php?no_reg='+reg);
               $("#modal_rujuk_ri").modal('show');
          
            });
//            tabel lookup mahasiswa         
</script>
<!--  end script untuk akhir detail RUJUK ri-->

<!--   script untuk detail layanan MERUJUK-->
<script type="text/javascript">
     $("#pulang").click(function() {   
                    var reg = $("#reg2").val();
                    var keterangan = $("#keterangan_pulang").val();
                    var id = $(this).attr("data-id");
                    
                    
                    $("#modal_pulang").modal('hide');
                    $(".tr-id-"+id+"").remove();
                    $.post("proses_pulang_rumah.php",{reg:reg, keterangan:keterangan},function(data){

                    });
                    
        }); 

     
</script>
<!--  end script untuk akhir detail RUJUK-->

<!--script ambil data dari modal pasien-->
<script type="text/javascript">

//jika dipilih, nim akan masuk ke input dan modal di tutup
            $(document).on('click', '.pilih', function (e) {
                document.getElementById("no_rm").value = $(this).attr('data-no');
                document.getElementById("no_hp").value = $(this).attr('data-hp');
                document.getElementById("nama_pasien").value = $(this).attr('data-nama');
                document.getElementById("tanggal_lahir").value = $(this).attr('data-lahir');
                document.getElementById("alamat").value = $(this).attr('data-alamat');
                document.getElementById("jenis_kelamin").value = $(this).attr('data-jenis-kelamin');
               document.getElementById("penjamin").value = $(this).attr('data-penjamin');
               document.getElementById("gol_darah").value = $(this).attr('data-darah');

                        $("#hasil_migrasi").html('');
                         $("#no_rm").focus();


  var tanggal_lahir = $("#tanggal_lahir").val();

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

//tabel lookup mahasiswa
 </script>
<!--end script ambil data dari modal pasien-->


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


<script type="text/javascript">
//berfunsi untuk mencekal username ganda
 $(document).ready(function(){
  $(document).on('click', '.pilih', function (e) {
    var no_rm = $("#no_rm").val();
    var nama_pasien = $("#nama_pasien").val();

 $.post('cek_data_pasien_ugd.php',{no_rm:no_rm,nama_pasien:nama_pasien}, function(data){
  
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


<?php include 'footer.php'; ?>