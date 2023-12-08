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
$feedback_data = query("SELECT * FROM feedback");
$count_feedback_data = count(query("SELECT * FROM feedback"));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER FEEDBACK</title>
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
                    FEEDBACK
                </p>
            </div>
        </div>
    </section>
    <!-- END JUMBOTRON 2 -->

    <!-- SHOW USER FEEDBACK -->
    <section class="show-user-feedback">
        <div class="container">
            <div class="row">
                <h1>Kritik Dan Saran </h1>
                <p>Total : <?= $count_feedback_data ?></p>
            </div>
            <div class="row">
                <?php if ($count_feedback_data > 0) { ?>
                    <?php foreach ($feedback_data as $display_feedback_data) { ?>
                        <div class="card mb-3 pt-2 pb-1">
                            <p class="text-warning"><?php echo htmlspecialchars($display_feedback_data['ip_address'], ENT_QUOTES, "UTF-8"); ?></p>
                            <pre><?php echo htmlspecialchars($display_feedback_data['message'], ENT_QUOTES, "UTF-8"); ?></pre>
                            <p class="text-end text-success"><?php echo htmlspecialchars($display_feedback_data['date_time'], ENT_QUOTES, "UTF-8"); ?></p>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <h2>TIDAK ADA DATA</h2>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- END SHOW USER FEEDBACK -->

    <script src="../aset/js/jquery-3.5.1.js"></script>
    <script src="../aset/js/bootstrap.js"></script>
    <script src="../aset/js/script.js"></script>
</body>

</html>