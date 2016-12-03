<?php 
include 'db.php';
include 'sanitasi.php';

 $reg = stringdoang($_POST['reg_before']); 
 $bed_before = stringdoang($_POST['bed_before']); 
 $group_bed_before = stringdoang($_POST['group_bed_before']); 
 $group_bed2 = stringdoang($_POST['group_bed2']); 
 $bed2 = stringdoang($_POST['bed2']); 
 $id = angkadoang($_POST['id']);


$jam =  date("H:i:s");
$tanggal_sekarang = date("Y-m-d");
$waktu = date("Y-m-d H:i:s");


$update_reg = $db->query("UPDATE registrasi SET bed = '$bed2', group_bed = '$group_bed2' WHERE no_reg = '$reg'");

$update_kamar = $db->query("UPDATE bed SET sisa_bed = sisa_bed + 1 WHERE nama_kamar = '$bed_before' AND group_bed = '$group_bed_before'");
$up_bed = $db->query("UPDATE bed SET sisa_bed = sisa_bed - 1 WHERE nama_kamar = '$bed2' AND group_bed = '$group_bed2'");





// ambil penjamin dari registrasi
$regis = $db->query("SELECT penjamin FROM registrasi WHERE no_reg = '$reg' ");
$keluar2 = mysqli_fetch_array($regis);
// ambil penjamin dari registrasi


// ambil bahan untuk kamar 
$query20 = $db->query(" SELECT * FROM penjamin WHERE nama = '$keluar2[penjamin]'");
$data20  = mysqli_fetch_array($query20);
$level_harga = $data20['harga'];


$cari_harga_kamar = $db->query("SELECT tarif,tarif_2,tarif_3,tarif_4,tarif_5,tarif_6,tarif_7 FROM bed WHERE nama_kamar = '$bed2' AND group_bed = '$group_bed2' ");
$kamar_luar = mysqli_fetch_array($cari_harga_kamar);
$harga_kamar1 = $kamar_luar['tarif'];
$harga_kamar2 = $kamar_luar['tarif_2'];
$harga_kamar3 = $kamar_luar['tarif_3'];
$harga_kamar4 = $kamar_luar['tarif_4'];
$harga_kamar5 = $kamar_luar['tarif_5'];
$harga_kamar6 = $kamar_luar['tarif_6'];
$harga_kamar7 = $kamar_luar['tarif_7'];

//end bahan untuk kamar




$delete_bed_lama = $db->query("DELETE FROM tbs_penjualan WHERE kode_barang = '$bed_before' AND no_reg = '$reg' ");





// harga_1 (pertama)
if ($level_harga == 'harga_1')
    {

$subtotal = 1 * $harga_kamar1;


$query65 = "INSERT INTO tbs_penjualan (no_reg,kode_barang,nama_barang,jumlah_barang,harga,subtotal,tipe_barang,potongan,tax)
 VALUES ('$reg','$bed2','$group_bed2','1','$harga_kamar1','$subtotal','Jasa','0','0')";
      if ($db->query($query65) === TRUE) 
      {
  
      } 
        else 
      {
    echo "Error: " . $query65 . "<br>" . $db->error;
      }


    }
//end harga_1 (pertama)

// harga_2 (pertama)
else if ($level_harga == 'harga_2')
{

$subtotal = 1 * $harga_kamar2;


$query65 = "INSERT INTO tbs_penjualan (no_reg,kode_barang,nama_barang,jumlah_barang,harga,subtotal,tipe_barang,potongan,tax)
 VALUES ('$reg','$bed2','$group_bed2','1','$harga_kamar2','$subtotal','Jasa','0','0')";
      if ($db->query($query65) === TRUE) 
      {
  
      } 
        else 
      {
    echo "Error: " . $query65 . "<br>" . $db->error;
      }


}
//end harga_2 (pertama)


// harga_3 (pertama)
else if ($level_harga == 'harga_3')
{

$subtotal = 1 * $harga_kamar3;


$query65 = "INSERT INTO tbs_penjualan (no_reg,kode_barang,nama_barang,jumlah_barang,harga,subtotal,tipe_barang,potongan,tax)
 VALUES ('$reg','$bed2','$group_bed2','1','$harga_kamar3','$subtotal','Jasa','0','0')";
      if ($db->query($query65) === TRUE) 
      {
  
      } 
        else 
      {
    echo "Error: " . $query65 . "<br>" . $db->error;
      }


}

// harga_3 (pertama)
else if ($level_harga == 'harga_4')
{

$subtotal = 1 * $harga_kamar4;


$query65 = "INSERT INTO tbs_penjualan (no_reg,kode_barang,nama_barang,jumlah_barang,harga,subtotal,tipe_barang,potongan,tax)
 VALUES ('$reg','$bed2','$group_bed2','1','$harga_kamar4','$subtotal','Jasa','0','0')";
      if ($db->query($query65) === TRUE) 
      {
  
      } 
        else 
      {
    echo "Error: " . $query65 . "<br>" . $db->error;
      }


}

