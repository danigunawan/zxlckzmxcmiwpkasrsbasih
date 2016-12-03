<?php include 'session_login.php';
include 'header.php';
include 'navbar.php';
include 'db.php';
include_once 'sanitasi.php';




?>


<div class="container">

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
      <input type="text" id="id2" name="id2">
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="yesss" >Yes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
    </div>
    </div>
  </div>
</div>
<!--modal end Confirm Delete-->

<h3><b> DATA KAMAR </b></h3> <hr>
  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal"><i class="fa fa-plus"> </i> KAMAR </button>
<br>
<br>


<br>

<style>

tr:nth-child(even){background-color: #f2f2f2}

</style>

<span id="table_baru">
<div class="table-responsive"> 
<table id="table-pelamar" class="table table-bordered">
    <thead>
      <tr>
         <th style='background-color: #4CAF50; color: white; '>Kelas</th>
         <th style='background-color: #4CAF50; color: white; '>Kode Kamar</th>
         <th style='background-color: #4CAF50; color: white; '>Nama Kamar </th>
         <th style='background-color: #4CAF50; color: white; '>Harga 1</th>
         <th style='background-color: #4CAF50; color: white; '>Harga 2</th>
         <th style='background-color: #4CAF50; color: white; '>Harga 3</th>
         <th style='background-color: #4CAF50; color: white; '>Harga 4</th>
         <th style='background-color: #4CAF50; color: white; '>Fasilitas</th>
         <th style='background-color: #4CAF50; color: white; '>Jumlah Bed</th>
         <th style='background-color: #4CAF50; color: white; '>Sisa Bed</th>
         <th style='background-color: #4CAF50; color: white; '>Edit</th>
         <th style='background-color: #4CAF50; color: white; '>Hapus</th>
    </tr>
    </thead>
    <tbody> 
   <?php 
   $query = $db->query("SELECT * FROM bed ORDER BY id DESC ");
   while($data = mysqli_fetch_array($query))
      {
      echo 
      "<tr class='tr-id-".$data['id']."'>

      <td>". $data['kelas']."</td>
            <td>". $data['nama_kamar']."</td>
      <td>". $data['group_bed']."</td>
      <td>". rp($data['tarif'])."</td>
      <td>". rp($data['tarif_2'])."</td>
      <td>". rp($data['tarif_3'])."</td>
      <td>". rp($data['tarif_4'])."</td>
      <td>". $data['fasilitas']."</td>
      <td>". $data['jumlah_bed']."</td>
      <td>". $data['sisa_bed']."</td>

      <td><a href='edit_kamar.php?id=".$data['id']."'class='btn btn-warning ><span class='glyphicon glyphicon-wrench'></span> Edit </a>
      </td>

      <td><button class='btn btn-danger delete'  data-id='".$data['id']."'><span class='glyphicon glyphicon-trash'></span> Hapus </button>
      </td>
      </tr>";
      }
    ?>
  </tbody>
 </table>
</div>


</span>



<!-- Modal -->
  <div class="modal fade" id="modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Form Tambah Kamar</h4>
        </div>
        <div class="modal-body">

          <form role="form" action="proses_bed.php" method="POST">


<div class="form-group">
  <label for="sel1">Kelas</label>
  <select class="form-control" id="kelas" name="kelas" autocomplete="off" required="">
    <option value="">Silakan Pilih</option>
    <option value="Kelas VVIP">Kelas VVIP</option>
    <option value="Kelas VIP">Kelas VIP</option>
    <option value="Kelas I">Kelas I</option>
    <option value="Kelas II">Kelas II</option>
    <option value="Kelas III">Kelas III</option>
    <option value="Kelas IV">Kelas IV</option>
    <option value="Kelas V">Kelas V</option>
    <option value="Kelas VI">Kelas VI</option>
    <option value="Kelas VII">Kelas VII</option>
    <option value="Kelas VIII">Kelas VIII</option>
    <option value="Kelas IX">Kelas IX</option>
    <option value="Kelas X">Kelas X</option>

  </select>
</div>

<div class="form-group">
  <label for="sel1">Kode Kamar</label>
  <input type="text" class="form-control" style="height: 20px" id="nama_kamar" name="nama_kamar" required="" autocomplete="off">
</div>

<div class="form-group">
  <label for="sel1">Nama Kamar</label>
  <input type="text"  class="form-control" style="height: 20px" id="grup_kamar" name="grup_kamar" required="" autocomplete="off">
 </div>


<div class="form-group">
  <label for="sel1">Harga 1</label>
  <input type="text" class="form-control" style="height: 20px" id="tarif" name="tarif" required="" autocomplete="off">
</div>


<div class="form-group">
  <label for="sel1">Harga 2</label>
  <input type="text" class="form-control" style="height: 20px" id="tarif_2" name="tarif_2" required="" autocomplete="off">
</div>


<div class="form-group">
  <label for="sel1">Harga 3</label>
  <input type="text" class="form-control" style="height: 20px" id="tarif_3" name="tarif_3" required="" autocomplete="off">
</div>

<div class="form-group">
  <label for="sel1">Harga 4</label>
  <input type="text" class="form-control" style="height: 20px" id="tarif_4" name="tarif_4" required="" autocomplete="off">
</div>

<div class="form-group">
  <label for="sel1">Harga 5</label>
  <input type="text" class="form-control" style="height: 20px" id="tarif_5" name="tarif_5" required="" autocomplete="off">
</div>

<div class="form-group">
  <label for="sel1">Harga 6</label>
  <input type="text" class="form-control" style="height: 20px" id="tarif_6" name="tarif_6" required="" autocomplete="off">
</div>

<div class="form-group">
  <label for="sel1">Harga 7</label> 
  <input type="text" class="form-control" style="height: 20px" id="tarif_7" name="tarif_7" required="" autocomplete="off">
</div>

<div class="form-group">
  <label for="sel1">Fasilitas</label>
  <input type="text" class="form-control" style="height: 20px" id="fasilitas" name="fasilitas" required="" autocomplete="off">
</div>

<div class="form-group">
  <label for="sel1">Jumlah Bed</label>
  <input type="number" class="form-control" style="height: 20px" id="jumlah_bed" name="jumlah_bed" required="" autocomplete="off">
</div>

<button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> Tambah</button>
</form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


</div><!--CONTAINER-->



<script>

$(document).ready(function(){
    $('.table').DataTable();
});

</script>


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
$("#yesss").click(function(){

var id = $("#id2").val();

$.post('delete_kamar.php',{id:id},function(data){

      $("#modale-delete").modal('hide');
      $(".tr-id-"+id+"").remove(); // ini table baru setelah proses confirm delete (tampilan)

    });

});
</script>
<!--  end modal confirmasi delete lanjutan  -->


<!--FOOTER-->
<?php 
include 'footer.php';
?>
<!--END FOOTER-->