<?php 
include 'backend/user/user_access.php';
include 'backend/controllers/userFeedback.php';
$keyComponent = "kpum";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KRITIK DAN SARAN</title>
    <link rel="stylesheet" href="../aset/css/bootstrap.css">
    <link rel="stylesheet" href="../aset/css/style.css">

    <link rel="shortcut icon" href="/aset/images/BEM.png" type="image/x-png">

</head>

<body>

    <!-- navbar -->
    <?php 
        include 'component/navbar-user.php';
    ?>
    <!-- end navbar -->

    <!-- JUMBOTRON 2 -->
    <section class="jumbotron-2 mt-5 pt-5">
        <div class="container">
            <div class="row">
                <p>
                    <a href="/">HOME</a> >
                    FEEDBACK
                </p>
            </div>
        </div>
    </section>
    <!-- END JUMBOTRON 2 -->

    <!-- FEEDBACK -->
    <section class="feedback">
        <div class="container">
            <div class="row">
                <h1>KRITIK DAN SARAN</h1>
            </div>
            <div class="row">
                <form method="post">
                    <div class="mb-3">
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="message" rows="3" required></textarea>
                        <button type="submit" name="send_feedback" class="btn btn-lg btn-primary mt-3">SEND</button>
                    </div>
                </form>
            </div>
            <div class="row pt-3">
                <h3 id="feedback_result"></h3>
            </div>
        </div>
    </section>
    <!-- END FEEDBACK -->

    <script src="../aset/js/jquery-3.5.1.js"></script>
    <script src="../aset/js/bootstrap.js"></script>
    <script src="../aset/js/script.js"></script>
</body>

</html>