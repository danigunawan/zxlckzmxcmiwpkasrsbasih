<?php 
    // memasukan file yang ada pada db.php
    include 'db.php';
    include 'sanitasi.php';
    // mengirim data sesuai variabel yang ada dengan menggunakan metode POST
    $no_faktur = $_POST['no_faktur'];
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $jumlah_barang = $_POST['jumlah_barang'];
    $satuan = $_POST['satuan'];
    $harga = $_POST['harga'];
    $potongan = $_POST['potongan'];
    $tax = stringdoang($_POST['tax']);
    $satu = 1;

    $a = $harga * $jumlah_barang;

    $x = $a - $potongan;

    $hasil_tax = $satu + ($tax / 100);

    $hasil_tax2 = $x / $hasil_tax;

    $tax1 = $x - $hasil_tax2;

    $tax = round($tax1);
    
    $subtotal = $harga * $jumlah_barang - $potongan;



    // menampilkan data yang ada dari tabel tbs_pembelian berdasarkan kode barang
    $cek = $db->query("SELECT * FROM tbs_pembelian WHERE kode_barang = '$kode_barang' AND no_faktur = '$no_faktur'");

    // menyimpan data sementara berupa baris yang dijalankan dari $cek
    $jumlah = mysqli_num_rows($cek);
    
    // jika $jumlah >0 maka akan menjalakan perintah $query1 jika tidak maka akan menjalankan perintah $perintah
    
    if ($jumlah > 0)
    {
        # code...
        $query1 = $db->query("UPDATE tbs_pembelian SET jumlah_barang = jumlah_barang + '$jumlah_barang', subtotal = subtotal + '$subtotal' WHERE kode_barang = '$kode_barang' AND no_faktur = '$no_faktur'");

    }

    else

    {
        $perintah = "INSERT INTO tbs_pembelian (no_faktur,kode_barang,nama_barang,jumlah_barang,satuan,harga,subtotal,potongan,tax)VALUES ('$no_faktur','$kode_barang','$nama_barang','$jumlah_barang','$satuan','$harga','$subtotal','$potongan','$tax')";
        
        if ($db->query($perintah) === TRUE)
        {
        }
        else
        {
            echo "Error: " . $perintah . "<br>" . $db->error;
        }

    }

    ?>

    <?php

              //untuk menampilkan semua data yang ada pada tabel tbs pembelian dalam DB
          $perintah = $db->query("SELECT tp.id, tp.no_faktur, tp.session_id, tp.kode_barang, tp.nama_barang, tp.jumlah_barang, tp.satuan, tp.harga, tp.subtotal, tp.potongan, tp.tax, s.nama FROM tbs_pembelian tp INNER JOIN satuan s ON tp.satuan = s.id WHERE tp.no_faktur = '$no_faktur' ORDER BY tp.id DESC LIMIT 1");

          //menyimpan data sementara yang ada pada $perintah
           $data1 = mysqli_fetch_array($perintah);
            

              // menampilkan data
            echo "<tr class='tr-id-". $data1['id'] ."'>
            <td>". $data1['no_faktur'] ."</td>
            <td>". $data1['kode_barang'] ."</td>
            <td>". $data1['nama_barang'] ."</td>";

      $pilih = $db->query("SELECT no_faktur_pembelian FROM detail_retur_pembelian WHERE no_faktur_pembelian = '$data1[no_faktur]' AND kode_barang = '$data1[kode_barang]'");
      $row_retur = mysqli_num_rows($pilih);

       $hpp_masuk_pembelian = $db->query ("SELECT no_faktur FROM hpp_masuk WHERE no_faktur = '$no_faktur' AND sisa != jumlah_kuantitas AND kode_barang = '$data1[kode_barang]'");
       $row_hpp_masuk = mysqli_num_rows($hpp_masuk_pembelian);


      $pilih = $db->query("SELECT no_faktur_pembelian FROM detail_pembayaran_hutang WHERE no_faktur_pembelian = '$data1[no_faktur]'");
      $row_hutang = mysqli_num_rows($pilih);

      if ($row_retur > 0 || $row_hutang > 0 || $row_hpp_masuk > 0 ) {


              echo"<td class='edit-jumlah-alert' data-faktur='".$data1['no_faktur']."' data-kode='".$data1['kode_barang']."'><span id='text-jumlah-".$data1['id']."'>". $data1['jumlah_barang'] ."</span> <input type='hidden' id='input-jumlah-".$data1['id']."' value='".$data1['jumlah_barang']."' class='input_jumlah' data-id='".$data1['id']."' autofocus='' data-kode='".$data1['kode_barang']."' data-harga='".$data1['harga']."' > </td>"; 

      } 

      else {


      echo"<td class='edit-jumlah' data-id='".$data1['id']."' data-faktur='".$data1['no_faktur']."' data-kode='".$data1['kode_barang']."'><span id='text-jumlah-".$data1['id']."'>". $data1['jumlah_barang'] ."</span> <input type='hidden' id='input-jumlah-".$data1['id']."' value='".$data1['jumlah_barang']."' class='input_jumlah' data-id='".$data1['id']."' autofocus='' data-kode='".$data1['kode_barang']."' data-harga='".$data1['harga']."' > </td>"; 

      }

            echo"<td>". $data1['nama'] ."</td>
            <td>". rp($data1['harga']) ."</td>
            <td><span id='text-subtotal-".$data1['id']."'>". $data1['subtotal'] ."</span></td>
            <td><span id='text-potongan-".$data1['id']."'>". $data1['potongan'] ."</span></td>
            <td><span id='text-tax-".$data1['id']."'>". $data1['tax'] ."</span></td>";

      if ($row_retur > 0 || $row_hutang > 0 || $row_hpp_masuk > 0 ) {

            echo "<td> <button class='btn btn-danger btn-alert-hapus' data-id='".$data1['id']."' data-faktur='".$data1['no_faktur']."' data-kode='".$data1['kode_barang']."'><span class='glyphicon glyphicon-trash'></span> Hapus </button></td>";

      } 

      else
      {
            echo "<td> <button class='btn btn-danger btn-sm btn-hapus-tbs' id='hapus-tbs-".$data1['id']."' data-id='". $data1['id'] ."' data-subtotal='".$data1['subtotal']."' data-kode-barang='". $data1['kode_barang'] ."' data-barang='". $data1['nama_barang'] ."'><span class='glyphicon glyphicon-trash'> </span> Hapus </button> </td>";
      }

      echo "</tr>";


