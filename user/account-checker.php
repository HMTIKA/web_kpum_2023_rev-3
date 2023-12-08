<?php 
    $keyComponent = "kpum";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACCOUNT CHECKER</title>
    <link rel="stylesheet" href="../aset/css/bootstrap.css">
    <link rel="stylesheet" href="../aset/css/style.css">
</head>

<body>

    <!-- navbar -->
    <?php 
        include '../component/navbar-user.php';
    ?>
    <!-- end navbar -->

    <!-- JUMBOTRON 2 -->
    <section class="jumbotron-2 mt-5 pt-5">
        <div class="container">
            <div class="row">
                <p>
                    <a href="/">HOME</a> >
                    ACCOUNT CHECKER
                </p>
            </div>
        </div>
    </section>
    <!-- END JUMBOTRON 2 -->

    <!-- Cek Akun -->
    <section class="cek-akun">
        <div class="container">
            <div class="row">
                <h1>CEK AKUN</h1>
            </div>
            <div class="row">
                <form method="post">
                    <input type="text" name="identity_number" placeholder="Masukan NIM atau NIDK">
                    <button type="submit" class="btn btn-lg btn-primary">CEK DATA</button>
                </form>
            </div>

            <!-- Tampil setelah di submit -->
            <div class="row ps-2 pe-3">
                <?php
                include '../backend/user/account_checker.php';
                ?>
            </div>
        </div>
    </section>
    <!-- End Cek Akun -->

    <script src="../aset/js/jquery-3.5.1.js"></script>
    <script src="../aset/js/bootstrap.js"></script>
    <script src="../aset/js/script.js"></script>
</body>

</html>