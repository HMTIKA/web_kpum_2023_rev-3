<?php 
include 'backend/user/user_access.php';
$keyComponent = "kpum";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOCKED ACCESS</title>
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
    <section class="jumbotron">
        <div class="container">
            <div class="row">
                <h2>BLOCKED ACCESS</h2>
                <h3>IP ADDRESS :
                    <?php
                    $ip_add = $_SERVER['REMOTE_ADDR'];
                    echo $ip_add;
                    ?>
                </h3>
                <h3>DEVICE :
                    <?php
                    function isMobile()
                    {
                        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
                    }

                    if (isMobile()) {
                        echo 'Mobile';
                    } else {
                        echo 'Desktop';
                    }
                    ?>                    
                </h3>
                <h3>WEB BROWSER :
                    <?php

                    function getBrowser()
                    {
                        $user_agent = $_SERVER['HTTP_USER_AGENT'];
                        $browser = "N/A";

                        $browsers = [
                            '/msie/i' => 'Internet explorer',
                            '/firefox/i' => 'Firefox',
                            '/safari/i' => 'Safari',
                            '/chrome/i' => 'Chrome',
                            '/edge/i' => 'Edge',
                            '/opera/i' => 'Opera',
                            '/mobile/i' => 'Mobile browser',
                        ];

                        foreach ($browsers as $regex => $value) {
                            if (preg_match($regex, $user_agent)) {
                                $browser = $value;
                            }
                        }

                        return $browser;
                    }

                    echo getBrowser();

                    ?>
                </h3>
            </div>
        </div>
    </section>
    <!-- END JUMBOTRON 2 -->


    <script src="aset/js/jquery-3.5.1.js"></script>
    <script src="aset/js/bootstrap.js"></script>
    <script src="aset/js/script.js"></script>
</body>

</html>