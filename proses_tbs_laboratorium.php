<?php 
include 'db.php';
include_once 'sanitasi.php';

session_start();
$session_id = session_id();
$tipe = stringdoang($_POST['tipe_barang']);
$penjamin = stringdoang($_POST['penjamin']);
$apoteker = stringdoang($_POST['apoteker']);
$no_rm  = stringdoang($_POST['no_rm']);
$petugas = $_SESSION['nama'];
$waktu = date("Y-m-d H:i:sa");
$bulan_php = date('m');
$tahun_php = date('Y');
  
      $kode = stringdoang($_POST['kode_barang']);
      $harga = angkadoang($_POST['harga']);
      $jumlah = angkadoang($_POST['jumlah_barang']);
      $nama = stringdoang($_POST['nama_barang']);
      $user = $_SESSION['nama'];
      $potongan = angkadoang($_POST['potongan']);
      $a = $harga * $jumlah;
      $tahun_sekarang = date('Y');
      $bulan_sekarang = date('m');
      $tanggal_sekarang = date('Y-m-d');
      $jam_sekarang = date('H:i:sa');
      $tahun_terakhir = substr($tahun_sekarang, 2);


$id_userr = $db->query("SELECT id FROM user WHERE nama = '$user'");
$data_id = mysqli_fetch_array($id_userr);
$id_kasir = $data_id['id'];

          if(strpos($potongan, "%") !== false)
          {
              $potongan_jadi = $a * $potongan / 100;
              $potongan_tampil = $potongan_jadi;
          }
          else{

             $potongan_jadi = $potongan;
             $potongan_tampil = $potongan;
          }


    $tax = angkadoang($_POST['tax']);
    
    $hargaa  = angkadoang($_POST['hargaa']);

          $a = $hargaa * $jumlah;

          $satu = 1;

              $x = $a - $potongan_tampil;

              $hasil_tax = $satu + ($tax / 100);

              $hasil_tax2 = $x / $hasil_tax;

              $tax_persen = $x - $hasil_tax2;

              $subtotal = $hargaa * $jumlah - $potongan_jadi; 
                         

          $query0 = $db->query("SELECT * FROM tbs_penjualan WHERE kode_barang = '$kode' AND session_id = '$session_id' AND no_reg = ''");
          $cek    = mysqli_num_rows($query0);
                                  // STARETTO HARGA BELI 1

          if ($cek > 0 )

          {

  
                  $xml = $db->prepare("UPDATE tbs_penjualan SET jumlah_barang = jumlah_barang + ?, subtotal = subtotal + ?, potongan = ? WHERE kode_barang = ? AND session_id = ? AND no_reg = ''");

                  $xml->bind_param("iisss",
                      $jumlah, $subtotal, $potongan_tampil, $kode, $session_id);

                  $xml->execute();


                if ($tipe == 'Jasa' ){


                }

                else if ($tipe == 'BHP')
                {


                }


          }//dont touch me 

          else
                         
          {
                          

          $query6 = " INSERT INTO tbs_penjualan (session_id,kode_barang,nama_barang,jumlah_barang,harga,subtotal,tipe_barang,potongan,tax,tanggal,jam) VALUES ('$session_id','$kode','$nama','$jumlah','$hargaa','$subtotal','$tipe','$potongan_tampil','$tax_persen','$tanggal_sekarang','$jam_sekarang')";

          if ($db->query($query6) === TRUE)
          { 
                         
          } 
          else 
          {

          echo "Error: " . $query6 . "<br>" . $db->error;

          }

          if ($tipe == 'Jasa' ){


          }

          else if ($tipe == 'BHP'){

          }


          }                     
               

 
 
