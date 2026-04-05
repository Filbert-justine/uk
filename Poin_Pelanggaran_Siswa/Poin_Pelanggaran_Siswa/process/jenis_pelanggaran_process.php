<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/Poin_Pelanggaran_Siswa');
include ROOTPATH . "/config/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $action = $_POST['action'];

    // ======================
    // TAMBAH DATA
    // ======================
    if ($action == 'add') {

        $pelanggaran = $_POST['nama_pelanggaran'];
        $poin = $_POST['poin'];

        $query = mysqli_query($conn, "
            INSERT INTO jenis_pelanggaran (jenis, poin)
            VALUES ('$pelanggaran', '$poin')
        ");

        if ($query) {
            echo "<script>alert('Berhasil Menambah Data'); window.location.href='../pages/jenis_pelanggaran/list.php';</script>";
        } else {
            echo "<script>alert('Gagal Menambah Data'); window.location.href='../pages/jenis_pelanggaran/add.php';</script>";
        }

    // ======================
    // EDIT DATA
    // ======================
    } elseif ($action == 'edit') {

        $id = $_POST['id'];
        $pelanggaran = $_POST['nama_pelanggaran'];
        $poin = $_POST['poin'];

        $query = mysqli_query($conn, "
            UPDATE jenis_pelanggaran SET
                jenis = '$pelanggaran',
                poin = '$poin'
            WHERE id_jenis_pelanggaran = '$id'
        ");

        if ($query) {
            echo "<script>alert('Berhasil Mengubah Data'); window.location.href='../pages/jenis_pelanggaran/list.php';</script>";
        } else {
            echo "<script>alert('Gagal Mengubah Data'); window.location.href='../pages/jenis_pelanggaran/edit.php?id=$id';</script>";
        }

    // ======================
    // HAPUS DATA
    // ======================
    } elseif ($action == 'delete') {

        $id = $_POST['id'];

        mysqli_query($conn, "DELETE FROM jenis_pelanggaran WHERE id_jenis_pelanggaran = '$id'");
        header("Location: ../pages/jenis_pelanggaran/list.php");
        exit;
    }
}
?>