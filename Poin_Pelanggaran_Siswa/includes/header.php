<?php
session_start();
if(!isset($_SESSION['username'])){
    echo "<script>alert('anda belum login');window.location.href='/Poin_Pelanggaran_Siswa/login.php';</script>";
}
?>

<!-- Menandakan bahwa ini adalah dokumen HTML5 -->
<!DOCTYPE html>

<!-- Tag utama pembungkus seluruh halaman, dengan bahasa Indonesia -->
<html lang="id">

<head>
    <!-- Mengatur karakter huruf agar teks tampil dengan benar -->
    <meta charset="UTF-8" />

    <!-- Judul halaman yang tampil di tab browser -->
    <title>Poin Pelanggaran Siswa</title>

    <!-- Bagian untuk menulis style (CSS) -->
    <style>

    /* bagian css navbar */
    nav {
        background: #007bff;
        padding: 10px 0;
        top: 0;
        width: 100%;
        position: fixed;
        z-index: 9999;
    }
    nav ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        gap: 20px;
        justify-content: center;
    }
    nav ul li {
        display: inline;
    }
    nav ul li a {
        color: #fff;
        text-decoration: none;
        font-weight: bold;
        padding: 8px 16px;
        transition: background 0.2s;
    }
    nav ul li a:hover {
        background: #0056b3;
    }
    .scroll {
        overflow-x: scroll;
        max-height: 700px;
    }
    .lebar {
        width: 600px;
    }
    .dropdown {
        position: relative;
        display: inline-block;
    }
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #007bff;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        margin-top: 5px;
    }
    .dropdown-content a {
        color: white;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }
    .dropdown-content a:hover {
        background-color: #0056b3;
    }
    .dropdown:hover .dropdown-content {
        display: block;
    }
    .logout{
        background-color: #fe4a4a !important;
    }
    .logout:hover{
        background-color: #d61a1aff !important;
    }
    main{
        margin-top: 180px;
    }
    /* bagian css navbar */

    /* bagian css template cetak dokumen */
    @page {
        size: A4;
        margin: 0;
    }
    body {
        font-family: "Times New Roman", Times, serif;
        font-size: 12pt;
        line-height: 1.5;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
    }
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        margin: 10mm auto;
        border: 1px solid #D3D3D3;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        box-sizing: border-box;
        position: relative;
    }
    @media print {
        body, .page {
            margin: 0;
            box-shadow: none;
            border: none;
            width: auto;
            height: auto; 
            background: none;
            margin-top: -100px;
        }
        .page {
            padding: 10mm 20mm; /* Adjust margins for print */
            margin-top: -180px;
        }
        .no-print{
            display: none;
        }
    }

    /* Header Style */
    .header {
        width: 100%;
        margin-top: -10px;
    }

    /* Content Style */
    .title {
        text-align: center;
        font-weight: bold;
        font-size: 14pt;
        text-transform: uppercase;
    }
    .content {
        text-align: justify;
    }
    .form-row {
        display: flex;
    }
    .label {
        width: 160px;
        flex-shrink: 0;
    }
    .separator {
        width: 10px;
        flex-shrink: 0;
    }
    .field {
        flex-grow: 1;
        border-bottom: 1px dotted black;
        position: relative;
        top: -5px; /* Adjust alignment with text */
    }
    .field-masalah {
        flex-grow: 1;
        border-bottom: 1px dotted black;
        position: relative;
        top: -5px; /* Adjust alignment with text */
        text-decoration: underline 1px dotted black;
        text-underline-offset: 7px;
    }
    .dotted-line {
        width: 100%;
        border-bottom: 1px dotted black;
        height: 20px;
        margin-bottom: 5px;
    }
    .indent {
        padding-left: 30px;
    }
    .statement {
        margin-top: 5px;
        margin-bottom: 5px;
        text-indent: 30px;
    }

    /* bagian tanda tangan */
    .signature-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-top: 20px;
    }
    .sig-block {
        text-align: left;
        margin-bottom: 20px;
    }
    .sig-right {
        text-align: left;
        padding-left: 40px;
    }
    .sig-name {
        text-decoration: underline;
        margin-top: 60px;
    }
    .sig-name-plain {
        margin-top: 60px;
        text-decoration: underline;
        display: inline-block;
    }
    .footer-sig {
        text-align: center;
        margin-top: 10px;
    }
    .footer-sig .sig-name {
        display: inline-block;
        margin-top: 70px;
    }
    /* bagian css template cetak dokumen */

    /* button/tombol */
    .btn-primary{
        padding: 10px 15px;        
        background-color: #007bff;
        border: 0;
        border-radius: 5px;
    }
    .btn-warning{
        padding: 10px 15px;        
        background-color: #ffb300ff;
        border: 0;
        border-radius: 5px;
    }
    .btn-danger{
        padding: 10px 15px;        
        background-color: #fb1212ff;
        border: 0;
        border-radius: 5px;
        color: #fff;
        font-weight: bold;
    }
    button a{
        text-decoration: none;
        color: #fff;
        font-weight: bold;
    }
    .btn-primary:hover{
        background-color: #0056b3;
    }
    .btn-warning:hover{
        background-color: #ff9900ff;
    }
    .btn-danger:hover{
        background-color: #cf0505ff;
    }
    /* button/tombol */



    /* animasi icon panah kembali dan icon printer dalam tombol*/ 
    button {
    display: flex;
    height: 3em;
    align-items: center;
    justify-content: center;
    background-color: #eeeeee4b;
    border-radius: 3px;
    letter-spacing: 1px;
    transition: all 0.2s linear;
    cursor: pointer;
    border: none;
    background: #fff;
    }
    button > svg {
    margin-right: 5px;
    margin-left: 5px;
    font-size: 20px;
    transition: all 0.4s ease-in;
    }
    button:hover > svg {
    font-size: 1.2em;
    transform: translateX(-5px);
    }
    button:hover {
    box-shadow: 9px 9px 33px #d1d1d1, -9px -9px 33px #ffffff;
    transform: translateY(-2px);
    }

    
    .printer-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 100%;
    }
    .printer-container {
    height: 50%;
    width: 100%;
    display: flex;
    align-items: flex-end;
    justify-content: center;
    }
    .printer-container svg {
    width: 100%;
    height: auto;
    transform: translateY(4px);
    }
    .printer-page-wrapper {
    width: 100%;
    height: 50%;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    }
    .printer-page {
    width: 70%;
    height: 10px;
    border: 1px solid black;
    background-color: white;
    transform: translateY(0px);
    transition: all 0.3s;
    transform-origin: top;
    }
    .print-btn:hover .printer-page {
    height: 16px;
    }
    /* animasi icon printer */
    </style>
