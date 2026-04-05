<?php
// Menentukan lokasi folder utama proyek di server
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/Poin_Pelanggaran_Siswa');

// Menghubungkan ke file konfigurasi (koneksi database)
include ROOTPATH . "/config/config.php";

// Menyertakan file header (biasanya berisi tampilan atas halaman dan koneksi dasar)
include ROOTPATH . "/includes/header.php";
?>

<!-- Membuat tampilan form untuk menambah data jenis pelanggaran -->
<center>
    <!-- form input data pelanggaran siswa-->
    <form action="/Poin_Pelanggaran_Siswa/process/pelanggaran_process.php" method="post">
        <fieldset style="width:30%">
            <legend>Input Pelanggaran Siswa</legend>
            
            <!-- Menyembunyikan input action agar file proses tahu ini adalah aksi 'add' dan akan di kirim ke pelanggaran_process.php -->
            <input type="hidden" name="action" value="add" />

            <table cellspacing="10">
                <tr>
                    <td>NIS</td>
                    <td>:</td>
                    <td>
                        <!-- datalist ini berfungsi untuk menampilkan data nis dan nama siswa yang akan dipilih -->
                        <datalist id="nis" name="nis">
                            <?php 
                            $result = mysqli_query($conn, "SELECT nis, nama_siswa FROM siswa");
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['nis'] . "'>" . $row['nis'] . " - " . $row['nama_siswa'] . "</option>";
                            }
                            ?>
                        </datalist>
                        <!-- input ini berfungsi untuk menampilkan data nis dan nama siswa yang akan dipilih -->
                        <input type="text" name="nis" value="<?php if(isset($_POST['nis'])) { echo $_POST['nis']; } else { echo ""; } ?>" list="nis" placeholder="pilih NIS" required autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <td>Jenis Pelanggaran</td>
                    <td>:</td>
                    <td>
                        <!-- datalist ini berfungsi untuk menampilkan data jenis pelanggaran dan poin yang akan dipilih -->
                        <datalist id="jenis_pelanggaran" name="jenis_pelanggaran">
                        <?php 
                        $result = mysqli_query($conn, "SELECT * FROM jenis_pelanggaran");
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['jenis'] . "'> + ". $row['poin'] . " poin</option>";
                        }
                        ?>
                        </datalist>
                    <!-- input ini berfungsi untuk menampilkan data jenis pelanggaran dan poin yang akan dipilih -->
                    <input type="text" name="jenis_pelanggaran" value="<?php if(isset($_POST['jenis'])) { echo $_POST['jenis']; } else { echo ""; } ?>" list="jenis_pelanggaran" placeholder="pilih Jenis Pelanggaran" required autocomplete="off" style="width:200px">
                    
                    </td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td>:</td>
                    <!-- input ini berfungsi untuk menyimpan data keterangan -->
                    <td><textarea name="keterangan" id="" required></textarea></td>
                </tr>
            </table>
            <br>

            <input class="btn-warning" style="color:#fff; font-weight:bold" type="submit" value="submit">
        </fieldset>
    </form>
</center>

<?php
// Menyertakan file footer (biasanya berisi bagian bawah halaman)
include ROOTPATH . "/includes/footer.php";
?>

<!-- 
    🧠 Penjelasan Singkat:
	•	File ini digunakan untuk menampilkan form tambah pelanggaran siswa.
	•	Setelah pengguna mengisi data pelanggaran siswa, data akan dikirim ke /Poin_Pelanggaran_Siswa/process/pelanggaran_process.php menggunakan metode POST.
	•	File header dan footer dipakai agar tampilan halaman tetap konsisten di seluruh situs. 
-->
