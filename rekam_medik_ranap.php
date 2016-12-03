<?php include 'session_login.php';
include 'header.php';
include 'navbar.php';
include 'db.php';
include_once 'sanitasi.php';


$query = $db->query("SELECT rekam_medik_inap.jam,rekam_medik_inap.no_reg,rekam_medik_inap.no_rm,rekam_medik_inap.nama,
rekam_medik_inap.alamat,rekam_medik_inap.umur,rekam_medik_inap.jenis_kelamin,rekam_medik_inap.poli,rekam_medik_inap.dokter,
rekam_medik_inap.dokter_penanggung_jawab,rekam_medik_inap.bed,rekam_medik_inap.group_bed,rekam_medik_inap.tanggal_periksa,rekam_medik_inap.id FROM rekam_medik_inap INNER JOIN registrasi ON rekam_medik_inap.no_reg = registrasi.no_reg WHERE registrasi.status != 'Batal Rawat Inap' AND rekam_medik_inap.status IS NULL ORDER BY rekam_medik_inap.id DESC ");

$pilih_akses_rekam_medik = $db->query("SELECT rekam_medik_ri_lihat, rekam_medik_ri_tambah, rekam_medik_ri_edit, rekam_medik_ri_hapus FROM otoritas_rekam_medik WHERE id_otoritas = '$_SESSION[otoritas_id]'");
$rekam_medik = mysqli_fetch_array($pilih_akses_rekam_medik);


 ?>
<div style="padding-left: 5%; padding-right: 5%">
 <h3>DATA REKAM MEDIK RAWAT INAP</h3><hr>

<!-- akhir menu rekam medik -->
<ul class="nav nav-tabs md-pills pills-ins" role="tablist">
<?php if ($rekam_medik['rekam_medik_ri_tambah'] > 0): ?>
  
      <li class="nav-item"><a href="tambah_rekam_medik_ri.php" id="link" class="btn btn-success" > <i class="fa fa-plus"></i> Tambah Rekam Medik</a></li>

<?php endif ?>
      <li class="nav-item"><a class="nav-link active" href='rekam_medik_ranap.php'> Pencarian Rekam Medik </a></li>
      <li class="nav-item"><a class="nav-link " href='filter_rekam_medik_ranap.php' > Filter Rekam Medik </a></li>
</ul>
<br>

<style>

tr:nth-child(even){background-color: #f2f2f2}

</style>


<span id="tmpl-form">

 <div class="table-responsive">
<table id="table_inap" class="table table-bordered table-sm">
 
    <thead>
      <tr>
         <th style='background-color: #4CAF50; color: white' >No Reg </th>
         <th style='background-color: #4CAF50; color: white' >No RM  </th>
         <th style='background-color: #4CAF50; color: white' >Nama</th>
         <th style='background-color: #4CAF50; color: white' >Alamat</th>
         <th style='background-color: #4CAF50; color: white' >Umur</th>
         <th style='background-color: #4CAF50; color: white' >Jenis Kelamin</th> 
         <th style='background-color: #4CAF50; color: white' >Poli</th>
         <th style='background-color: #4CAF50; color: white' >Dokter Penanggung Jawab</th>
         <th style='background-color: #4CAF50; color: white' >Dokter Pelaksana </th>
         <th style='background-color: #4CAF50; color: white' >Bed </th>
         <th style='background-color: #4CAF50; color: white' >Kamar</th>
         <th style='background-color: #4CAF50; color: white' >Jam</th>
         <th style='background-color: #4CAF50; color: white' >Tanggal Periksa</th>
         <th style='background-color: #4CAF50; color: white' >Aksi Rekam Medik</th>
         <th style='background-color: #4CAF50; color: white' >Selesai</th>
    </tr>
    </thead>
    <tbody>
    
   <?php 

while($data = mysqli_fetch_array($query))
      
      {
      echo 
      "<tr>
      <td>". $data['no_reg']."</td>
      <td>". $data['no_rm']."</td>
      <td>". $data['nama']."</td>
      <td>". $data['alamat']."</td>
      <td>". $data['umur']."</td>
      <td>". $data['jenis_kelamin']."</td>     
      <td>". $data['poli']."</td>
      <td>". $data['dokter']."</td>
      <td>". $data['dokter_penanggung_jawab']."</td>
      <td>". $data['bed']."</td>
      <td>". $data['group_bed']."</td>
      <td>". $data['jam']."</td>
      <td>". tanggal($data['tanggal_periksa'])."</td>";

      if ($rekam_medik['rekam_medik_ri_lihat'] > 0) {
                      echo "<td><a href='input_rekam_medik_ranap.php?no_reg=".$data['no_reg']."&tgl=".$data['tanggal_periksa']."&jam=".$data['jam']."&id=".$data['id']."' class='btn-floating btn-info btn-small'><i class='fa fa-medkit '></i></a></td>";

                      $table23 = $db->query("SELECT status FROM penjualan WHERE no_reg = '$data[no_reg]' ");
                      $dataki = mysqli_fetch_array($table23);
                      
                      if ($dataki['status'] == 'Lunas' OR  $dataki['status'] == 'Piutang'  OR  $dataki['status'] == 'Piutang Apotek')
                      
                      {
                      
                      
                      echo 
                      "<td><a href ='selesai_ri.php?no_reg=".$data['no_reg']."&id=".$data['id']."' class='btn-floating btn-info btn-small'><i class='fa fa-check'></i>  </a></td>";
                      }
                      else
                      { 
                      
                      echo "<td></td>"; 
                      
                      }
        }

      else{
        echo "<td></td>";
        echo "<td></td>";
      }

           echo  
              "</tr>";
      }
    ?>
  </tbody>
 </table>
</div><!-- table responsive  -->
</span>  
</div>


<!--datatable-->
<script type="text/javascript">
  $(function () {
  $("table").dataTable({"ordering": false});
  }); 
</script>
<!--end datatable-->


<?php 
  include 'footer.php';
?>