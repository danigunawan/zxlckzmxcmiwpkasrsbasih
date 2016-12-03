<?php 
include 'db.php';

include_once 'sanitasi.php';
$dari_tanggal = stringdoang($_POST['dari_tanggal']);
$sampai_tanggal = stringdoang($_POST['sampai_tanggal']);
$cari_berdasarkan = stringdoang($_POST['cari_berdasarkan']);
$pencarian = stringdoang($_POST['pencarian']);


switch ($cari_berdasarkan) {
    case "nama":
        $query1= $db->query("SELECT * FROM rekam_medik  WHERE nama LIKE '%$pencarian%' ");
        echo "<div class='table-responsive'>";
       echo"<table id='table-group' class='table table-bordered'>

    <thead>
      <tr>
          <th>No Reg </th>
         <th>Nama Pasien</th>
         <th>Tanggal Periksa</th>
         <th>Nama Dokter</th>
         <th>Poli</th>
    </tr>
    </thead>
    <tbody>";
 
    	while ($data= mysqli_fetch_array($query1))
    	{
    		   echo "<tr class='rekam-medik' data-no='". $data['id'] ."' >
      <td>". $data['no_reg']."</td>
      <td>". $data['nama']."</td>
      <td>". $data['tanggal_periksa']."</td>
      <td>". $data['dokter']."</td>
      <td>". $data['poli']."</td>
   
      
      </tr>";
    	}
  echo"
  </tbody>
 </table>
 </div>";
        break;
    case "no_rm":
        $query2= $db->query("SELECT * FROM rekam_medik  WHERE no_rm  LIKE '%$pencarian%'");
        echo"<table id='table-group' class='table table-bordered'>

    <thead>
      <tr>
          <th>No Reg </th>
         <th>Nama Pasien</th>
         <th>Tanggal Periksa</th>
         <th>Nama Dokter</th>
         <th>Poli</th>
    </tr>
    </thead>
    <tbody>";
 
    	while ($data= mysqli_fetch_array($query2))
    	{
    		   echo "<tr class='rekam-medik' data-no='". $data['id'] ."' >
      <td>". $data['no_reg']."</td>
      <td>". $data['nama']."</td>
      <td>". $data['tanggal_periksa']."</td>
      <td>". $data['dokter']."</td>
      <td>". $data['poli']."</td>
   
      
      </tr>";
    	}
  echo"
  </tbody>
 </table>";
        break;
    default:
        
}


 ?>


<script type="text/javascript">

  $(function () {
  $("#table-group").dataTable();
  });
  
  </script>

