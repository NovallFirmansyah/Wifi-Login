<?php
include_once("koneksi.php");
session_start();

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: dashboard.php");
    exit;
}

if (isset($_POST['Login'])) {
    $pass = $_POST['Pass']; // Ambil password dari form input

    // Hash password yang diinput menggunakan SHA-256
    $hashed_pass = hash('sha256', $pass);

    // Lakukan query untuk mendapatkan password yang disimpan di database
    $cek_pass = mysqli_query($conn, "SELECT * FROM tb_pass");

    // Cek apakah ada data dalam tabel
    if (mysqli_num_rows($cek_pass) > 0) {
        // Loop untuk mengecek setiap data yang ada
        while ($data = mysqli_fetch_assoc($cek_pass)) {
            // Verifikasi password yang diinput dengan hash password di database
            if ($hashed_pass === $data['password']) {
                // Jika password cocok, simpan session dan redirect ke dashboard
                $_SESSION['loggedin'] = true;
                header("Location: dashboard.php");
                exit();
            }
        }
        
        // Jika password tidak cocok, berikan alert
        echo "<script>
                alert('Password salah!');
                window.location = 'index.php';
              </script>";
        exit();
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="./asset/Logo.png">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    <main class="main">
        <div class="navbar">
            <img src="./asset/Logo.png" >
            <ul>
                <li><a href="index.php" class="active">Wifi Login</a></li>    
                <li><a href="about.php">Informasi Kelompok</a></li>
            </ul>
        </div>
        <div class="home">
            <div class="home-content">
                <h1>WIFI LOGIN</h1>
                <p>Selamat datang di WIFI LOGIN kelompok 6, sebelum melanjutkan silahkan masukkan password terlebuh dahulu ya! </p>
                <button class="start">Masukkan Password</button>
            </div>
        </div>
    </main>
    
    <div class="popup-info">
    <div class="wrapper">
        <form action="" method="post">
            <h1>Wifi Login</h1>
                <div class="inputbox">
                    <input  type="password" required="requiered" name="Pass">
                    <span>password</span><br>
                </div>
            <button type="submit" name="Login" class="btn">Login</button>
            <button class="btn exit-btn">Kembali</button>
        </form>
    </div>
    <script src="Home.js"></script>
</body>

</html>