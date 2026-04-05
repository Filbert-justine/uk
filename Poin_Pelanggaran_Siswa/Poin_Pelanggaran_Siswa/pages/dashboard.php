<?php
// Menentukan path utama proyek agar mudah memanggil file lain
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/Poin_Pelanggaran_Siswa');

// Menyertakan file konfigurasi database
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";



if($_SESSION['role'] == 'Guru BK'){

    // Ambil semua data yang dibutuhkan terlebih dahulu
    $total_pelanggaran = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM pelanggaran_siswa JOIN jenis_pelanggaran USING(id_jenis_pelanggaran)"))[0];

    $query_poin = mysqli_query($conn, "SELECT COUNT(*) as jumlah_siswa FROM (SELECT nis, SUM(poin) as total_poin FROM pelanggaran_siswa JOIN jenis_pelanggaran USING(id_jenis_pelanggaran) GROUP BY nis HAVING total_poin > 10) as subquery");
    $jumlah_siswa_lebih10 = mysqli_fetch_assoc($query_poin)['jumlah_siswa'];

    $total_panggilan = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM surat_keluar JOIN siswa USING(nis) WHERE jenis_surat = 'Panggilan Orang Tua'"))[0];

    // Tampilkan kartu statistik dalam satu echo
    echo '
    <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 20px; justify-content: center;">
        <div style="width: 200px; border: 1px solid #ccc; border-radius: 8px; padding: 10px; background: #fe4a4a; color: white; text-align:center;">
            <div style="font-weight: bold; margin-bottom: 5px;">Total Pelanggaran</div>
            <div>' . ($total_pelanggaran > 0 ? $total_pelanggaran . " Pelanggaran" : "0 Pelanggaran") . '</div>
        </div>
        <div style="width: 200px; border: 1px solid #ccc; border-radius: 8px; padding: 10px; background: #ffc107; text-align:center;">
            <div style="font-weight: bold; margin-bottom: 5px;">Siswa Poin &gt; 10</div>
            <div>' . ($jumlah_siswa_lebih10 > 0 ? $jumlah_siswa_lebih10 . " Siswa" : "0 Siswa") . '</div>
        </div>
        <div style="width: 200px; border: 1px solid #ccc; border-radius: 8px; padding: 10px; background: #17a2b8; color: white; text-align:center;">
            <div style="font-weight: bold; margin-bottom: 5px;">Total Panggilan Ortu</div>
            <div>' . ($total_panggilan > 0 ? $total_panggilan . " Panggilan Ortu" : "0 Panggilan Ortu") . '</div>
        </div>
    </div>';


}elseif($_SESSION['role'] == 'siswa'){
   
   $nis = $_SESSION['username'];
   $query_siswa = mysqli_query($conn, "SELECT nis, nama_siswa, tingkat, program_keahlian, rombel, deskripsi FROM siswa
   JOIN kelas USING(id_kelas)
   JOIN tingkat USING(id_tingkat)
   JOIN program_keahlian USING(id_program_keahlian)
   WHERE nis = '$nis'");
   $row_siswa = mysqli_fetch_assoc($query_siswa);
            ?>


   <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 20px; justify-content: center;">
      <div style="width: 200px; border: 1px solid #ccc; border-radius: 8px; padding: 10px; background: #fe4a4a; color: white; text-align:center; ">
         <div style="font-weight: bold; margin-bottom: 5px;">Total Pelanggaran</div>
         <div>
               <?php
               $pelanggaran = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM pelanggaran_siswa JOIN jenis_pelanggaran USING(id_jenis_pelanggaran) WHERE nis = '$nis'"))[0];
               if($pelanggaran == 0){
                  echo "0 Pelanggaran";
               }else{
                  echo $pelanggaran. " Pelanggaran";
               }
               ?>
         </div>
      </div>
      <div style="width: 200px; border: 1px solid #ccc; border-radius: 8px; padding: 10px; background: #ffc107; text-align:center;">
         <div style="font-weight: bold; margin-bottom: 5px;">Total Poin</div>
         <div>
               <?php
               // menghitung total poin dari kolom poin menggunakan fungsi SUM() pada mysql
               $poin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(poin) FROM pelanggaran_siswa JOIN siswa USING(nis) JOIN jenis_pelanggaran USING(id_jenis_pelanggaran) WHERE nis = '$nis'"))['SUM(poin)'];
               // menampilkan total poin
               if($poin == 0){
                  echo "0 Poin";
               }else{
                  echo $poin. " Poin";
               }
               ?>
         </div>
      </div>
      <div
         style="width: 200px; border: 1px solid #ccc; border-radius: 8px; padding: 10px; background: #17a2b8; color: white; text-align:center;">
         <div style="font-weight: bold; margin-bottom: 5px;">Total Panggilan Ortu</div>
         <div>
               <?php
               $panggilan_ortu = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM surat_keluar JOIN siswa USING(nis) WHERE nis = '$nis' AND jenis_surat = 'Panggilan Orang Tua'"))[0];
               if($panggilan_ortu == 0){
                  echo "0 Panggilan Ortu";
               }else{
                  echo $panggilan_ortu. " Panggilan Ortu";
               }
               ?>
         </div>
      </div>
   </div>











   <div class="page" style="min-height: 50mm !important;">
      <div class="content">
        
        <div class="indent">
            <div class="form-row">
                <div class="label">Nama</div>
                <div class="separator">:</div>
                <div class="field"><?php echo $row_siswa['nama_siswa']; ?></div>
            </div>
            <div class="form-row">
                <div class="label">NIS</div>
                <div class="separator">:</div>
                <div class="field"><?php echo $row_siswa['nis']; ?></div>
            </div>
            <div class="form-row">
                <div class="label">Kelas</div>
                <div class="separator">:</div>
                <div class="field"><?php echo $row_siswa['tingkat'] . ' ' . $row_siswa['program_keahlian'] . ' ' . $row_siswa['rombel'] ?></div>
            </div>
            <div class="form-row">
                <div class="label">Program Keahlian</div>
                <div class="separator">:</div>
                <div class="field"><?php echo $row_siswa['deskripsi']; ?></div>
            </div>
         </div>
      </div>
   </div>
   <div class="page"> 
      <div class="content">
        
        <div class="indent"></div>
            <h1>List Pelanggaran</h1>
            
            <table border="1" cellpadding="10" cellspacing="0" width="100%">
               <thead align="center">
                  <tr>
                     <th>No</th>
                     <th>Tanggal</th>
                     <th>Jenis Pelanggaran</th>
                     <th>Point</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  $no = 1;
                  $result_pelanggaran = mysqli_query($conn, "SELECT id_pelanggaran_siswa, tanggal, jenis, keterangan, poin FROM pelanggaran_siswa JOIN siswa USING(nis) JOIN jenis_pelanggaran USING(id_jenis_pelanggaran) WHERE nis = '$nis'");
                  while ($row_pelanggaran = mysqli_fetch_assoc($result_pelanggaran)){
                  ?>
                  <tr>
                     <td align="center"><?= $no++?></td>
                     <td>
                     
                     <?php
                     // ubah format tanggal dari YYYY-MM-DD H:i:s menjadi DD-MM-YYYY H:i:s
                     $datetime = date("d-m-Y H:i:s", strtotime($row_pelanggaran['tanggal']));
                     // memecah tanggal dan jam
                     $tanggal = explode(" ", $datetime);
                     // memecah jam 
                     $jam = $tanggal[1];
                     // memecah tanggal
                     $tanggal = explode("-", $tanggal[0]);

                     // array bulan dalam bahasa indonesia
                     $bulan = array(
                           "01" => "Januari",
                           "02" => "Pebruari",
                           "03" => "Maret",
                           "04" => "April",
                           "05" => "Mei",
                           "06" => "Juni",
                           "07" => "Juli",
                           "08" => "Agustus",
                           "09" => "September",
                           "10" => "Oktober",
                           "11" => "November",
                           "12" => "Desember"
                     );
                     // menggabungkan tanggal dan bulan dalam bahasa indonesia
                     $tanggal = $tanggal[0] . " " . $bulan[$tanggal[1]] . " " . $tanggal[2];
                     // tampilkan tanggal yang sudah dimodifikasi menjadi bahasa indonesia agar mudah dibaca
                     echo $tanggal;
                     echo "<br>";
                     echo $jam;
                     ?>
                  
                  </td>
                     <td><?= htmlspecialchars($row_pelanggaran['jenis']) ?></td>
                     <td rowspan="2" align="center"><?= htmlspecialchars($row_pelanggaran['poin']) ?></td>
                  </tr>
                  <tr>
                     <td colspan="3">Detail Pelanggaran : <?= htmlspecialchars($row_pelanggaran['keterangan']) ?></td>
                  </tr>
                  <?php
                     } 
                  ?>
                  <tr>
                     <td colspan="3" align="right">Total Poin</td>
                     <td align="center">
                           <?php
                           echo $poin;
                           ?>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div> 
      </div>
      </div>
   <div class="page">
      <h1>Pemanggilan Orang Tua/Wali</h1>
      
   </div>          
   <?php
}


include ROOTPATH . "/includes/footer.php";
?>
