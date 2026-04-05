<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/Poin_Pelanggaran_Siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT * FROM kelas WHERE id_kelas = '$id'
"));

$tingkat = mysqli_query($conn, "SELECT * FROM tingkat");
$program = mysqli_query($conn, "SELECT * FROM program_keahlian");
$guru = mysqli_query($conn, "SELECT * FROM guru");
?>

<center>
    <h2>Edit Data Kelas</h2>

    <form action="/Poin_Pelanggaran_Siswa/process/kelas_process.php" method="POST">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id_kelas" value="<?= $id; ?>">

        <table cellpadding="10">
            <tr>
                <td>Tingkat</td>
                <td>
                    <select name="id_tingkat" required>
                        <?php while($t = mysqli_fetch_assoc($tingkat)){ ?>
                            <option value="<?= $t['id_tingkat']; ?>"
                                <?= ($t['id_tingkat'] == $data['id_tingkat']) ? 'selected' : ''; ?>>
                                <?= $t['tingkat']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Program Keahlian</td>
                <td>
                    <select name="id_program_keahlian" required>
                        <?php while($p = mysqli_fetch_assoc($program)){ ?>
                            <option value="<?= $p['id_program_keahlian']; ?>"
                                <?= ($p['id_program_keahlian'] == $data['id_program_keahlian']) ? 'selected' : ''; ?>>
                                <?= $p['program_keahlian']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Rombel</td>
                <td>
                    <input type="number" name="rombel" value="<?= $data['rombel']; ?>" required>
                </td>
            </tr>

            <tr>
                <td>Wali Kelas</td>
                <td>
                    <select name="kode_guru" required>
                        <?php while($g = mysqli_fetch_assoc($guru)){ ?>
                            <option value="<?= $g['kode_guru']; ?>"
                                <?= ($g['kode_guru'] == $data['kode_guru']) ? 'selected' : ''; ?>>
                                <?= $g['nama_pengguna']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td colspan="2" align="right">
                    <button type="submit">Update</button>
                </td>
            </tr>
        </table>
    </form>
</center>

<?php include ROOTPATH . "/includes/footer.php"; ?>