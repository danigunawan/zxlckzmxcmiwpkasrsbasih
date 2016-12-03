<?php 
include 'db.php';
include 'sanitasi.php';


$cek = $db->query("SELECT * FROM bed WHERE sisa_bed != 0 ");

 ?>

  <div class="table-responsive">

        <table id="siswaki" class="table table-bordered table-hover table-striped">
        <thead>
          <tr>
          <th>Kelas</th>
          <th>Kode Kamar</th>
          <th>Nama Kamar</th>
          <th>Fasilitas</th>
          <th>Jumlah Bed</th>
          <th>Sisa Bed</th>    
          </tr>
      </thead>
          <tbody>
          <?php
           while ($data =$cek->fetch_assoc()) {
          ?>
         <tr class="pilih3" 
         data-nama="<?php echo $data['nama_kamar']; ?>"
         data-group-bed="<?php echo $data['group_bed']; ?>">

          <td><?php echo $data['kelas']; ?></td>
          <td><?php echo $data['nama_kamar']; ?></td>
          <td><?php echo $data['group_bed']; ?></td>
          <td><?php echo $data['fasilitas']; ?></td>
         <td><?php echo $data['jumlah_bed']; ?></td>
        <td><?php echo $data['sisa_bed']; ?></td>
                             
     </tr>
        <?php
        }
        ?>
          </tbody>
   		 </table>  
         </div>



<!-- end ambil data RI  -->
