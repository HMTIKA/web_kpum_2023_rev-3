<?php
session_start();

// Pemeriksaan apakah pengguna sudah login
if (!isset($_SESSION["user"])) {
    // Redirect ke halaman login jika belum login
    header("Location: sign-in");
    exit();
}

include('../backend/connect/conn.php');
include('../backend/controllers/voting.php');

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
$keyComponent = "kpum";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOTING</title>
    <link rel="stylesheet" href="../aset/css/bootstrap.css">
    <link rel="stylesheet" href="../aset/css/style.css">
</head>

<body>

    <!-- CANDIDATES -->
    <section class="vote pt-3">
        <div class="container">
            <div class="row">
                <h1 class="mb-2 text-center">SURAT SUARA</h1>
                <h2 class="mb-2 text-center">PEMILIHAN PRESIDEN DAN WAKIL PRESIDEN MAHASISWA</h2>
                <h2 class="mb-5 text-center">STIMIK TUNAS BANGSA BANJARNEGARA 2023</h2>
            </div>
            <div class="row">
                <?php $i = 1 ?>
                <?php foreach ($data_kandidat as $kandidat) { ?>
                    <div class="col-lg-4">
                        <form method="post" onsubmit="return confirmVerification()">
                            <div class="card p-3 mb-3">
                                <h2 class="card-title">KANDIDAT NOMOR <?= $i ?></h2>
                                <img src="<?= htmlspecialchars($kandidat['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="" class="card-image mb-2 w-100">
                                <p><?= $kandidat['nama_capresma'] ?> dan <?= htmlspecialchars($kandidat['nama_cawapresma'], ENT_QUOTES, 'UTF-8'); ?></p>
                                <input type="hidden" name="nomor_kandidat" value="<?= $i ?>">
                                <button class="btn btn-md btn-danger w-100 mb-2" id="coblos" name="coblos">COBLOS</button>
                                <!-- <div class="confirm">
                                <p>APAKAH SUDAH YAKIN ?</p>
                                <button class="btn btn-lg btn-danger" id="no">TIDAK</button>
                                <button type="submit" class="btn btn-lg btn-success" id="yes">YA</button>
                            </div> -->
                            </div>
                        </form>
                    </div>
                    <?php $i = $i + 1; ?>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- Candidate -->

    <script src="../aset/js/jquery-3.5.1.js"></script>
    <script src="../aset/js/bootstrap.js"></script>
    <script src="../aset/js/sweetalert.min.js"></script>
    <script src="../aset/js/script.js"></script>

    <script>
function confirmVerification() {;

            const confirmation = confirm('Apakah Anda yakin ingin memilih kandidat ini?');
            if (!confirmation) {
              return false; // Prevent form submission
            }

            // return true; // Allow form submission
        }
    </script>

</body>

</html>