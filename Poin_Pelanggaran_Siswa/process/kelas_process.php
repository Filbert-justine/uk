<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/Poin_Pelanggaran_Siswa');
include ROOTPATH . "/config/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $action = $_POST['action'];

    // ======================
    // TAMBAH KELAS
    // ======================
    if ($action == 'add') {

        $id_tingkat = $_POST['id_tingkat'];
        $id_program = $_POST['id_program_keahlian'];
        $rombel = $_POST['rombel'];
        $kode_guru = $_POST['kode_guru'];

        mysqli_query($conn, "
            INSERT INTO kelas (id_tingkat, id_program_keahlian, rombel, kode_guru)
            VALUES ('$id_tingkat', '$id_program', '$rombel', '$kode_guru')
        ");

        header("Location: ../pages/kelas/list.php");
        exit;

    // ======================
    // EDIT KELAS
    // ======================
    } elseif ($action == 'edit') {

        $id_kelas = $_POST['id_kelas'];
        $id_tingkat = $_POST['id_tingkat'];
        $id_program = $_POST['id_program_keahlian'];
        $rombel = $_POST['rombel'];
        $kode_guru = $_POST['kode_guru'];

        mysqli_query($conn, "
            UPDATE kelas SET
                id_tingkat = '$id_tingkat',
                id_program_keahlian = '$id_program',
                rombel = '$rombel',
                kode_guru = '$kode_guru'
            WHERE id_kelas = '$id_kelas'
        ");

        header("Location: ../pages/kelas/list.php");
        exit;

    // ======================
    // DELETE KELAS
    // ======================
    } elseif ($action == 'delete') {

        $id = $_POST['id'];
        mysqli_query($conn, "DELETE FROM kelas WHERE id_kelas = '$id'");
        header("Location: ../pages/kelas/list.php");
        exit;
    }
}