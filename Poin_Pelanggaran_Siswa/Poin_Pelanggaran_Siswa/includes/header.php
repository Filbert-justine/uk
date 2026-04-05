<?php
session_start();
if(!isset($_SESSION['username'])){
    echo "<script>alert('anda belum login');window.location.href='/Poin_Pelanggaran_Siswa/login.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>· Poin Pelanggaran Siswa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <style>
        /* ============================================================
           CSS VARIABLES — BukuSaku Color System
        ============================================================ */
        :root {
            --navy:        #0f2547;
            --navy-mid:    #1a3a6b;
            --navy-light:  #234e8c;
            --gold:        #f0a500;
            --gold-light:  #fbbf24;
            --white:       #ffffff;
            --off-white:   #f4f7fc;
            --surface:     #eef2f9;
            --border:      #d0daea;
            --text-main:   #0f2547;
            --text-muted:  #5a7199;
            --red:         #e53935;
            --red-dark:    #b71c1c;
            --amber:       #f59e0b;
            --teal:        #0891b2;
            --shadow-sm:   0 1px 4px rgba(15,37,71,0.08);
            --shadow-md:   0 4px 16px rgba(15,37,71,0.12);
            --shadow-lg:   0 8px 32px rgba(15,37,71,0.18);
            --radius:      10px;
            --radius-lg:   16px;
        }

        *, *::before, *::after { 
            box-sizing: border-box; 
            margin: 0; 
            padding: 0; 
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: var(--text-main);
            background: var(--off-white);
        }

        h1, h2, h3 { 
            font-family: 'DM Serif Display', serif; 
            line-height: 1.2; 
        }
        
        a { 
            color: inherit; 
            text-decoration: none; 
        }

        /* ============================================================
           NAVBAR IMPROVEMENTS
        ============================================================ */
        nav {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 100%);
            padding: 0;
            top: 0;
            width: 100%;
            position: fixed;
            z-index: 9999;
            box-shadow: 0 4px 20px rgba(15,37,71,0.25);
            border-bottom: 1px solid rgba(240,165,0,0.15);
        }

        .nav-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .nav-brand-bar {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
        }

        .nav-brand-icon {
            width: 40px; 
            height: 40px;
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
            border-radius: 10px;
            display: flex; 
            align-items: center; 
            justify-content: center;
            font-family: 'DM Serif Display', serif;
            font-size: 20px; 
            color: var(--navy); 
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(240,165,0,0.35);
        }

        .nav-brand-text {
            font-family: 'DM Serif Display', serif;
            font-size: 20px; 
            color: var(--white);
            font-weight: bold;
        }

        .nav-brand-text span { 
            color: var(--gold); 
        }

        .nav-menu {
            display: flex;
            gap: 4px;
            flex-wrap: wrap;
            align-items: center;
        }

        nav ul {
            list-style: none;
            display: flex; 
            gap: 2px;
            flex-wrap: wrap;
        }

        nav ul li { 
            display: inline-block; 
        }

        nav ul li a {
            display: block;
            color: rgba(255,255,255,0.85);
            font-weight: 500; 
            font-size: 13px;
            padding: 10px 16px;
            border-radius: 8px;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        nav ul li a:hover {
            color: var(--white);
            background: rgba(240,165,0,0.15);
        }

        /* ============================================================
           DROPDOWN MENU
        ============================================================ */
        .dropdown { 
            position: relative; 
            display: inline-block; 
        }

        .dropdown-content {
            display: none;
            position: absolute;
            top: calc(100% + 8px);
            left: 50%; 
            transform: translateX(-50%);
            background: var(--white);
            min-width: 220px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border);
            overflow: hidden;
            z-index: 100;
            animation: slideDown 0.2s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateX(-50%) translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
        }

        .dropdown-content a {
            color: var(--text-main) !important;
            padding: 12px 16px;
            display: block;
            font-size: 13px; 
            font-weight: 500;
            transition: all 0.15s;
            border-left: 3px solid transparent;
        }

        .dropdown-content a:hover {
            background: var(--surface);
            border-left-color: var(--gold);
            padding-left: 20px;
            color: var(--navy) !important;
        }

        .dropdown:hover .dropdown-content { 
            display: block; 
        }

        .logout { 
            color: var(--red) !important; 
            font-weight: 600 !important; 
        }

        .logout:hover { 
            background: #fef2f2 !important; 
            border-left-color: var(--red) !important; 
        }

        /* ============================================================
           MAIN CONTENT
        ============================================================ */
        main {
            margin-top: 70px;
            min-height: calc(100vh - 70px);
            padding: 30px 24px;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
        }

        /* ============================================================
           RESPONSIVE
        ============================================================ */
        @media (max-width: 768px) {
            .nav-container {
                padding: 0 16px;
            }

            .nav-brand-text {
                font-size: 18px;
            }

            nav ul {
                gap: 0;
            }

            nav ul li a {
                padding: 8px 12px;
                font-size: 12px;
            }

            main {
                padding: 20px 16px;
            }
        }

        /* ============================================================
           DOCUMENT & TABLE STYLES (EXISTING)
        ============================================================ */
        @page { 
            size: A4; 
            margin: 0; 
        }

        .page {
            width: 210mm; 
            min-height: 297mm;
            padding: 20mm;
            margin: 16px auto;
            border-radius: var(--radius);
            background: var(--white);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border);
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
                padding: 10mm 20mm; 
                margin-top: -180px; 
            }
            .no-print { 
                display: none; 
            }
        }

        .header { 
            width: 100%; 
            margin-top: -10px; 
        }

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
            top: -5px; 
        }

        .field-masalah { 
            flex-grow: 1; 
            border-bottom: 1px dotted black; 
            position: relative; 
            top: -5px; 
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

        /* ============================================================
           TABLE STYLES
        ============================================================ */
        table { 
            width: 100%; 
            border-collapse: collapse; 
            background: var(--white); 
            font-size: 13px; 
        }

        table thead tr { 
            background: linear-gradient(135deg, var(--navy), var(--navy-mid)); 
        }

        table thead th {
            color: var(--white); 
            font-weight: 600;
            font-size: 11.5px; 
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 14px 16px; 
            text-align: left; 
            border: none;
        }

        table tbody tr { 
            transition: background 0.12s; 
            border-bottom: 1px solid var(--surface); 
        }

        table tbody tr:hover { 
            background: var(--off-white); 
        }

        table tbody td { 
            padding: 12px 16px; 
            border: none; 
            color: var(--text-main); 
            vertical-align: middle; 
        }

        table tbody tr:last-child { 
            border-bottom: none; 
        }

        .scroll { 
            overflow-x: auto; 
            border-radius: var(--radius); 
            box-shadow: var(--shadow-sm); 
            max-height: 680px; 
        }

        /* ============================================================
           BUTTONS
        ============================================================ */
        button, .btn {
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            gap: 6px;
            height: auto; 
            padding: 10px 20px;
            border: none; 
            border-radius: 8px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13px; 
            font-weight: 600;
            cursor: pointer;
            transition: all 0.18s ease;
            letter-spacing: 0.2px;
            text-decoration: none;
        }

        button a { 
            text-decoration: none; 
            color: inherit; 
            font-weight: 600; 
        }

        .btn-primary, button.btn-primary {
            background: linear-gradient(135deg, var(--navy-light), var(--navy));
            color: var(--white);
            box-shadow: 0 2px 8px rgba(15,37,71,0.25);
        }

        .btn-primary:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 4px 14px rgba(15,37,71,0.35); 
        }

        .btn-warning, button.btn-warning {
            background: linear-gradient(135deg, var(--gold-light), var(--amber));
            color: var(--navy);
            box-shadow: 0 2px 8px rgba(240,165,0,0.25);
        }

        .btn-warning:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 4px 14px rgba(240,165,0,0.4); 
        }

        .btn-danger, button.btn-danger {
            background: linear-gradient(135deg, #ef4444, var(--red-dark));
            color: var(--white);
            box-shadow: 0 2px 8px rgba(229,57,53,0.25);
        }

        .btn-danger:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 4px 14px rgba(229,57,53,0.4); 
        }

        button:not(.btn-primary):not(.btn-warning):not(.btn-danger) {
            background: var(--white); 
            color: var(--navy);
            border: 1.5px solid var(--border);
            box-shadow: var(--shadow-sm);
        }

        button:not(.btn-primary):not(.btn-warning):not(.btn-danger):hover {
            background: var(--surface); 
            border-color: var(--navy-light);
            transform: translateY(-2px); 
            box-shadow: var(--shadow-md);
        }

        /* ============================================================
           FORMS
        ============================================================ */
        .form-group { 
            margin-bottom: 20px; 
        }

        label {
            display: block; 
            font-weight: 600; 
            font-size: 12px;
            letter-spacing: 0.3px; 
            color: var(--text-muted);
            text-transform: uppercase; 
            margin-bottom: 8px;
        }

        input[type="text"], input[type="password"], input[type="email"],
        input[type="number"], input[type="date"], select, textarea {
            width: 100%; 
            padding: 11px 14px;
            border: 1.5px solid var(--border); 
            border-radius: 8px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13px; 
            color: var(--text-main);
            background: var(--white); 
            transition: all 0.18s; 
            outline: none;
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--navy-light);
            box-shadow: 0 0 0 3px rgba(35,78,140,0.1);
        }

        /* ============================================================
           CARDS & HEADINGS
        ============================================================ */
        h2 { 
            color: var(--navy); 
            font-size: 24px; 
            margin-bottom: 20px; 
            font-weight: 700;
        }

        h1 { 
            color: var(--navy); 
            font-size: 28px; 
            margin-bottom: 20px;
            font-weight: 700;
        }

        .card {
            background: var(--white); 
            border-radius: var(--radius-lg);
            border: 1px solid var(--border); 
            box-shadow: var(--shadow-sm);
            padding: 24px; 
            margin-bottom: 20px;
        }

        /* ============================================================
           SCROLLBAR
        ============================================================ */
        ::-webkit-scrollbar { 
            width: 8px; 
            height: 8px; 
        }

        ::-webkit-scrollbar-track { 
            background: var(--surface); 
            border-radius: 4px; 
        }

        ::-webkit-scrollbar-thumb { 
            background: var(--border); 
            border-radius: 4px; 
        }

        ::-webkit-scrollbar-thumb:hover { 
            background: var(--text-muted); 
        }

        .center { 
            text-align: center; 
        }
    </style>
