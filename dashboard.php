<?php
session_start();

// Cek apakah user sudah login atau belum
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

// Cek jika tombol Logout ditekan
if (isset($_POST['Logout'])) {
    // Hancurkan session
    session_unset();
    session_destroy();
    
    // Redirect ke halaman login
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Berhasil</title>
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
        </div>
        <div class="home">
            <div class="home-content">
            <div class="wrapper">
                <form action="" method="post">
                <h1>Login berhasil!</h1><br>
                <button type="submit" name="Logout" class="btn">Logout</button>
                </form>
            </div>
        </div>
    </main>


</body>
</html>