<?php
date_default_timezone_set('Asia/Jakarta'); // Atur zona waktu ke GMT+07:00 (Waktu Indonesia Barat)

if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST["send_feedback"])) {
    include 'backend/connect/conn.php';
    if (isset($_POST['message'])) {
        $message = $_POST['message'];

        $date_time = date('Y-m-d H:i:s'); 
        $ip_address = $_SERVER['REMOTE_ADDR'];

        // Persiapkan dan jalankan prepared statement untuk menyimpan data
        $stmt = $conn->prepare("INSERT INTO feedback (ip_address, message, date_time) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $ip_address, $message, $date_time);

        if ($stmt->execute()) {
            ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // JavaScript script here
                    document.getElementById('feedback_result').innerHTML = 'Pesan Terkirim, Terimakasih Atas Masukannya';
                });
            </script>
            <?php 
        } else {
            ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // JavaScript script here
                    document.getElementById('feedback_result').innerHTML = 'Gagal mengirim pesan. Silakan coba lagi';
                });
            </script>
            <?php 
        }

        // Tutup prepared statement
        $stmt->close();
    } else {
        ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // JavaScript script here
                    document.getElementById('feedback_result').innerHTML = 'Data tidak lengkap';
                });
            </script>
            <?php 
    }
}


?>