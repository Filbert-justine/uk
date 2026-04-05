<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <center>
        <h2>Login</h2>
        <form action="/Poin_Pelanggaran_Siswa/process/login_process.php" method="POST">
            <!-- input username -->
            <input type="text" name="username" placeholder="Username" autocomplete="off" required/><br><br>
            <!-- input password -->
            <input type="password" name="password" placeholder="Password" autocomplete="off" required/><br><br>
            <!-- button login -->
            <button type="submit">Login</button>
        </form>
        <br><br><br>
        <!-- Contoh akun -->
        Username: sucana <br>
        Password: Guru12345*! <br>
        Role: Guru <br><br>
        
        Username: 9125 <br>
        Password: Siswa12345*! <br>
        Role: Siswa <br><br>

        Username: anjani <br>
        Password: GuruBK <br>
        Role: Guru BK <br><br>

        <!-- edit dari dewi -->
    </center>
</body>
</html>
