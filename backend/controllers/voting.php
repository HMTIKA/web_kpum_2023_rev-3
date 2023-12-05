<?php

// Periksa apakah formulir sudah dikirim
if (isset($_POST['coblos'])) {
    // Sanitasi nilai yang diterima dari formulir
    $nomor_kandidat = $_POST['nomor_kandidat'];

    // Mulai transaksi
    $conn->begin_transaction();

    try {
        // Masukkan ke tabel votes
        $votes_insert_stmt = $conn->prepare("INSERT INTO votes (candidate_selected) VALUES (?)");
        $votes_insert_stmt->bind_param("s", $nomor_kandidat);

        // Eksekusi pernyataan yang telah disiapkan
        if (!$votes_insert_stmt->execute()) {
            throw new Exception("Kesalahan saat mengeksekusi pernyataan masukkan suara");
        }

        // Update is_voted di tabel data_induk_pemilih
        if (isset($_SESSION['user'])) {
            $user_identity_number = $_SESSION['user']; // Asumsi 'username' adalah variabel sesi yang menyimpan nomor identitas pengguna
            $update_stmt = $conn->prepare("UPDATE data_induk_pemilih SET is_voted = 1 WHERE identity_number = ?");
            $update_stmt->bind_param("s", $user_identity_number);

            // Eksekusi pernyataan yang telah disiapkan
            if (!$update_stmt->execute()) {
                throw new Exception("Kesalahan saat mengeksekusi pernyataan pembaruan");
            }
        } else {
            throw new Exception("Sesi 'username' tidak diatur.");
        }

        // Commit transaksi
        $conn->commit();
        
        echo "<script>alert('Terimakasih telah melakukan pemungutan suara. Satu suara Anda sangat berarti.')</script>";
        echo "<script>window.location.href = 'sign-out'</script>";
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        $conn->rollback();
        echo "<script>alert('Error: " . $e->getMessage() . "')</script>";
    }
}
?>
