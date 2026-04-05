<?php
// Menentukan lokasi root folder proyek di server
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/Poin_Pelanggaran_Siswa');

// Menghubungkan ke file konfigurasi (koneksi database)
include ROOTPATH . "/config/config.php";

// Menyertakan tampilan header (bagian atas halaman)
include ROOTPATH . "/includes/header.php";

// Mengambil semua data guru dari tabel 'guru' 
$result = mysqli_query($conn, "SELECT * FROM guru WHERE aktif = 'Y'");
$result_nonaktif = mysqli_query($conn, "SELECT * FROM guru WHERE aktif = 'N'");
?>

<!-- Bagian tampilan daftar guru --> 
<center>
    <h2>List Guru</h2>

    <!-- Tombol untuk menuju halaman tambah guru -->
    <button class="btn-primary"><a href="add.php">Tambah Data Guru</a></button><br><br>

    <fieldset>
    <div class="scroll">
        <!-- Membuat tabel untuk menampilkan daftar guru -->
        <table border="1" cellpadding="10" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Guru</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Jabatan</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
                </thead>
            <tbody>
                <?php 
                // Variabel untuk nomor urut
                $no = 1;

                // Menampilkan semua data guru dari hasil query
                while ($row = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <!-- Menampilkan nomor urut -->
                    <td><?= $no++?></td>
                    <!-- Menampilkan data guru, fungsi dari htmlspecialchars() untuk memfilter data agar aman dari XSS -->
                    <td><?= htmlspecialchars($row['kode_guru']) ?></td>
                    <td><?= htmlspecialchars($row['nama_pengguna']) ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['jabatan']) ?></td>
                    <td><?= htmlspecialchars($row['telp']) ?></td>
                    <!-- Tombol edit untuk ubah data guru -->
                    <td>
                        <center><button class="btn-warning"><a href="edit.php?kode_guru=<?= $row['kode_guru'] ?>">Edit</a></button></center>
                    </td>

                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    </fieldset>






    <br>
    <fieldset>
    <h2>List Guru Non-Aktif</h2>

    <div class="scroll">
        <!-- Membuat tabel untuk menampilkan daftar guru Non-Aktif -->
        <table border="1" cellpadding="10" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Guru</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Jabatan</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
                </thead>
            <tbody>
                <?php 
                // Variabel untuk nomor urut
                $no = 1;

                // Menampilkan semua data guru dari hasil query
                while ($row = mysqli_fetch_assoc($result_nonaktif)){ ?>
                <tr>
                    <!-- Menampilkan nomor urut -->
                    <td><?= $no++?></td>
                    <!-- Menampilkan data guru, fungsi dari htmlspecialchars() untuk memfilter data agar aman dari XSS -->
                    <td><?= htmlspecialchars($row['kode_guru']) ?></td>
                    <td><?= htmlspecialchars($row['nama_pengguna']) ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['jabatan']) ?></td>
                    <td><?= htmlspecialchars($row['telp']) ?></td>
                    <!-- Tombol edit untuk ubah data guru -->
                    <td>
                        <center><button class="btn-warning"><a href="edit.php?kode_guru=<?= $row['kode_guru'] ?>">Edit</a></button></center>
                    </td>

                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    </fieldset>
</center>

<?php 
// Menyertakan bagian footer (penutup halaman)
include "../../includes/footer.php"; 
?>