// harga_3 (pertama)
else if ($level_harga == 'harga_5')
{

$subtotal = 1 * $harga_kamar5;


$query65 = "INSERT INTO tbs_penjualan (no_reg,kode_barang,nama_barang,jumlah_barang,harga,subtotal,tipe_barang,potongan,tax)
 VALUES ('$reg','$bed2','$group_bed2','1','$harga_kamar5','$subtotal','Jasa','0','0')";
      if ($db->query($query65) === TRUE) 
      {
  
      } 
        else 
      {
    echo "Error: " . $query65 . "<br>" . $db->error;
      }


}

// harga_3 (pertama)
else if ($level_harga == 'harga_6')
{

$subtotal = 1 * $harga_kamar6;


$query65 = "INSERT INTO tbs_penjualan (no_reg,kode_barang,nama_barang,jumlah_barang,harga,subtotal,tipe_barang,potongan,tax)
 VALUES ('$reg','$bed2','$group_bed2','1','$harga_kamar6','$subtotal','Jasa','0','0')";
      if ($db->query($query65) === TRUE) 
      {
  
      } 
        else 
      {
    echo "Error: " . $query65 . "<br>" . $db->error;
      }


}

// harga_3 (pertama)
else if ($level_harga == 'harga_7')
{

$subtotal = 1 * $harga_kamar7;


$query65 = "INSERT INTO tbs_penjualan (no_reg,kode_barang,nama_barang,jumlah_barang,harga,subtotal,tipe_barang,potongan,tax)
 VALUES ('$reg','$bed2','$group_bed2','1','$harga_kamar7','$subtotal','Jasa','0','0')";
      if ($db->query($query65) === TRUE) 
      {
  
      } 
        else 
      {
    echo "Error: " . $query65 . "<br>" . $db->error;
      }


}

?>
  <?php 
$query7 = $db->query("SELECT * FROM registrasi WHERE jenis_pasien = 'Rawat Inap' AND status = 'menginap' AND status != 'Batal Rawat Inap' AND tanggal = '$tanggal_sekarang' AND id = '$id' ORDER BY id DESC LIMIT 1");
$data = mysqli_fetch_array($query7);
      
      
      echo "<tr class='tr-id-".$data['id']."'>
            <td>". $data['no_rm']."</td>
            <td>". $data['no_reg']."</td>
            <td>". $data['status']."</td>           
            <td>". $data['nama_pasien']."</td>
            <td>". $data['jam']."</td>           
            <td>". $data['penjamin']."</td>           
            <td>". $data['poli']."</td>
            <td>". $data['dokter_pengirim']."</td>
            <td>". $data['dokter']."</td>           
            <td>". $data['bed']."</td>
            <td>". $data['group_bed']."</td>
            <td>". tanggal($data['tanggal_masuk'])."</td>            
            <td>". $data['penanggung_jawab']."</td>
            <td>". $data['umur_pasien']."</td> 

            <td><a style='width:95px;' href='form-rujuk-lab-ri.php?no_reg=".$data['no_reg']."' class='btn btn-success'><i class='fa fa-hand-pointer-o'></i> Rujuk Lab</a></td>
          <td> <button style='width:120px;'  type='button' data-reg='".$data['no_reg']."' data-bed='".$data['bed']."' data-group-bed='".$data['group_bed']."' data-id='".$data['id']."' data-reg='".$data['no_reg']."'  class='btn btn-warning pindah'><i class='fa fa-reply'> Pindah Kamar</button></td>
          <td><a href ='keterangan_batal_rawat_inap.php?no_reg=". $data['no_reg']. "' class='btn btn-danger' data-reg='". $data['no_reg']. "' ><i class='fa fa-reply'> Batal</button></td>

      </tr>";
      
      
    ?>


<script type="text/javascript">
     $(".pindah").click(function(){   
            
            var id = $(this).attr('data-id');
            var reg = $(this).attr('data-reg');
            var bed = $(this).attr('data-bed');
            var group_bed = $(this).attr('data-group-bed');
            var no_reg = $(this).attr('data-reg');

            $("#pindah_kamar").attr("data-id",id);
            $("#pindah_kamar").attr("data-reg",reg);
            $("#pindah_kamar").attr("data-bed",bed);
            $("#pindah_kamar").attr("data-group_bed",group_bed);

                $.post("pindah_kamar.php",{reg:reg,bed:bed,group_bed:group_bed},function(data){
                $("#tampil_kamar").html(data);
                $("#modal_kamar").modal('show');
          
                });
            });
</script>