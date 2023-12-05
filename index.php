<?php
include 'backend/user/user_access.php';
$keyComponent = "kpum";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PEMILIHAN PRESIDEN DAN WAKIL PRESIDEN MAHASISWA</title>
    <link rel="stylesheet" href="aset/css/bootstrap.css">
    <link rel="stylesheet" href="aset/css/style.css">

    <link rel="shortcut icon" href="/aset/images/BEM.png" type="image/x-png">
</head>

<body>

    <!-- navbar -->
    <?php include('component/navbar-user.php'); ?>
    <!-- end navbar -->

    <!-- JUMBOTRON -->
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <img src="aset/images/logo.jpg" alt="">
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <h1>Hi, Welcome!</h1>
                        <h2>E-Vote Pilpresma & Wapresma <br> STIMIK Tunas Bangsa Banjarnegara 2023</h2>
                        <p>Suara anda tanggung jawab kami membawa perubahan gemilang.</p>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-4">
                            <a href="user/sign-up" class="btn btn-lg mb-3">REGISTRASI</a>
                        </div>
                        <div class="col-lg-4">
                            <a href="user/sign-in" class="btn btn-lg">LOGIN</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="adding">
            <div class="ripped-papper"></div>
            <div class="ripped-papper-2"></div>
        </div>
    </div>
    <!-- END JUMBOTRON -->

    <script src="aset/js/jquery-3.5.1.js"></script>
    <script src="aset/js/bootstrap.js"></script>
    <script src="aset/js/script.js"></script>
</body>

</html>