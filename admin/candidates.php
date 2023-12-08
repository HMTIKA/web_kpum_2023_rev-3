<?php

session_start();
include('../backend/connect/conn.php');
include('../backend/controllers/adminSessionController.php');
$keyComponent = "kpum";

function query($query)
{
    $result = mysqli_query($GLOBALS['conn'], $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

$data_kandidat = query("SELECT * FROM kandidat");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidates</title>
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

    <!-- SIDEBAR -->
    <?php 
        include '../component/sidebar.php'
    ?>
    <!-- END SIDEBAR -->

    <!-- JUMBOTRON 2 -->
    <section class="jumbotron-2 mt-5 pt-5">
        <div class="container">
            <div class="row">
                <p>
                    <a href="../">HOME</a> >
                    <a href="dashboard">ADMIN</a> >
                    CANDIDATES
                </p>
            </div>
        </div>
    </section>
    <!-- END JUMBOTRON 2 -->

    <!-- CANDIDATES -->
    <section class="candidates">
        <div class="container">
            <div class="row">
                <h1 class="mb-2">KANDIDAT</h1>
            </div>
            <div class="row">
                <?php $i = 1 ?>
                <?php foreach ($data_kandidat as $kandidat) { ?>
                    <div class="col-lg-4">
                        <div class="card p-3 mb-4">
                            <form action="">
                                <h2 class="card-title">KANDIDAT NOMOR <?= $i ?></h2>
                                <img src="<?= htmlspecialchars($kandidat['image'], ENT_QUOTES, 'UTF-8') ?>" alt="" class="card-image mb-2 w-100">
                                <label>Nama Capresma :</label>
                                <input type="text" value="<?= htmlspecialchars($kandidat['nama_capresma'], ENT_QUOTES, 'UTF-8') ?>">
                                <label>Nama Cawapresma :</label>
                                <input type="text" value="<?= htmlspecialchars($kandidat['nama_cawapresma'], ENT_QUOTES, 'UTF-8') ?>">
                                <button class="btn btn-md btn-warning w-100 mb-2 mt-2">Update</button>
                                <button class="btn btn-md btn-danger w-100">Delete</button>
                            </form>
                        </div>
                    </div>
                    <?php $i = $i + 1 ?>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Candidate -->




    <script src="../aset/js/jquery-3.5.1.js"></script>
    <script src="../aset/js/bootstrap.js"></script>
    <script src="../aset/js/script.js"></script>
</body>

</html>