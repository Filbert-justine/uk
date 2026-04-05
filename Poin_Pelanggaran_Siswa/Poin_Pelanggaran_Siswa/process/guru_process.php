<?php
// Menentukan path utama proyek agar mudah memanggil file lain
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/Poin_Pelanggaran_Siswa');

// Menyertakan file konfigurasi database
include ROOTPATH . "/config/config.php";

// Mengecek apakah permintaan berasal dari metode POST (bukan GET)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $action = $_POST['action'];
    $kode_guru = $_POST['kode_guru'];
    
    // Proses tambah data guru
    if($action == 'add'){
        $nama_guru = $_POST['nama_guru'];
        $username = $_POST['username'];
        $jabatan = $_POST['jabatan'];
        $telp = $_POST['telp'];
        $password_input = password_hash("Guru12345*!", PASSWORD_DEFAULT);
        $role = $_POST["role"];
        
        $query = mysqli_query($conn, "INSERT INTO guru (kode_guru, nama_pengguna, role, username, password, aktif, jabatan, telp) VALUES ('$kode_guru', '$nama_guru', '$role', '$username', '$password_input', 'Y', '$jabatan', '$telp')");
        if($query){
            header("Location: ../pages/guru/list.php");
        }else{
            echo "Gagal Menambah Data Guru";
        }
    }

}
?>