</head>

<body>
    <header class="no-print">
        <?php
        if($_SESSION['role'] == 'Guru BK' || $_SESSION['role'] == 'Guru' || $_SESSION['role'] == 'Wakasek' || $_SESSION['role'] == 'Kepsek'){
        ?>
        <nav>
            <div class="nav-container">
                <div class="nav-brand-bar">
                    <div class="nav-brand-icon">P</div>
                    <div class="nav-brand-text">Pelanggaran<span>Siswa</span></div>
                </div>
                <ul class="nav-menu">
                    <li><a href="/Poin_Pelanggaran_Siswa/pages/dashboard.php">Dashboard</a></li>
                    <li class="dropdown">
                        <a href="#">Data ▾</a>
                        <ul class="dropdown-content">
                            <li><a href="/Poin_Pelanggaran_Siswa/pages/guru/list.php">Data Guru</a></li>
                            <li><a href="/Poin_Pelanggaran_Siswa/pages/siswa/list.php">Data Siswa</a></li>
                            <li><a href="/Poin_Pelanggaran_Siswa/pages/jenis_pelanggaran/list.php">Data Pelanggaran</a></li>
                            <li><a href="/Poin_Pelanggaran_Siswa/pages/kelas/list.php">Data Kelas</a></li>
                        </ul>
                    </li>
                    <li><a href="/Poin_Pelanggaran_Siswa/pages/pelanggaran/add.php">Entri Pelanggaran</a></li>
                    <li class="dropdown">
                        <a href="#">Laporan ▾</a>
                        <ul class="dropdown-content">
                            <li><a href="/Poin_Pelanggaran_Siswa/pages/laporan/list_pelanggaran.php">Laporan Pelanggaran Siswa</a></li>
                            <li><a href="/Poin_Pelanggaran_Siswa/pages/laporan/list_panggilan_ortu.php">Laporan Surat Panggilan Ortu</a></li>
                            <li><a href="/Poin_Pelanggaran_Siswa/pages/laporan/list_perjanjian.php">Laporan Surat Perjanjian</a></li>
                            <li><a href="/Poin_Pelanggaran_Siswa/pages/laporan/list_pindah.php">Laporan Surat Pindah</a></li>
                            <li><a href="/Poin_Pelanggaran_Siswa/pages/laporan/list_rekapitulasi_surat_perjanjian.php">Laporan Rekapitulasi Perjanjian</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#"><?php echo $_SESSION['nama_pengguna'];?> ▾</a>
                        <ul class="dropdown-content">
                            <li><a href="/Poin_Pelanggaran_Siswa/process/profil_process.php?action=edit">Edit Profil</a></li>
                            <li><a class="logout" href="/Poin_Pelanggaran_Siswa/logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <?php
        }elseif($_SESSION['role'] == 'siswa'){
        ?>
        <nav>
            <div class="nav-container">
                <div class="nav-brand-bar">
                    <div class="nav-brand-icon">P</div>
                    <div class="nav-brand-text">Pelanggaran<span>Siswa</span></div>
                </div>
                <ul class="nav-menu">
                    <li><a href="/Poin_Pelanggaran_Siswa/pages/dashboard.php">Dashboard</a></li>
                    <li class="dropdown">
                        <a href="#"><?php echo $_SESSION['nama_pengguna'];?> ▾</a>
                        <ul class="dropdown-content">
                            <li><a class="logout" href="/Poin_Pelanggaran_Siswa/logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <?php
        }
        ?>
    </header>

    <main>