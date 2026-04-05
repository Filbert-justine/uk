<?php
// Menentukan lokasi root folder proyek di server
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/Poin_Pelanggaran_Siswa');

// Menghubungkan ke file konfigurasi (koneksi database)
include ROOTPATH . "/config/config.php";

// Menyertakan tampilan header (bagian atas halaman)
include ROOTPATH . "/includes/header.php";

// Mengambil semua data siswa dari tabel 'Siswa' JOIN 'Ortu_Wali', 'Kelas', 'Tingkat', 'Program_Keahlian', 'Guru'
$result = mysqli_query($conn, "SELECT * FROM siswa 
JOIN ortu_wali USING(id_ortu_wali)
JOIN kelas USING(id_kelas)
JOIN tingkat USING(id_tingkat)
JOIN program_keahlian USING(id_program_keahlian)
JOIN guru USING(kode_guru)");
?>

<!-- Bagian tampilan daftar siswa --> 
<center>
    <h2>List Siswa</h2>

    <!-- Tombol untuk menuju halaman tambah siswa -->
    <?php
    if($_SESSION['role'] == 'Guru BK'){
    ?>
    <button><a href="add.php">+ Tambah Data Siswa</a></button><br><br>
    <?php
    }else{
        echo "";
    }
    ?>

    <div class="scroll">
        <!-- Membuat tabel untuk menampilkan daftar siswa -->
        <table border="1" cellpadding="10" cellspacing="0" width="200%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Ayah</th>
                    <th>Ibu</th>
                    <th>Wali</th>
                    <th>Pekerjaan Ayah</th>
                    <th>Pekerjaan Ibu</th>
                    <th>Pekerjaan Wali</th>
                    <th>Alamat Ayah</th>
                    <th>Alamat Ibu</th>
                    <th>Alamat Wali</th>
                    <th>Kelas</th>
                    <th>Wali Kelas</th>
                    <?php
                    if($_SESSION['role'] == 'Guru BK'){
                    ?>
                    <th colspan="2">Aksi</th>
                    <?php
                    }else{
                    echo "";
                    }
                    ?>
                    
                </tr>
            </thead>
            <tbody>
                <?php 
                // Variabel untuk nomor urut
                $no = 1;

                // Menampilkan semua data kasir dari hasil query
                while ($row = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <!-- Menampilkan nomor urut -->
                    <!-- Menampilkan nomor urut -->
                    <td><?= $no++?></td>
                    <!-- Menampilkan data siswa, fungsi dari htmlspecialchars() untuk memfilter data agar aman dari XSS -->
                    <td><?= htmlspecialchars($row['nis']) ?></td>
                    <td><?= htmlspecialchars($row['nama_siswa']) ?></td>
                    <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
                    <td><?= htmlspecialchars($row['alamat']) ?></td>
                    <td><?= (empty($row['ayah']) || $row['ayah'] == 'NULL') ? '-' : htmlspecialchars($row['ayah']) ?></td>
                    <td><?= (empty($row['ibu']) || $row['ibu'] == 'NULL') ? '-' : htmlspecialchars($row['ibu']) ?></td>
                    <td><?= (empty($row['wali']) || $row['wali'] == 'NULL') ? '-' : htmlspecialchars($row['wali']) ?></td>
                    <td><?= (empty($row['pekerjaan_ayah']) || $row['pekerjaan_ayah'] == 'NULL') ? '-' : htmlspecialchars($row['pekerjaan_ayah']) ?></td>
                    <td><?= (empty($row['pekerjaan_ibu']) || $row['pekerjaan_ibu'] == 'NULL') ? '-' : htmlspecialchars($row['pekerjaan_ibu']) ?></td>
                    <td><?= (empty($row['pekerjaan_wali']) || $row['pekerjaan_wali'] == 'NULL') ? '-' : htmlspecialchars($row['pekerjaan_wali']) ?></td>
                    <td><?= (empty($row['alamat_ayah']) || $row['alamat_ayah'] == 'NULL') ? '-' : htmlspecialchars($row['alamat_ayah']) ?></td>
                    <td><?= (empty($row['alamat_ibu']) || $row['alamat_ibu'] == 'NULL') ? '-' : htmlspecialchars($row['alamat_ibu']) ?></td>
                    <td><?= (empty($row['alamat_wali']) || $row['alamat_wali'] == 'NULL') ? '-' : htmlspecialchars($row['alamat_wali']) ?></td>
                    <td><?= htmlspecialchars($row['tingkat'] . ' ' . $row['program_keahlian'] . ' ' . $row['rombel'] ) ?></td>
                    <td><?= htmlspecialchars($row['nama_pengguna']) ?></td>

                    <!-- Tombol edit untuk ubah data siswa -->
                    <?php
                    if($_SESSION['role'] == 'Guru BK'){
                    ?>
                    <td>
                        <button><a href="edit.php?id=<?= $row['nis'] ?>">Edit</a></button>
                    </td>
                    <?php
                    }else{
                        echo"";
                    }
                    ?>
                    <!-- Tombol hapus dengan pengecekan apakah siswa sudah punya transaksi -->
                    <?php
                    if($_SESSION['role'] == 'Guru BK'){
                    ?>
                    <td>
                        <form action="/Poin_Pelanggaran_Siswa/process/siswa_process.php" method="post"
                            onsubmit="return confirm('Ingin Menghapus data <?= $row['nama_siswa'] ?>?')">
                            <!-- Kirim id dan action ke file proses -->
                            <input type="hidden" name="nis" value="<?= $row['nis'] ?>">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                    <?php
                    }else{
                        echo"";
                    }
                    ?>
                </tr>       
                <?php } ?>
            </tbody>
        </table>
    </div>
</center>

<?php 
// Menyertakan bagian footer (penutup halaman)
include "../../includes/footer.php"; 
?>
