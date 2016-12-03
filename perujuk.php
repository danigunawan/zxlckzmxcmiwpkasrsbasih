<?php include 'session_login.php';

include 'header.php';
include 'navbar.php';
include 'db.php';
include 'sanitasi.php';


// AKHIR untuk FEGY NATION
?>
<div class="container">
<style>

tr:nth-child(even){background-color: #f2f2f2}

</style>

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
        <button type="submit" class="btn btn-success" id="yesss" >Yes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
    </div>
    </div>
  </div>
</div>
<!--modal end Confirm Delete-->


<h3><b> DATA PERUJUK </b></h3> <hr>
   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal"><i class="fa fa-plus"></i> PERUJUK </button>
 <br>
<br>


<span id="table_baru"> 
<div class="table-responsive">

<table id="table-pelamar" class="table table-bordered">
    <thead>
      <tr class='tr-idp'>
         <th style="background-color: #4CAF50; color: white;" >Nama </th>
         <th style="background-color: #4CAF50; color: white;" >Alamat</th>
         <th style="background-color: #4CAF50; color: white;" >No Telp</th>
         <th style="background-color: #4CAF50; color: white;" >Edit</th>
         <th style="background-color: #4CAF50; color: white;" >Hapus</th>
    </tr>
    </thead>
    <tbody id="tbody">
    
   <?php 

$query = $db->query("SELECT * FROM perujuk ORDER BY id DESC ");

   while($data = mysqli_fetch_array($query))
      {
      echo "<tr class='tr-id-".$data['id']."'>
      <td >". $data['nama']."</td>
      <td>". $data['alamat']."</td>
      <td>". $data['no_telp']."</td>
      <td><a href='edit_perujuk.php?id=".$data['id']."'class='btn btn-warning'><span class='glyphicon glyphicon-wrench'></span> Edit </a>
      </td>
      <td><button data-id='".$data['id']."' class='btn btn-danger delete'><span class='glyphicon glyphicon-trash'></span> Hapus </button>
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
          <h4 class="modal-title">Form Tambah Perujuk</h4>
        </div>
        <div class="modal-body">

          <form role="form" action="proses_perujuk.php" method="POST">

<div class="form-group">
  <label for="sel1">Nama </label>
  <input type="text" class="form-control" id="nama" name="nama">
</div>

<div class="form-group">
  <label for="sel1">Alamat</label>
  <input type="text" class="form-control" id="alamat" name="alamat">
</div>


<div class="form-group">
  <label for="sel1">No Telp</label>
  <input type="decimal" class="form-control" id="no_telp" name="no_telp">
</div>

<button type="submit" class="btn btn-info"><i class="fa fa-plus"></i> Tambah</button>
</form>

</div>
    <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


</div><!--CONTAINER-->



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

$.post('delete_perujuk.php',{id:id},function(data){

      $("#modale-delete").modal('hide');
      $(".tr-id-"+id+"").remove();
    });
});
</script>
<!--  end modal confirmasi delete lanjutan  -->


<script>

$(document).ready(function(){
    $('#table-pelamar').DataTable();
});

</script>


<?php 
include 'footer.php';
?>