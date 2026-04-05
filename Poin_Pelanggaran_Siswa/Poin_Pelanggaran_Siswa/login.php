<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PelanggaranSiswa - Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --navy: #0f2547;
            --navy-mid: #1a3a6b;
            --navy-light: #234e8c;
            --gold: #f0a500;
            --gold-light: #fbbf24;
            --white: #ffffff;
            --off-white: #f4f7fc;
            --surface: #eef2f9;
            --border: #d0daea;
            --text-main: #0f2547;
            --text-muted: #5a7199;
        }

        body.login-page {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 50%, var(--navy-light) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
            position: relative;
            overflow-x: hidden;
        }

        /* Decorative circles — pointer-events off so they never clip content */
        body.login-page::before {
            content: '';
            position: fixed;
            width: 420px;
            height: 420px;
            background: rgba(240, 165, 0, 0.09);
            border-radius: 50%;
            top: -60px;
            right: -80px;
            pointer-events: none;
        }

        body.login-page::after {
            content: '';
            position: fixed;
            width: 320px;
            height: 320px;
            background: rgba(8, 145, 178, 0.09);
            border-radius: 50%;
            bottom: -80px;
            left: -80px;
            pointer-events: none;
        }

        .login-container {
            background: var(--white);
            border-radius: 20px;
            box-shadow: 0 8px 40px rgba(15, 37, 71, 0.22);
            width: 100%;
            max-width: 460px;
            padding: 40px 40px 36px;
            position: relative;
            z-index: 1;
        }

        /* ── Header ── */
        .login-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .login-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .login-brand-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'DM Serif Display', serif;
            font-size: 26px;
            color: var(--navy);
            font-weight: bold;
            box-shadow: 0 4px 14px rgba(240, 165, 0, 0.3);
            flex-shrink: 0;
        }

        .login-brand-text {
            font-family: 'DM Serif Display', serif;
            font-size: 26px;
            color: var(--navy);
        }

        .login-brand-text span {
            color: var(--gold);
        }

        .login-title {
            font-size: 22px;
            color: var(--navy);
            margin-bottom: 6px;
            font-weight: 700;
        }

        .login-subtitle {
            font-size: 13px;
            color: var(--text-muted);
        }

        /* ── Form ── */
        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 7px;
        }

        .form-group input {
            width: 100%;
            padding: 11px 15px;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px;
            color: var(--text-main);
            transition: border-color 0.25s, box-shadow 0.25s;
            background: var(--white);
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(240, 165, 0, 0.12);
        }

        .form-group input::placeholder {
            color: #a0aec0;
        }

        .login-btn {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, var(--navy-light) 0%, var(--navy) 100%);
            color: var(--white);
            border: none;
            border-radius: 10px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.4px;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 14px rgba(15, 37, 71, 0.28);
            margin-top: 6px;
        }

        .login-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(15, 37, 71, 0.36);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        /* ── Demo accounts ── */
        .demo-accounts {
            background: var(--surface);
            border-radius: 12px;
            padding: 18px;
            margin-top: 24px;
            border-left: 4px solid var(--gold);
        }

        .demo-title {
            font-size: 11px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 14px;
        }

        .demo-account {
            background: var(--white);
            padding: 12px 14px;
            border-radius: 9px;
            margin-bottom: 10px;
            border: 1px solid var(--border);
            font-size: 12px;
            line-height: 1.65;
        }

        .demo-account:last-child {
            margin-bottom: 0;
        }

        .demo-account strong.role {
            color: var(--navy);
            display: block;
            margin-bottom: 5px;
            font-weight: 700;
            font-size: 12.5px;
        }

        .demo-account span {
            color: var(--text-muted);
            display: block;
        }

        .demo-account span b {
            color: var(--navy);
            font-weight: 600;
            margin-right: 4px;
        }

        /* ── Responsive ── */
        @media (max-width: 520px) {
            .login-container {
                padding: 32px 22px 28px;
                border-radius: 16px;
            }

            .login-brand-text { font-size: 22px; }
            .login-title { font-size: 19px; }
        }
    </style>
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-header">
            <div class="login-brand">
                <div class="login-brand-icon">P</div>
                <div class="login-brand-text">Pelanggaran<span>Siswa</span></div>
            </div>
            <h1 class="login-title">Selamat Datang</h1>
            <p class="login-subtitle">Sistem Manajemen Pelanggaran Siswa</p>
        </div>

        <form action="/Poin_Pelanggaran_Siswa/process/login_process.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username" autocomplete="off" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" autocomplete="off" required>
            </div>

            <button type="submit" class="login-btn">Login</button>
        </form>

        <div class="demo-accounts">
            <div class="demo-title">🔑 Akun Demo</div>

            <div class="demo-account">
                <strong class="role">Guru</strong>
                <span><b>Username:</b> sucana</span>
                <span><b>Password:</b> Guru12345*!</span>
            </div>

            <div class="demo-account">
                <strong class="role">Siswa</strong>
                <span><b>Username:</b> 9125</span>
                <span><b>Password:</b> Siswa12345*!</span>
            </div>

            <div class="demo-account">
                <strong class="role">Guru BK</strong>
                <span><b>Username:</b> anjani</span>
                <span><b>Password:</b> GuruBK</span>
            </div>
        </div>
    </div>
</body>
</html>