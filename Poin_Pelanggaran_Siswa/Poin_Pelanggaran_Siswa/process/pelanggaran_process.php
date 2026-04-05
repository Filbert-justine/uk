<?php
// Menentukan path utama proyek agar mudah memanggil file lain
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/Poin_Pelanggaran_Siswa');

// Menyertakan file konfigurasi database
include ROOTPATH . "/config/config.php";

// Mengecek apakah permintaan berasal dari metode POST (bukan GET)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $action = $_POST['action'];
    
    // Proses tambah data jenis pelanggaran
    if($action == 'add'){

        $tanggal = date('Y-m-d H:i:s');
        $nis = $_POST['nis'];
        $jenis_pelanggaran = $_POST['jenis_pelanggaran'];
        $id_jenis_pelanggaran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id_jenis_pelanggaran FROM jenis_pelanggaran WHERE jenis = '$jenis_pelanggaran'"))['id_jenis_pelanggaran'];
        $keterangan = $_POST['keterangan'];
        
        $query = mysqli_query($conn, "INSERT INTO pelanggaran_siswa (tanggal, nis, id_jenis_pelanggaran, keterangan) VALUES ('$tanggal', '$nis', '$id_jenis_pelanggaran', '$keterangan')");
        if($query){
            echo "<script>alert('Berhasil Menambah Data Pelanggaran'); window.location.href = '../pages/pelanggaran/add.php';</script>";
        }else{
            echo "<script>alert('Gagal Menambah Data Pelanggaran'); window.location.href = '../pages/pelanggaran/add.php';</script>";
        }
    }

}
?>
