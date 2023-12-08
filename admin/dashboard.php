<?php

session_start();
include('../backend/connect/conn.php');
include('../backend/controllers/adminSessionController.php');
$keyComponent = "kpum";

function query($query) {
    $result = mysqli_query($GLOBALS['conn'], $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
// total pemilih
$total_pemilih = count(query("SELECT * FROM data_induk_pemilih"));
// total suara masuk 
$total_suara_masuk = count(query("SELECT * FROM votes"));
// total sisa suara masuk
$total_suara_belum_masuk = count(query("SELECT * FROM data_induk_pemilih WHERE is_voted = '0'"));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../aset/css/bootstrap.css">
    <link rel="stylesheet" href="../aset/css/style.css">
</head>

<body>

    <!-- navbar -->
    <nav class="navbar fixed-top" id="navbar" data-scroll-index="0">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <h1 class="navbar-brand">ADMINISTRATOR</h1>
            <div class="collapse navbar-collapse justify-content-end text-center" id="navbarNav">
            </div>
        </div>
    </nav>
    <!-- end navbar -->

    <?php 
        include '../component/sidebar.php'
    ?>

    <!-- JUMBOTRON 2 -->
    <section class="jumbotron-2 mt-5 pt-5">
        <div class="container">
            <div class="row">
                <p>
                    <a href="../">HOME</a> >
                    <a href="dashboard">ADMIN</a> >
                    DASHBOARD
                </p>
            </div>
        </div>
    </section>
    <!-- END JUMBOTRON 2 -->

    <!-- DATA SUARA -->
    <section class="data-suara">
        <div class="container">
            <div class="row">
                <h1 class="mb-3">DASHBOARD</h1>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <a class="card mb-3">
                        <h3>Total Pemilih </h3>
                        <p>
                            <?= $total_pemilih ?>
                            Pemilih</p>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a class="card mb-3">
                        <h3>Total Suara Masuk </h3>
                        <p>
                            <?= $total_suara_masuk ?>
                            Suara</p>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a class="card mb-3">
                        <h3>Sisa Suara Masuk </h3>
                        <p>
                            <?= $total_suara_belum_masuk ?>
                            Suara</p>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- DATA SUARA -->




    <script src="../aset/js/jquery-3.5.1.js"></script>
    <script src="../aset/js/bootstrap.js"></script>
    <script src="../aset/js/script.js"></script>
</body>

</html>