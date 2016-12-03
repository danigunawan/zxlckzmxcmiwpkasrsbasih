<?php 
include 'db.php';
include_once 'sanitasi.php';
session_start();

$token = stringdoang($_POST['token']);


// start data agar tetap masuk 
try {
    // First of all, let's begin a transaction
$db->begin_transaction();
    // A set of queries; if one fails, an exception should be thrown
 // begin data

if ($token == '')
{
  
header("location:registrasi_raja.php");

}
else
{
$username = stringdoang($_SESSION['username']);
$no_rm = stringdoang($_POST['no_rm']);
$nama_lengkap =  stringdoang($_POST['nama_lengkap']);
$alamat = stringdoang($_POST['alamat']);
$jenis_kelamin = stringdoang($_POST['jenis_kelamin']);
$hp = angkadoang($_POST['hp']);
$kondisi = stringdoang($_POST['kondisi']);
$penjamin = stringdoang($_POST['penjamin']);
$dokter = stringdoang($_POST['dokter']);
$rujukan = stringdoang($_POST['rujukan']);
$poli = stringdoang($_POST['poli']);
$umur = stringdoang($_POST['umur']);
$sistole_distole = stringdoang($_POST['sistole_distole']);
$respiratory_rate = stringdoang($_POST['respiratory_rate']);
$suhu = angkadoang($_POST['suhu']);
$nadi = angkadoang($_POST['nadi']);
$berat_badan = stringdoang($_POST['berat_badan']);
$tinggi_badan = stringdoang($_POST['tinggi_badan']);
$alergi = stringdoang($_POST['alergi']);
$tanggal_lahir = stringdoang($_POST['tanggal_lahir']);
$tanggal_lahir = tanggal_mysql($tanggal_lahir);


$no_urut = 1;

$jam =  date("H:i:s");
$tanggal_sekarang = date("Y-m-d");
$waktu = date("Y-m-d H:i:s");

$bulan_php = date('m');
$tahun_php = date('Y');

$select_to = $db->query("SELECT nama_pasien FROM registrasi  WHERE jenis_pasien = 'Rawat Jalan'  ORDER BY id DESC LIMIT 1 ");
$keluar = mysqli_fetch_array($select_to);

if ($keluar['nama_pasien'] == $nama_lengkap )
{
header('location:registrasi_raja.php');
}
else{

// START UNTUK AMBIL NO REG NYA LEWAT PROSES SAJA
// START UNTUK NO REG 

 $tahun_terakhir = substr($tahun_php, 2);
//ambil bulan sekarang

 $bulan_terakhir = $db->query("SELECT MONTH(tanggal) as bulan FROM registrasi ORDER BY id DESC LIMIT 1");
 $v_bulan_terakhir = mysqli_fetch_array($bulan_terakhir);

//ambil nomor  dari penjualan terakhir
$no_terakhir = $db->query("SELECT no_reg FROM registrasi ORDER BY id DESC LIMIT 1");
 $v_no_terakhir = mysqli_fetch_array($no_terakhir);
$ambil_nomor = substr($v_no_terakhir['no_reg'],0,-8);

/*jika bulan terakhir dari penjualan tidak sama dengan bulan sekarang, 
maka nomor nya kembali mulai dari 1 ,
jika tidak maka nomor terakhir ditambah dengan 1
 
 */
 if ($v_bulan_terakhir['bulan'] != $bulan_php) {
  # code...
 $no_reg = "1-REG-".$bulan_php."-".$tahun_terakhir;

 }

 else
 {

$nomor = 1 + $ambil_nomor ;

 $no_reg = $nomor."-REG-".$bulan_php."-".$tahun_terakhir;


 }
 // AKHIR UNTUK NO REG
                      // END UNTUK AMBIL NO REG LEWAT PROSES SAJA



$query= $db->query("SELECT * FROM registrasi WHERE tanggal = '$tanggal_sekarang' AND poli = '$poli' ORDER BY no_urut DESC LIMIT 1");
$jumlah = mysqli_num_rows($query);
$data = mysqli_fetch_array($query);

if($jumlah > 0)

{
$no_urut_terakhir = $no_urut + $data['no_urut'];

$sql6 = $db->prepare("INSERT INTO registrasi (alergi,poli,no_urut,nama_pasien,jam,hp_pasien,penjamin,dokter,status,
  no_reg,no_rm,tanggal,kondisi,petugas,alamat_pasien,umur_pasien,jenis_kelamin,rujukan,jenis_pasien)
   VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$sql6->bind_param("sssssssssssssssssss",$alergi,$poli,$no_urut_terakhir,$nama_lengkap,$jam,$hp,$penjamin,$dokter,$menunggu,$no_reg,$no_rm,$tanggal_sekarang,$kondisi,$username,$alamat,$umur,$jenis_kelamin,$rujukan,$rawat_jalanjalan);


$menunggu = 'menunggu';
$rawat_jalanjalan = 'Rawat Jalan';

$sql6->execute();



$sql0 = $db->prepare("INSERT INTO rekam_medik
 (alergi,no_reg,no_rm,nama,alamat,umur,jenis_kelamin,sistole_distole,suhu,berat_badan,
  tinggi_badan,nadi,respiratory,poli,tanggal_periksa,jam,dokter,kondisi,rujukan)
   VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

$sql0->bind_param("sssssssssssssssssss",$alergi,$no_reg,$no_rm,$nama_lengkap,$alamat,$umur,$jenis_kelamin,$sistole_distole,$suhu,$berat_badan,$tinggi_badan,$nadi,$respiratory_rate,$poli,$tanggal_sekarang,$jam,$dokter,$kondisi,$rujukan);

$sql0->execute();

    
}

else {



$sql7 = $db->prepare("INSERT INTO registrasi (alergi,poli,no_urut,nama_pasien,jam,hp_pasien,penjamin,dokter,status,
  no_reg,no_rm,tanggal,kondisi,petugas,alamat_pasien,umur_pasien,jenis_kelamin,rujukan,jenis_pasien)
   VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$sql7->bind_param("sssssssssssssssssss",$alergi,$poli,$no_urut,$nama_lengkap,$jam,$hp,$penjamin,$dokter,$menunggu,$no_reg,$no_rm,$tanggal_sekarang,$kondisi,$username,$alamat,$umur,$jenis_kelamin,$rujukan,$rawat_jalanjalan);


$menunggu = 'menunggu';
$rawat_jalanjalan = 'Rawat Jalan';

$sql7->execute();


$sql99 = $db->prepare("INSERT INTO rekam_medik
 (alergi,no_reg,no_rm,nama,alamat,umur,jenis_kelamin,sistole_distole,suhu,berat_badan,
  tinggi_badan,nadi,respiratory,poli,tanggal_periksa,jam,dokter,kondisi,rujukan)
   VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

$sql99->bind_param("sssssssssssssssssss",$alergi,$no_reg,$no_rm,$nama_lengkap,$alamat,$umur,$jenis_kelamin,$sistole_distole,$suhu,$berat_badan,$tinggi_badan,$nadi,$respiratory_rate,$poli,$tanggal_sekarang,$jam,$dokter,$kondisi,$rujukan);

$sql99->execute();


}


// UPDATE PASIEN NYA
$update_pasien = "UPDATE pelanggan SET tgl_lahir = '$tanggal_lahir' , umur = '$umur' , no_telp = '$hp', alamat_sekarang = '$alamat', penjamin = '$penjamin'  WHERE kode_pelanggan = '$no_rm'";
if ($db->query($update_pasien) === TRUE) 
  {
} 
else 
    {
    echo "Error: " . $update_pasien . "<br>" . $db->error;
    } 



} // biar gk double 
} // token


    $db->commit();
    header('location:registrasi_raja.php');

} catch (Exception $e) {
    // An exception has been thrown
    // We must rollback the transaction
    $db->rollback();
}
// ending agar data tetep masuk awalau koneksi putus 

mysqli_close($db);

 ?>