</head>

<body>
    <!-- Bagian header (bagian atas halaman) -->
    <header class="no-print">

        <!-- Navigasi menu utama -->
        <?php
        if($_SESSION['role'] == 'Guru BK' || $_SESSION['role'] == 'Guru' || $_SESSION['role'] == 'Wakasek' || $_SESSION['role'] == 'Kepsek'){
        ?>
        <nav>
            <center><h1 style="color:#fff">Poin Pelanggaran Siswa</h1></center>
            <hr>
            <!-- Daftar menu navigasi -->
            <ul>
                <!-- Setiap item menu -->
                <li><a href="/Poin_Pelanggaran_Siswa/pages/dashboard.php">Dashboard</a></li>
                <!-- dropdown semua data-->
                <li class="dropdown">
                    <a href="#">Data</a>
                    <ul class="dropdown-content">
                        <li><a href="/Poin_Pelanggaran_Siswa/pages/guru/list.php">Data Guru</a></li>
                        <li><a href="/Poin_Pelanggaran_Siswa/pages/siswa/list.php">Data Siswa</a></li>
                        <li><a href="/Poin_Pelanggaran_Siswa/pages/jenis_pelanggaran/list.php">Data Pelanggaran</a></li>
                        <li><a href="/Poin_Pelanggaran_Siswa/pages/kelas/list.php">Data Kelas</a></li>
                    </ul>
                </li>
                <li><a href="/Poin_Pelanggaran_Siswa/pages/pelanggaran/add.php">Entri Pelanggaran</a></li>
                <!-- dropdown semua data-->
                <li class="dropdown">
                    <a href="#">Laporan</a>
                    <ul class="dropdown-content">
                        <li><a href="/Poin_Pelanggaran_Siswa/pages/laporan/list_pelanggaran.php">Laporan Pelanggaran Siswa</a></li>
                        <li><a href="/Poin_Pelanggaran_Siswa/pages/laporan/list_panggilan_ortu.php">Laporan Surat Panggilan Ortu</a></li>
                        <li><a href="/Poin_Pelanggaran_Siswa/pages/laporan/list_perjanjian.php">Laporan Surat Perjanjian</a></li>
                        <li><a href="/Poin_Pelanggaran_Siswa/pages/laporan/list_pindah.php">Laporan Surat Pindah</a></li>
                        <li><a href="/Poin_Pelanggaran_Siswa/pages/laporan/list_rekapitulasi_surat_perjanjian.php">Laporan Rekapitulasi Surat Perjanjian</a></li>
                    </ul>
                </li>
                <li class="dropdown"> 
                    <a href="#"><?php echo $_SESSION['nama_pengguna'];?></a>
                    <ul class="dropdown-content">
                        <li><a href="/Poin_Pelanggaran_Siswa/process/profil_process.php?action=edit">Edit Profil</a></li>
                        <li><a class="logout" href="/Poin_Pelanggaran_Siswa/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>


        <!-- Navigasi menu utama siswa-->
        <?php
        }elseif($_SESSION['role'] == 'siswa'){
        ?>
        <nav>
            <center><h1 style="color:#fff">Poin Pelanggaran Siswa</h1></center>
            <hr>
            <!-- Daftar menu navigasi -->
            <ul>
                <!-- Setiap item menu -->
                <li><a href="/Poin_Pelanggaran_Siswa/pages/dashboard.php">Dashboard</a></li>
                <li class="dropdown"> 
                    <a href="#"><?php echo $_SESSION['nama_pengguna'];?></a>
                    <ul class="dropdown-content">
                        <li><a href="/Poin_Pelanggaran_Siswa/process/profil_process.php?action=edit">Edit Profil</a></li>
                        <li><a class="logout" href="/Poin_Pelanggaran_Siswa/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <?php
        }
        ?>
    </header>

    <!-- Bagian utama halaman, tempat isi konten ditampilkan -->
    <main>


    <!-- 
    💡 Penjelasan ringkas struktur HTML-nya:
	•	<!DOCTYPE html> → Menentukan dokumen ini memakai standar HTML5.
	•	<html lang="id"> → Bahasa halaman adalah bahasa Indonesia.
	•	<head> → Bagian kepala, berisi pengaturan halaman (judul, karakter, style).
	•	<body> → Bagian isi tampilan halaman.
	•	<header> → Bagian atas, biasanya berisi judul dan menu navigasi.
	•	<nav> → Area navigasi untuk berpindah ke halaman lain.
	•	<ul> dan <li> → Menyusun daftar menu.
	•	<main> → Area utama yang nanti berisi konten dari halaman lain. 
    -->
