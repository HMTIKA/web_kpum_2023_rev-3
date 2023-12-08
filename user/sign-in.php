<?php
session_start();
include('../backend/controllers/voteController.php');
include('../backend/controllers/sessionController.php');
$keyComponent = "kpum";

// sessionValidator($_SESSION['voter_token']);
if(isset($_SESSION['user'])) {
    header('Location: vote');
}
if(isset($_POST['signin'])) {
    signinController($_POST['identity_number'], $_POST['voter_token']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN-IN</title>
    <link rel="stylesheet" href="../aset/css/bootstrap.css">
    <link rel="stylesheet" href="../aset/css/style.css">
    <link rel="shortcut icon" href="/aset/images/BEM.png" type="image/x-png">
</head>

<body>

    <!-- JUMBOTRON -->
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="card sign-in">
                    <div class="row">
                        <h1>SIGN-IN</h1>
                    </div>
                    <div class="row">
                        <div class="container">
                            <form method="post">
                                <p>NIM atau NIDK</p>
                                <input type="text" id="username" name="identity_number" placeholder="Masukan NIM atau NIDK" required>
                                <p>TOKEN</p>
                                <input type="text" id="token" name="voter_token" placeholder="Masukan Token" required>
                                <button type="submit" name="signin" class="btn btn-lg btn-primary w-50 mt-3 text-light rounded-top">LOGIN</button>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <h3 id="signin-result" class="mt-5 text-warning"></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END JUMBOTRON -->




    <script src="../aset/js/jquery-3.5.1.js"></script>
    <script src="../aset/js/bootstrap.js"></script>
    <script src="../aset/js/script.js"></script>
</body>

</html>