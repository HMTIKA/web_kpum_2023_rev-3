<?php 
session_start();
include('../backend/controllers/adminSessionController.php');
$keyComponent = "kpum";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Voters</title>
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
                    ADD VOTERS
                </p>
            </div>
        </div>
    </section>
    <!-- END JUMBOTRON 2 -->

    <!-- ADD VOTERS -->
    <section class="add-voters">
        <div class="container">
            <div class="row">
                <h1>TAMBAH PEMILIH</h1>
            </div>
            <div class="row">
                <form action="#">
                    <label class="mt-3 mb-1">Nama : </label>
                    <input type="text" name="nama" id="" placeholder="nama">
                    <label class="mt-3 mb-1">Nomor : </label>
                    <input type="text" name="nomor" id="" placeholder="NIM atau NIDK">
                    <button type="submit" name="add-voters" class="btn btn-lg btn-primary mt-3">SUBMIT</button>
                </form>
            </div>
        </div>
    </section>
    <!-- END ADD VOTERS -->




    <script src="../aset/js/jquery-3.5.1.js"></script>
    <script src="../aset/js/bootstrap.js"></script>
    <script src="../aset/js/script.js"></script>
</body>

</html>