<?php 
include 'db.php';
include 'sanitasi.php';




$jam =  date("H:i:s");
$tanggal_sekarang = date("Y-m-d");
$waktu = date("Y-m-d H:i:s");
$bulan_php = date('m');
$tahun_php = date('Y');


// START UNTUK AMBIL NO RM NYA LEWAT PROSES SAJA

 $tahun_sekarang = substr($tahun_php, 2);
// end 

//ambil bulan dari no rm terakhir
$q_rm_tanggal = $db->query("SELECT MONTH(tanggal) as bulan FROM pelanggan ORDER BY id DESC LIMIT 1");
$v_rm_tanggal = mysqli_fetch_array($q_rm_tanggal);
 $bulan_terakhir_rm = $v_rm_tanggal['bulan'];
//end 


//ambil no_rm terkahir dari pasien
$q_rm = $db->query("SELECT kode_pelanggan FROM pelanggan WHERE kode_pelanggan IS NOT NULL ORDER BY id DESC LIMIT 1");
$v_rm = mysqli_fetch_array($q_rm);
$no_rm_terakhir = substr($v_rm['kode_pelanggan'],0,-6);
//end

 if ($bulan_terakhir_rm != $bulan_php) {
  # code...
  $no_rm = "1-".$bulan_php."-".$tahun_sekarang;
 }

 else
 {

  $nomor = 1 + $no_rm_terakhir;
  $no_rm = $nomor."-".$bulan_php."-".$tahun_sekarang;
 }
// ENDING UNTUK AMBIL NO RM NYA LEWAT PROSES SAJA


$nama_lengkap = stringdoang($_POST['nama_lengkap']);
$jenis_kelamin = stringdoang($_POST['jenis_kelamin']);
$tanggal_lahir = tanggal_mysql($_POST['tanggal_lahir']);
$umur = stringdoang($_POST['umur']);
$tempat_lahir = stringdoang($_POST['tempat_lahir']);
$alamat_sekarang = stringdoang($_POST['alamat_sekarang']);
$no_ktp = angkadoang($_POST['no_ktp']);
$alamat_ktp = stringdoang($_POST['alamat_ktp']);
$no_hp = angkadoang($_POST['no_hp']);
$status_kawin = stringdoang($_POST['status_kawin']);
$pendidikan_terakhir = stringdoang($_POST['pendidikan_terakhir']);
$agama = stringdoang($_POST['agama']);
$nama_suamiortu = stringdoang($_POST['nama_suamiortu']);
$pekerjaan_suamiortu = stringdoang($_POST['pekerjaan_suamiortu']);
$nama_penanggungjawab = stringdoang($_POST['nama_penanggungjawab']);
$hubungan_dengan_pasien = stringdoang($_POST['hubungan_dengan_pasien']);
$no_hp_penanggung = stringdoang($_POST['no_hp_penanggung']);
$alamat_penanggung = stringdoang($_POST['alamat_penanggung']);
$no_kk = angkadoang($_POST['no_kk']);
$nama_kk = stringdoang($_POST['nama_kk']);
$gol_darah = stringdoang($_POST['gol_darah']);
$penjamin = stringdoang($_POST['penjamin']);
$tanggal_lahir = tanggal_mysql($tanggal_lahir);

$perintah = $db->prepare("INSERT INTO pelanggan (
  kode_pelanggan,
  nama_pelanggan,
  jenis_kelamin,
  tgl_lahir,
  umur,
  tempat_lahir,
  alamat_sekarang,
  no_ktp,
  alamat_ktp,
  no_telp,
  status_kawin,
  pendidikan_terakhir,
  agama,
  nama_suamiortu,
  pekerjaan_suamiortu,
  nama_penanggungjawab,
  hubungan_dengan_pasien,
  no_hp_penanggung,
  alamat_penanggung,
  no_kk,
  nama_kk,
  gol_darah,
  penjamin,
  tanggal)
   VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

$perintah->bind_param("sssssssisisssssssssissss",
$no_rm,
$nama_lengkap,
$jenis_kelamin,
$tanggal_lahir,
$umur,
$tempat_lahir,
$alamat_sekarang,
$no_ktp,
$alamat_ktp,
$no_hp,
$status_kawin,
$pendidikan_terakhir,
$agama,
$nama_suamiortu,
$pekerjaan_suamiortu,
$nama_penanggungjawab,
$hubungan_dengan_pasien,
$no_hp_penanggung,
$alamat_penanggung,
$no_kk,
$nama_kk,
$gol_darah,
$penjamin,
$tanggal_sekarang);


$perintah->execute();

    if (!$perintah) 
    {
    die('Query Error : '.$db->errno.
    ' - '.$db->error);
    }
    else 
    {   
      header("location:pasien.php");

    }




//Untuk Memutuskan Koneksi Ke Database
mysqli_close($db);   

    ?>