//Untuk Memutuskan Koneksi Ke Database
          mysqli_close($db); 
    ?>
  




<script type="text/javascript">
 
$(".btn-alert-hapus").click(function(){
     var no_faktur = $(this).attr("data-faktur");
    var kode_barang = $(this).attr("data-kode");

    $.post('alert_edit_pembelian.php',{no_faktur:no_faktur, kode_barang:kode_barang},function(data){
    
 
    $("#modal_alert").modal('show');
    $("#modal-alert").html(data); 

});

  });
</script>


<script type="text/javascript">
                                 
                                 $(".edit-jumlah").dblclick(function(){

                                      var id = $(this).attr("data-id");
                   
                                     
                                        $("#text-jumlah-"+id+"").hide();                                        
                                        $("#input-jumlah-"+id+"").attr("type", "text");


                                 });


                                 $(".input_jumlah").blur(function(){

                                    var id = $(this).attr("data-id");
                                    var jumlah_baru = $(this).val();
                                    var kode_barang = $(this).attr("data-kode");
                                    var harga = $(this).attr("data-harga");
                                    var jumlah_lama = $("#text-jumlah-"+id+"").text();
                                    
                                    var subtotal_lama = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah($("#text-subtotal-"+id+"").text()))));
                                    
                                    var potongan = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah($("#text-potongan-"+id+"").text()))));
                                    
                                    var tax = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah($("#text-tax-"+id+"").text()))));
                                    
                                    var subtotal = parseInt(harga,10) * parseInt(jumlah_baru,10) - parseInt(potongan,10);
                                    
                                    var subtotal_penjualan = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah($("#total_pembelian").val()))));
                                    
                                    subtotal_penjualan = parseInt(subtotal_penjualan,10) - parseInt(subtotal_lama,10) + parseInt(subtotal,10);
                                    
                                    var tax_tbs = tax / subtotal_lama * 100;
                                    var jumlah_tax = Math.round(tax_tbs) * subtotal / 100;

                                     $.post("update_pesanan_barang_beli.php",{harga:harga,jumlah_lama:jumlah_lama,jumlah_tax:jumlah_tax,potongan:potongan,id:id,jumlah_baru:jumlah_baru,kode_barang:kode_barang},function(info){

                                    
                                    $("#text-jumlah-"+id+"").show();
                                    $("#text-jumlah-"+id+"").text(jumlah_baru);
                                    $("#text-subtotal-"+id+"").text(tandaPemisahTitik(subtotal));
                                    $("#hapus-tbs-"+id+"").attr('data-subtotal', subtotal);
                                    $("#text-tax-"+id+"").text(Math.round(jumlah_tax));
                                    $("#input-jumlah-"+id+"").attr("type", "hidden"); 
                                    $("#total_pembelian").val(tandaPemisahTitik(subtotal_penjualan));
                                    $("#total_pembelian1").val(tandaPemisahTitik(subtotal_penjualan));         

                                    });


                                    $("#kode_barang").focus();
                                    $("#pembayaran_pembelian").val("");

                                 });

                             </script>


<script type="text/javascript">
  
      $(".edit-jumlah-alert").dblclick(function(){

      var no_faktur = $(this).attr("data-faktur");
      var kode_barang = $(this).attr("data-kode");
                                      
      $.post('alert_edit_pembelian.php',{no_faktur:no_faktur, kode_barang:kode_barang},function(data){

      $("#modal_alert").modal('show');
      $("#modal-alert").html(data);

                                      
});
});
</script>