?>
<?php
  //menampilkan semua data yang ada pada tabel tbs penjualan dalam DB
                $perintah = $db->query("SELECT tp.id,tp.kode_barang,tp.nama_barang,tp.jumlah_barang,tp.harga,tp.subtotal,tp.potongan,tp.tax,tp.jam,tp.tipe_barang,s.nama FROM tbs_penjualan tp INNER JOIN satuan s ON tp.satuan = s.id WHERE tp.session_id = '$session_id' AND tp.no_reg = '' ORDER BY tp.id DESC LIMIT 1 ");
                
                //menyimpan data sementara yang ada pada $perintah
                
                $data1 = mysqli_fetch_array($perintah);
                echo "<tr class='tr-kode-". $data1['kode_barang'] ." tr-id-". $data1['id'] ."' data-kode-barang='".$data1['kode_barang']."'>
                <td style='font-size:15px'>". $data1['kode_barang'] ."</td>
                <td style='font-size:15px;'>". $data1['nama_barang'] ."</td>
                <td style='font-size:15px' align='right'>". rp($data1['harga']) ."</td>
                <td style='font-size:15px' align='right'><span id='text-subtotal-".$data1['id']."'>". rp($data1['subtotal']) ."</span></td>
                <td style='font-size:15px' align='right'><span id='text-potongan-".$data1['id']."'>". rp($data1['potongan']) ."</span></td>
                <td style='font-size:15px' align='right'><span id='text-tax-".$data1['id']."'>". rp($data1['tax']) ."</span></td>";

               echo "<td style='font-size:15px'> <button class='btn btn-danger btn-sm btn-hapus-tbs' id='btn-hapus-id-".$data1['id']."' data-id='". $data1['id'] ."' data-kode-barang='". $data1['kode_barang'] ."' data-barang='". $data1['nama_barang'] ."' data-subtotal='". $data1['subtotal'] ."'>Hapus</button> </td> 

                </tr>";


