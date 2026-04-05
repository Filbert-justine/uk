<?php
// Menentukan root path proyek
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/Poin_Pelanggaran_Siswa');

// Koneksi database
include ROOTPATH . "/config/config.php";

// Header
include ROOTPATH . "/includes/header.php";

// Ambil NIS dari URL
$nis = $_GET['id'];

// Query data siswa + ortu + kelas
$query = mysqli_query($conn, "
    SELECT * FROM siswa
    JOIN ortu_wali USING(id_ortu_wali)
    JOIN kelas USING(id_kelas)
    JOIN tingkat USING(id_tingkat)
    JOIN program_keahlian USING(id_program_keahlian)
    WHERE nis = '$nis'
");

$data = mysqli_fetch_assoc($query);
?>

<center>
    <h2>Edit Data Siswa</h2>

    <form action="/Poin_Pelanggaran_Siswa/process/siswa_process.php" method="POST">
        <fieldset style="width: 30%;">
            <legend>Data Siswa</legend>
            <table cellpadding="10">

                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="nis" value="<?= $data['nis']; ?>">

                <tr>
                    <td>
                        <input type="text" value="<?= $data['nis']; ?>" disabled><br><br>
                        <input type="text" name="nama_siswa" value="<?= $data['nama_siswa']; ?>" required>
                    </td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <textarea name="alamat_siswa" cols="20" rows="5" required><?= $data['alamat']; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Jenis Kelamin :</td>
                </tr>
                <tr>
                    <td>
                        <input type="radio" name="jenis_kelamin" value="Laki - Laki"
                            <?= ($data['jenis_kelamin'] == 'Laki - Laki') ? 'checked' : ''; ?>>
                        Laki - Laki

                        <input type="radio" name="jenis_kelamin" value="Perempuan"
                            <?= ($data['jenis_kelamin'] == 'Perempuan') ? 'checked' : ''; ?>>
                        Perempuan
                    </td>
                    <td></td>
                    <td>
                        <input type="text" name="kelas"
                            value="<?= $data['tingkat'].' '.$data['program_keahlian'].' '.$data['rombel']; ?>"
                            readonly>
                    </td>
                </tr>
            </table>
        </fieldset>

        <fieldset style="width: 40%;">
            <legend>Data Orang Tua / Wali</legend>
            <table cellpadding="10">
                <tr>
                    <td><input type="text" name="ayah" value="<?= $data['ayah']; ?>"></td>
                    <td><input type="text" name="pekerjaan_ayah" value="<?= $data['pekerjaan_ayah']; ?>"></td>
                    <td><input type="number" name="telp_ayah" value="<?= $data['no_telp_ayah']; ?>"></td>
                    <td><textarea name="alamat_ayah"><?= $data['alamat_ayah']; ?></textarea></td>
                </tr>

                <tr>
                    <td><input type="text" name="ibu" value="<?= $data['ibu']; ?>"></td>
                    <td><input type="text" name="pekerjaan_ibu" value="<?= $data['pekerjaan_ibu']; ?>"></td>
                    <td><input type="number" name="telp_ibu" value="<?= $data['no_telp_ibu']; ?>"></td>
                    <td><textarea name="alamat_ibu"><?= $data['alamat_ibu']; ?></textarea></td>
                </tr>

                <tr>
                    <td><input type="text" name="wali" value="<?= $data['wali']; ?>"></td>
                    <td><input type="text" name="pekerjaan_wali" value="<?= $data['pekerjaan_wali']; ?>"></td>
                    <td><input type="number" name="telp_wali" value="<?= $data['no_telp_wali']; ?>"></td>
                    <td><textarea name="alamat_wali"><?= $data['alamat_wali']; ?></textarea></td>
                </tr>

                <tr>
                    <td colspan="4" align="right">
                        <button type="submit">Update</button>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</center>

<?php include ROOTPATH . "/includes/footer.php"; ?>