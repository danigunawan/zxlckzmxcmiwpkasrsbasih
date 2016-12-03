<?php 
include 'db.php';
include 'sanitasi.php';


$no_reg = stringdoang($_POST['reg']);
$keterangan = stringdoang($_POST['keterangan']);


$update = $db->query("UPDATE registrasi SET status = 'Batal UGD' , keterangan = '$keterangan' WHERE no_reg = '$no_reg'");


$query_del = "DELETE FROM rekam_medik_ugd WHERE no_reg = '$no_reg'";
if ($db->query($query_del) === TRUE) {
    
} 
else {
    echo "Error: " . $query_del . "<br>" . $db->error;
     }
     


 ?>