<?php 

    include 'sanitasi.php';
    include 'db.php';
    

?>

<div class="table-responsive">
        <!-- membuat agar ada garis pada tabel, disetiap kolom-->
<table id="tableuser" class="table table-sm">
        <thead> <!-- untuk memberikan nama pada kolom tabel -->
        
        <th>Kode Jasa </th>
        <th>Nama Pemeriksaan </th>
        <th>Kelompok Pemeriksaan</th>
        <th>Persiapan</th>
        <th>Metode</th>
        <th>Harga 1</th>
        <th>Harga 2</th>
        <th>Harga 3</th>
        <th>Harga 4</th>
        <th>Harga 5</th>
        <th>Harga 6</th>   
        <th>Harga 7</th>  
        
        </thead> <!-- tag penutup tabel -->
        
        <tbody> <!-- tag pembuka tbody, yang digunakan untuk menampilkan data yang ada di database --> 
<?php
 
        $query = $db->query("SELECT bl.nama AS nambid,jl.id,jl.bidang,jl.kode_lab,jl.nama,jl.persiapan,jl.metode,jl.harga_1,jl.harga_2,jl.harga_3,jl.harga_4,jl.harga_5,jl.harga_6,jl.harga_7 FROM jasa_lab jl INNER JOIN bidang_lab bl ON jl.bidang = bl.id ORDER BY jl.id DESC");
        
       while($data = mysqli_fetch_array($query))
      
      {
        
        // menampilkan data
        echo "<tr class='pilih' data-kode='".$data['kode_lab']."(".$data['nama'].")' data-id-jasa='".$data['id']."' data-nama='".$data['nama']."' data-bidang='".$data['bidang']."' data-1='".$data['harga_1']."' data-2='".$data['harga_2']."' data-3='".$data['harga_3']."' data-4='".$data['harga_4']."' data-5='".$data['harga_5']."' data-6='".$data['harga_6']."' data-7='".$data['harga_7']."'>

       <td>". $data['kode_lab']."</td>
       <td>". $data['nama']."</td>
       <td>". $data['nambid']."</td>
       <td>". $data['persiapan']."</td>
       <td>". $data['metode']."</td>
       <td>". $data['harga_1']."</td>
       <td>". $data['harga_2']."</td>
       <td>". $data['harga_3']."</td>
       <td>". $data['harga_4']."</td>
       <td>". $data['harga_5']."</td>
       <td>". $data['harga_6']."</td>  
       <td>". $data['harga_7']."</td> 
            </tr>";
      
         }
//Untuk Memutuskan Koneksi Ke Database
mysqli_close($db);   
?>
    
        </tbody> <!--tag penutup tbody-->
        
        </table> <!-- tag penutup table-->
        </div>
        
<script type="text/javascript">
  $(function () {
  $("#tableuser").dataTable();
  });
</script>
