<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/Poin_Pelanggaran_Siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";

// ambil data tingkat, program keahlian, dan guru (wali kelas)
$tingkat = mysqli_query($conn, "SELECT * FROM tingkat");
$program = mysqli_query($conn, "SELECT * FROM program_keahlian");
$guru = mysqli_query($conn, "SELECT * FROM guru");
?>

<center>
    <h2>Tambah Data Kelas</h2>

    <form action="/Poin_Pelanggaran_Siswa/process/kelas_process.php" method="POST">
        <input type="hidden" name="action" value="add">

        <table cellpadding="10">
            <tr>
                <td>Tingkat</td>
                <td>
                    <select name="id_tingkat" required>
                        <option value="">-- Pilih Tingkat --</option>
                        <?php while($t = mysqli_fetch_assoc($tingkat)){ ?>
                            <option value="<?= $t['id_tingkat']; ?>"><?= $t['tingkat']; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Program Keahlian</td>
                <td>
                    <select name="id_program_keahlian" required>
                        <option value="">-- Pilih Program --</option>
                        <?php while($p = mysqli_fetch_assoc($program)){ ?>
                            <option value="<?= $p['id_program_keahlian']; ?>"><?= $p['program_keahlian']; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Rombel</td>
                <td><input type="number" name="rombel" required></td>
            </tr>

            <tr>
                <td>Wali Kelas</td>
                <td>
                    <select name="kode_guru" required>
                        <option value="">-- Pilih Guru --</option>
                        <?php while($g = mysqli_fetch_assoc($guru)){ ?>
                            <option value="<?= $g['kode_guru']; ?>"><?= $g['nama_pengguna']; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td colspan="2" align="right">
                    <button type="submit">Simpan</button>
                </td>
            </tr>
        </table>
    </form>
</center>

<?php include ROOTPATH . "/includes/footer.php"; ?>