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
<div class="banner">
        <video src="./asset/bgvid.mp4" type="video/mp4" autoplay muted loop></video>
    
    <!-- Header -->

    <div class="content" id="home"> 
        <nav>
            <img src="./asset/Logo.png" class="logo" alt="Logo" title="Wifi Login">
            
            <ul class="navbar">
                <li>
                    <a href="./about.php">Informasi Kelompok</a>
                </li>
            </ul>
        </nav>
</body>

<body1>
    <div class="wrapper">
        <form action="" method="post">
            <h1>Wifi Login</h1>
                <div class="inputbox">
                    <input  type="password" required="Requiered" name="Pass">
                    <span>password</span><br>
                </div>
            <button type="submit" name="Login" class="btn">Login</button>
        </form>
    </div>
</body1>
</html>