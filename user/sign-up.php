<?php 
    $keyComponent = "kpum";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN-UP</title>
    <link rel="stylesheet" href="../aset/css/bootstrap.css">
    <link rel="stylesheet" href="../aset/css/style.css">
    
    <link rel="shortcut icon" href="/aset/images/BEM.png" type="image/x-png">

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
                    SIGN UP
                </p>
            </div>
        </div>
    </section>
    <!-- END JUMBOTRON 2 -->

    <!-- ADD VOTERS -->
    <section class="sign-up">
        <div class="container">
            <div class="row">
                <h1>REGISTRASI PEMILIH</h1>
            </div>
            <div class="row">
                <form method="post">
                    <input type="text" name="identity_number" id="identity_number" placeholder="INPUT NIM atau NIDK">
                    <button type="submit" name="sign-up" class="btn btn-lg btn-primary mt-3">DAFTAR</button>
                </form>
            </div>
            <div class="row">
                <?php
                include '../backend/user/sign_up.php'
                ?>
            </div>
        </div>
    </section>
    <!-- END ADD VOTERS -->
    
    <script src="../aset/js/jquery-3.5.1.js"></script>
    <script src="../aset/js/bootstrap.js"></script>
    <script src="../aset/js/script.js"></script>
</body>

</html>