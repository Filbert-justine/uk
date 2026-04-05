<?php
// Root path
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/Poin_Pelanggaran_Siswa');

// Koneksi DB
include ROOTPATH . "/config/config.php";

// Header
include ROOTPATH . "/includes/header.php";

// Ambil ID dari URL
$id = $_GET['id'];

// Ambil data jenis pelanggaran berdasarkan ID
$query = mysqli_query($conn, "SELECT * FROM jenis_pelanggaran WHERE id_jenis_pelanggaran = '$id'");
$data = mysqli_fetch_assoc($query);
?>

<center>
    <h2>Edit Data Jenis Pelanggaran</h2>

    <form action="/Poin_Pelanggaran_Siswa/process/jenis_pelanggaran_process.php" method="POST">
        <table cellpadding="10">

            <!-- hidden untuk proses -->
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" value="<?= $data['id_jenis_pelanggaran']; ?>">

            <tr>
                <td>
                    <input type="text" name="nama_pelanggaran"
                        value="<?= htmlspecialchars($data['jenis']); ?>"
                        required>
                </td>
            </tr>

            <tr>
                <td>
                    <input type="number" name="poin"
                        value="<?= htmlspecialchars($data['poin']); ?>"
                        required>
                </td>
            </tr>

            <tr>
                <td align="right">
                    <button type="submit">Update Data</button>
                </td>
            </tr>

        </table>
    </form>
</center>

<?php include ROOTPATH . "/includes/footer.php"; ?>