//Untuk Memutuskan Koneksi Ke Database
mysqli_close($db);   
    ?>

                 <script type="text/javascript">
                                 
                                 $(".edit-jumlah").dblclick(function(){

                                    var id = $(this).attr("data-id");

                                    $("#text-jumlah-"+id+"").hide();

                                    $("#input-jumlah-"+id+"").attr("type", "text");

                                 });


                                 $(".input_jumlah").blur(function(){

                                    var id = $(this).attr("data-id");
                                    var jumlah_baru = $(this).val();
                                    if (jumlah_baru == '') {
                                      jumlah_baru = '0';
                                    }
                                    var kode_barang = $(this).attr("data-kode");
                                    var harga = $(this).attr("data-harga");
                                    var jumlah_lama = $("#text-jumlah-"+id+"").text();
                                    var tipe = $(this).attr("data-tipe");

                                    var subtotal_lama = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah($("#text-subtotal-"+id+"").text()))));
                                    var potongan = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah($("#text-potongan-"+id+"").text()))));

                                    var tax = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah($("#text-tax-"+id+"").text()))));
                                   
                                    var subtotal = harga * jumlah_baru - potongan;

                                    var subtotal_penjualan = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah($("#total2").val()))));

                                    subtotal_penjualan = subtotal_penjualan - subtotal_lama + subtotal;

                                    var pot_fakt_per = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah($("#potongan_persen").val()))));
                                    var potongaaan = pot_fakt_per;
                                          var pos = potongaaan.search("%");
                                          var potongan_persen = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah(potongaaan))));
                                              potongan_persen = potongan_persen.replace("%","");
                                          potongaaan = subtotal_penjualan * potongan_persen / 100;
                                          $("#potongan_penjualan").val(potongaaan);
                                    
                                          var biaya_admin = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah($("#biaya_admin").val()))));
                                          if (biaya_admin == '')
                                          {
                                            biaya_admin = 0;
                                          }
                                          var tax_faktur = $("#tax").val();
                                            if(tax_faktur == '')
                                            {
                                              tax_faktur = 0;
                                            }

                                    var sub_akhir = parseInt(subtotal_penjualan,10) - parseInt(potongaaan,10);

                                     var t_tax = ((parseInt(bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah(sub_akhir,10))))) * parseInt(bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah(tax_faktur)))))) / 100);

                                    //perhitungan total pembayaran terakhir
                                    var tot_akhr = parseInt(sub_akhir,10) + parseInt(biaya_admin,10) + parseInt(Math.round(t_tax,10));
                                    //perhitungan total pembayaran terakhir



                                    var tax_tbs = tax / subtotal_lama * 100;
                                    var jumlah_tax = Math.round(tax_tbs) * subtotal / 100;


                                        if (jumlah_baru == 0) {
                                          alert("Jumlah Tidak Boleh Kosong atau Nol");
                                          $("#input-jumlah-"+id+"").val(jumlah_lama);
                                          $("#text-jumlah-"+id+"").text(jumlah_lama);
                                          $("#text-jumlah-"+id+"").show();
                                          $("#input-jumlah-"+id+"").attr("type", "hidden");

                                        }
                                        else
                                        {

                                            if (tipe == 'Jasa' || tipe == 'BHP') {


                                                      $("#text-jumlah-"+id+"").show();
                                                        $("#text-jumlah-"+id+"").text(jumlah_baru);

                                                        $("#text-subtotal-"+id+"").text(tandaPemisahTitik(subtotal));
                                                        $("#btn-hapus-id-"+id+"").attr("data-subtotal",subtotal);
                                                        $("#text-tax-"+id+"").text(Math.round(jumlah_tax));
                                                        $("#input-jumlah-"+id+"").attr("type", "hidden"); 
                                                        $("#total2").val(tandaPemisahTitik(subtotal_penjualan));
                                                        $("#potongan_penjualan").val(Math.round(potongaaan));
                                                        $("#total1").val(tandaPemisahTitik(tot_akhr));
                                                        $("#tax_rp").val(tandaPemisahTitik(Math.round(t_tax)));
                                                       $("#pembayaran_penjualan").val('');
                                                       $("#sisa_pembayaran_penjualan").val('');
                                                       $("#kredit").val('');
                                                       
                                                         $.post("update_pesanan_barang_apotek.php",{jumlah_lama:jumlah_lama,tax:tax,id:id,jumlah_baru:jumlah_baru,kode_barang:kode_barang,potongan:potongan,harga:harga,jumlah_tax:jumlah_tax,subtotal:subtotal},function(info){
                                                         });  

                                            }
                                            else{

                                              $.post("cek_stok_pesanan_barang.php",{kode_barang:kode_barang,jumlah_baru:jumlah_baru,satuan_konversi:satuan_konversi},function(data){

                                                     if (data < 0) {

                                                     alert ("Jumlah Yang Di Masukan Melebihi Stok !");

                                                      $("#input-jumlah-"+id+"").val(jumlah_lama);
                                                      $("#text-jumlah-"+id+"").text(jumlah_lama);
                                                      $("#text-jumlah-"+id+"").show();
                                                      $("#input-jumlah-"+id+"").attr("type", "hidden");
                                                  
                                                      }

                                                    else{

                                                      $("#text-jumlah-"+id+"").show();
                                                        $("#text-jumlah-"+id+"").text(jumlah_baru);

                                                        $("#text-subtotal-"+id+"").text(tandaPemisahTitik(subtotal));
                                                        $("#btn-hapus-id-"+id+"").attr("data-subtotal",subtotal);
                                                        $("#text-tax-"+id+"").text(Math.round(jumlah_tax));
                                                        $("#input-jumlah-"+id+"").attr("type", "hidden"); 
                                                        $("#total2").val(tandaPemisahTitik(subtotal_penjualan));
                                                        $("#potongan_penjualan").val(Math.round(potongaaan));
                                                        $("#total1").val(tandaPemisahTitik(tot_akhr));
                                                        $("#tax_rp").val(tandaPemisahTitik(Math.round(t_tax)));
                                                       $("#pembayaran_penjualan").val('');
                                                       $("#sisa_pembayaran_penjualan").val('');
                                                       $("#kredit").val('');

                                                         $.post("update_pesanan_barang_apotek.php",{jumlah_lama:jumlah_lama,tax:tax,id:id,jumlah_baru:jumlah_baru,kode_barang:kode_barang,potongan:potongan,harga:harga,jumlah_tax:jumlah_tax,subtotal:subtotal},function(info){

                                                        
                                                        



                                                        });

                                                      }

                                                 });

                                            }
                                            
                                            }

                                    $("#kode_barang").focus();
                                    
                    });


                             </script>