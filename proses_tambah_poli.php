<?php 
include 'db.php';
include_once 'sanitasi.php';


$nama = stringdoang($_POST['nama']);


$query = $db->prepare("INSERT INTO poli (nama) VALUES (?) ");

$query->bind_param("s",$nama);

$query->execute();

    if (!$query) 
    {
    die('Query Error : '.$db->errno.
    ' - '.$db->error);
    }
	    else{

	 }



$query00 = $db->query("SELECT * FROM poli ORDER BY id DESC LIMIT 1");

// AKHIR untuk FEGY NATION


   $data = mysqli_fetch_array($query00);     

      echo "<tr>
      <td class='edit-nama' data-id='".$data['id']."'><span id='text-nama-".$data['id']."'>". $data['nama'] ."</span> <input type='hidden' id='input-nama-".$data['id']."' value='".$data['nama']."' class='input_nama' data-id='".$data['id']."' autofocus=''> </td>
      
      <td><button data-id=".$data['id']."' class='btn btn-danger delete'><span class='glyphicon glyphicon-trash'></span> Hapus </button>
      </td>
      </tr>";

    ?>

    <script type="text/javascript">
                                 
                                 $(".edit-nama").dblclick(function(){

                                    var id = $(this).attr("data-id");

                                    $("#text-nama-"+id+"").hide();

                                    $("#input-nama-"+id+"").attr("type", "text");

                                 });

                                 $(".input_nama").blur(function(){

                                    var id = $(this).attr("data-id");

                                    var input_nama = $(this).val();


                                    $.post("update_data_poli.php",{id:id, input_nama:input_nama,jenis_edit:"nama_poli"},function(data){

                                    $("#text-nama-"+id+"").show();
                                    $("#text-nama-"+id+"").text(input_nama);

                                    $("#input-nama-"+id+"").attr("type", "hidden");           

                                    });
                                 });

                             </script>