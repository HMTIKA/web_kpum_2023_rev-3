<?php
session_start();
include('../../backend/connect/conn.php');
$keyComponent = "kpum";

// username = Admin_KPUM_STB
// password = 2qg853Ta

if (!$_SESSION['auth_one']) {
    header("Location: /");
}

if (isset($_SESSION["admin"])) {
    // Redirect ke halaman lain jika sudah login
    header("Location: ../dashboard"); // Ganti dengan halaman tujuan setelah login
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query untuk memeriksa kredensial pengguna
    if (empty($username) || empty($password)) {
        header("Location: /"); // Redirect ke halaman lain atau tampilkan pesan kesalahan sesuai kebijakan Anda
    } else {
        // Perhatikan bahwa tidak ada tanda kutip pada nama tabel 'admin' dan tambahkan kolom yang ingin Anda pilih
        $query = "SELECT * FROM admin WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        if ($stmt->error) {
            die("Query execution error: " . $stmt->error);
        }
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            // Verifikasi password dengan password_verify
            if (password_verify($password, $row["password"])) {
                $_SESSION['admin'] = $username;
                header("Location: /admin");
            } else {
?>
                <script>
                    alert("Password salah");
                </script>
            <?php
                header("Location: /");
            }
        } else {
            ?>
            <script>
                alert("Username salah");
            </script>
<?php
            header("Location: /");
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN LOGIN V2</title>
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
                        <h1>ADMIN LOGIN V2</h1>
                    </div>
                    <div class="row">
                        <div class="container">
                            <form method="post">
                                <p>USERNAME</p>
                                <input type="text" id="username" name="username" placeholder="USERNAME" required>
                                <p>PASSWORD</p>
                                <input type="password" id="password" name="password" placeholder="PASSWORD" required>
                                <button type="submit" name="submit" class="btn btn-lg btn-primary w-50 mt-3 text-light">LOGIN</button>
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