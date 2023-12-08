<?php

include '../backend/connect/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $identity_number = $_POST["identity_number"];

    // Buat prepared statement untuk memeriksa apakah data sudah ada di tabel sign_up
    $check_sign_up_stmt = $conn->prepare("SELECT COUNT(*) FROM data_registrasi_pemilih WHERE identity_number = ?");
    $check_sign_up_stmt->bind_param("s", $identity_number);
    $check_sign_up_stmt->execute();
    $check_sign_up_stmt->bind_result($count_sign_up);
    $check_sign_up_stmt->fetch();
    $check_sign_up_stmt->close();

    // Buat prepared statement untuk memeriksa apakah data ada di tabel voters
    $check_voters_stmt = $conn->prepare("SELECT COUNT(*) FROM data_induk_pemilih WHERE identity_number = ?");
    $check_voters_stmt->bind_param("s", $identity_number);
    $check_voters_stmt->execute();
    $check_voters_stmt->bind_result($count_voters);
    $check_voters_stmt->fetch();
    $check_voters_stmt->close();
    
    echo "<h2 class='mt-3'>OUTPUT : </h2>";
    // Verifikasi sesuai kondisi yang diberikan
    if ($count_sign_up > 0 && $count_voters > 0) {
        // Data sudah terdaftar di kedua tabel
        echo "<h3 class='mt-2'>SUDAH TERDAFTAR</h3>";
        echo "<a href='account-checker' class='btn btn-lg btn-warning w-75 ms-3'>Cek Disini</a>";
    } elseif ($count_sign_up == 0 && $count_voters > 0) {
        // Data tidak terdaftar di tabel sign_up, tetapi terdaftar di tabel voters
        $insert_stmt = $conn->prepare("INSERT INTO data_registrasi_pemilih (identity_number) VALUES (?)");
        $insert_stmt->bind_param("s", $identity_number);

        // Eksekusi prepared statement
        if ($insert_stmt->execute()) {
            echo "<h3 class='mt-2'>SIGN-UP BERHASIL!</h3>";
            echo "<a href='account-checker' class='btn btn-lg btn-success w-75 ms-3'>Cek Disini</a>";
        } else {}

        // Tutup prepared statement penambahan data baru
        $insert_stmt->close();
    } else {
        // Data tidak terdaftar di kedua tabel
        echo "<h3 class='mt-2'>Nomor Identitas Tidak terdaftar Di Data Induk, Hubungi Petugas Untuk info Lebih lanjut</h3>";
    }

    // Tutup koneksi database
    $conn->close();
}
?>
