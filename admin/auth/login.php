<?php

session_start();
$keyComponent = "kpum";

if (isset($_SESSION["auth_one"])) {
    // Redirect ke halaman lain jika sudah login
    header("Location: login-v2"); // Ganti dengan halaman tujuan setelah login
    exit();
}

if (isset($_POST['login'])) {

    // username : Admin
    // password : DIfacL

    include("encrypt/caesar_encrypt.php");

    $username = $_POST["username"];
    $password = $_POST["password"];

    $move_one = 10;
    $move_two = 7;
    $move_three = 21;
    $move_four = 90;

    $username_encrypt = caesar_encrypt($username, $move_one) . caesar_encrypt($username, $move_two) . caesar_encrypt($username, $move_three) . caesar_encrypt($username, $move_four);
    $password_encrypt = caesar_encrypt($password, $move_one) . caesar_encrypt($password, $move_two) . caesar_encrypt($password, $move_three) . caesar_encrypt($password, $move_four) . caesar_encrypt($password, $move_three) . caesar_encrypt($password, $move_two) . caesar_encrypt($password, $move_one);


    if ($username_encrypt == "KnwsxHktpuVyhdiMpyuz" AND $password_encrypt == "NSpkmVKPmhjSYDavxGPUrmoXYDavxGKPmhjSNSpkmV") {
        $_SESSION["auth_one"] = $username;
        header("location:login-v2");
    } else {
?>
        <script>
            alert("Username Dan Password Salah!")
        </script>
<?php
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN LOGIN</title>
    <link rel="stylesheet" href="../../aset/css/bootstrap.css">
    <link rel="stylesheet" href="../../aset/css/style.css">
</head>

<body>

    <!-- JUMBOTRON -->
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="card sign-in">
                    <div class="row">
                        <h1>ADMIN LOGIN</h1>
                    </div>
                    <div class="row">
                        <div class="container">
                            <form method="post">
                                <p>USERNAME</p>
                                <input type="text" id="username" name="username" placeholder="USERNAME" required>
                                <p>PASSWORD</p>
                                <input type="password" id="password" name="password" placeholder="PASSWORD" required>
                                <button type="submit" name="login" class="btn btn-lg btn-primary w-50 mt-3 text-light">LOGIN</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END JUMBOTRON -->

    <script src="../../aset/js/jquery-3.5.1.js"></script>
    <script src="../../aset/js/bootstrap.js"></script>
    <script src="../../aset/js/script.js"></script>
</body>

</html>