<?php
include 'backend/user/user_access.php';
include 'backend/connect/conn.php';
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
    <meta http-equiv="refresh" content="10">
    <title>LIVE VOTE</title>
    <link rel="stylesheet" href="aset/css/bootstrap.css">
    <link rel="stylesheet" href="aset/css/style.css">
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
                    <a href="index">HOME</a> >
                    LIVE VOTE
                </p>
            </div>
        </div>
    </section>
    <!-- END JUMBOTRON 2 -->

    <!-- Live Vote -->
    <section class="live-vote">
        <div class="container">
            <div class="row">
                <h1 class="mb-3">LIVE VOTE</h1>
            </div>
            <div class="row mb-3">
                <?php $i = 1 ?>
                <?php foreach ($data_kandidat as $kandidat) { ?>
                    <div class="col-lg-4">
                        <div class="card p-3 mb-4">
                            <h2 class="card-title">KANDIDAT NOMOR <?= $i ?></h2>
                            <img src="<?= htmlspecialchars($kandidat['image'], ENT_QUOTES, 'UTF-8') ?>" alt="" class="card-image mb-2 w-100">
                            <p class="mb-2 card-text">
                                <?= htmlspecialchars($kandidat['nama_capresma'], ENT_QUOTES, 'UTF-8') ?>
                                dan
                                <?= htmlspecialchars($kandidat['nama_cawapresma'], ENT_QUOTES, 'UTF-8') ?>
                            </p>
                            <?php if (count(query("SELECT * FROM votes")) > 0) { ?>
                                <p>
                                    Jumlah Suara :
                                    <?php
                                            $total_suara_masuk = count(query("SELECT * FROM votes"));
                                            $suara_paslon = count(query("SELECT * FROM votes WHERE candidate_selected = '$i'"));
                                            echo $suara_paslon;
                                            echo " (" . $suara_paslon / $total_suara_masuk * 100 . "%)";
                                        
                                        ?>
                                </p>
                                <div class="bars">
                                    <div class="bars-width" style="width:<?php echo $suara_paslon / $total_suara_masuk * 100 ?>% "></div>
                                </div> 
                            <?php } else {?>
                                <p>Jumlah Suara : 0 ( 0% )</p>
                                <div class="bars">
                                    <div class="bars-width text-center" style="width:100%; background:transparent;">Belum Ada Suara Masuk</div>
                                </div> 
                            <?php } ?>
                        </div>
                    </div>
                    <?php $i = $i + 1 ?>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- End Live Vote -->

    <script src="aset/js/jquery-3.5.1.js"></script>
    <script src="aset/js/bootstrap.js"></script>
    <script src="aset/js/script.js"></script>
</body>

</html>