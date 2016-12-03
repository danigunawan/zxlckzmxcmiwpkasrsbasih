<?php include 'session_login.php';
include 'header.php';
include 'navbar.php';
include 'db.php';
include_once 'sanitasi.php';






// AKHIR untuk FEGY NATION

?>
<div class="container">

<style>

tr:nth-child(even){background-color: #f2f2f2}

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
        
        <button type="button" class="btn btn-danger" data-dismiss="modal">Closed</button>
    </div>
    </div>
  </div>
</div>
<!--modal end Layanan Perusahaan-->


<!-- Modal Untuk Confirm Delete-->
<div id="modale-delete" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>       
    </div>
    <div class="modal-body">
      <center><h4>Apakah Anda Yakin Ingin Menghapus Data Ini ?</h4></center>
      <input type="hidden" id="id2" name="id2">
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="yessss" >Yes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
    </div>
    </div>
  </div>
</div>
<!--modal end Confirm Delete-->


<h3><b> DATA PENJAMIN </b></h3> <hr>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal"><span class="fa fa-plus"></span> Penjamin </button>
<br>
<br>


<span id="table_baru">
<div class="table-responsive">  
<table id="table-pelamar" class="table table-bordered">
    <thead>
      <tr>

        <th style='background-color: #4CAF50; color: white; '>Nama </th>    
        <th style='background-color: #4CAF50; color: white; '>Alamat</th>
        <th style='background-color: #4CAF50; color: white; '>No Telp</th>
        <th style='background-color: #4CAF50; color: white; '>Level Harga</th>
        <th style='background-color: #4CAF50; color: white; '>Penetapan Jatuh Tempo</th>
        <th style='background-color: #4CAF50; color: white; '>Lihat Cakupan Layanan</th>
        <th style='background-color: #4CAF50; color: white; '>Edit</th>
        <th style='background-color: #4CAF50; color: white; '>Hapus</th>

    </tr>
    </thead>
    <tbody>
    
   <?php 

   $query = $db->query("SELECT * FROM penjamin ORDER BY id DESC ");
   while($data = mysqli_fetch_array($query))  
      {
      echo 
      "<tr class='tr-id-".$data['id']."'>

      <td>". $data['nama']."</td>
      <td>". $data['alamat']."</td>
      <td>". $data['no_telp']."</td>
      <td>". $data['harga']."</td>";
      ?>
      
      <?php if ($data['jatuh_tempo'] == ''){
        echo "<td>". $data['jatuh_tempo']."</td>";
      }
      else
      {
          echo "<td>". $data['jatuh_tempo']." Hari </td>";
      }
      ?>

      <?php 

      echo" <td><button class='btn btn-success detaili' data-id='".$data['id']."'><span class='glyphicon glyphicon-list'></span> Lihat Layanan </button>
      </td>
      <td><a href='edit_penjamin.php?id=".$data['id']."'class='btn btn-warning'><span class='glyphicon glyphicon-wrench'></span> Edit </a>
      </td>
      <td><button class='btn btn-danger delete' data-id='".$data['id']."'><span class='glyphicon glyphicon-trash'></span> Hapus </button>
      </td>

      </tr>";
      
      }
    ?> 
  </tbody>
 </table>
</div> <!-- DIV TABLE RESPONSIVE  -->
</span>
</div>

<!-- Modal tam,bnah penjamin-->
  <div class="modal fade" id="modal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h1 class="modal-title">Form Tambah Penjamin</h1>
        </div>
      <div class="modal-body">

<form role="form" action="proses_tambah_penjamin.php" method="POST">

<div class="form-group">
  <label for="sel1">Nama Penjamin</label>
  <input type="text" class="form-control" id="nama" name="nama"  required="" autocomplete="off">
</div>

<div class="form-group">
  <label for="sel1">Alamat Penjamin</label>
  <textarea class="form-control" id="alamat" name="alamat" required="" autocomplete="off"></textarea>
</div>

<div class="form-group">
  <label for="sel1">No Telpon</label>
  <input type="text" style="height: 20px" class="form-control" id="no_telp" name="no_telp" required="" autocomplete="off">
</div>


<div class="form-group">
  <label for="sel1">Level Harga</label>
  <select class="form-control" id="level_harga" required="" name="level_harga" autocomplete="off">
        <option value="">Silakan Pilih</option> 
        <option value="harga_1">Level 1</option> 
        <option value="harga_2">Level 2</option> 
        <option value="harga_3">Level 3</option> 
        <option value="harga_4">Level 4</option> 
        <option value="harga_5">Level 5</option> 
        <option value="harga_6">Level 6</option> 
        <option value="harga_7">Level 7</option> 

</select>
</div>


<div class="form-group">
    <label for="penjamin">Penetapan Jatuh Tempo:</label>
    <input type="number" class="form-control" id="jatuh_tempo" name="jatuh_tempo" placeholder="Isi Jika ada Perjanjian Tanggal Jatuh Tempo" autocomplete="off">
</div>

<div class="form-group">
  <label for="sel1">Cakupan Layanan</label>
  <textarea class="form-control" id="layanan" name="layanan" style="height:500px"></textarea>
</div>

<button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> Tambah</button>
</form>

        </div>
        <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>    
</div>
</div>
</div>  <!-- container  -->



<script>

$(document).ready(function(){
    $('#table-pelamar').DataTable();
});

</script>

<!--   script untuk detail layanan -->
<script type="text/javascript">

//            jika dipilih, nim akan masuk ke input dan modal di tutup
            $(document).on('click', '.detaili', function (e) {
              
               
                var id = $(this).attr('data-id');
               
                $.post("detail_layanan_perusahaan.php",{id:id},function(data){
                    $("#tampil_layanan").html(data);
               $("#detail").modal('show');
          
                });

               
            });
      

//            tabel lookup mahasiswa
            
          
</script>
<!--  end script untuk akhir detail layanan  -->


<!--   script modal confirmasi delete -->
<script type="text/javascript">
$(".delete").click(function(){

  var id = $(this).attr('data-id');

$("#modale-delete").modal('show');
$("#id2").val(id);  

});


</script>
<!--   end script modal confiormasi dellete -->

<!--  script modal  lanjkutan confiormasi delete -->
<script type="text/javascript">
$("#yessss").click(function(){

var id = $("#id2").val();

$.post('delete_penjamin.php',{id:id},function(data){

      $("#modale-delete").modal('hide');
      $(".tr-id-"+id+"").remove();

    });

});
</script>
<!--  end modal confirmasi delete lanjutan  -->


<script type="text/javascript">
$(function () {
 $("#layanan").wysihtml5();

});
</script>



<!--FOOTER-->
<?php 
include 'footer.php';
?>
<!--END FOOTER-->