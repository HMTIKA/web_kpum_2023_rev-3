<?php

session_start();
include '../backend/connect/conn.php';

// Pemeriksaan apakah pengguna sudah login
if (isset($_SESSION["username"])) {
    // Redirect ke halaman lain jika sudah login
    header("Location: vote"); // Ganti dengan halaman tujuan setelah login
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $identity_number = $_POST["identity_number"];

    // Buat prepared statement untuk memeriksa apakah data sudah ada di tabel sign_up
    $check_sign_up_stmt = $conn->prepare("SELECT * FROM data_registrasi_pemilih WHERE identity_number = ?");
    $check_sign_up_stmt->bind_param("s", $identity_number);
    $check_sign_up_stmt->execute();
    $result_sign_up = $check_sign_up_stmt->get_result();
    $check_sign_up_stmt->close();

    // Buat prepared statement untuk memeriksa apakah data ada di tabel voters
    $check_voters_stmt = $conn->prepare("SELECT * FROM data_induk_pemilih WHERE identity_number = ?");
    $check_voters_stmt->bind_param("s", $identity_number);
    $check_voters_stmt->execute();
    $result_voters = $check_voters_stmt->get_result();
    $check_voters_stmt->close();

    echo "<h2 class='mt-3'>OUTPUT : </h2>";

    // Jika data terdaftar di tabel voters
    if ($result_voters->num_rows > 0) {

        // Jika data juga terdaftar di sign up
        if ($result_sign_up->num_rows > 0) {
            $row_voters = $result_voters->fetch_assoc();
            echo "<h3 class='mt-2'>SUDAH TERDAFTAR</h3>";

            // Tampilkan data dari tabel voters
            echo "<table class='table table-striped table-hover table-bordered mt-3'>
                    <thead>
                        <tr>
                            <th scope='col'>NAMA</th>
                            <th scope='col'>NOMOR IDENTITAS</th>
                            <th scope='col'>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{$row_voters['name']}</td>
                            <td>{$row_voters['identity_number']}</td>
                            <td>";

            // Tampilkan status (sudah memilih atau belum memilih)
            if ($row_voters['is_voted'] == 1) {
                echo "<p class='text-success'>Sudah Memilih</p>";
            } else {
                echo "<p class='text-danger'>Belum Memilih</p>";
            }

            echo "</td></tr></tbody></table>";
        } else {
            // Data tidak terdaftar di tabel sign up
            echo "<h3 class='mt-2'>BELUM TERDAFTAR</h3>";
            echo "<a href='sign-up' class='btn btn-md btn-primary mt-1 w-75 ms-3'>DAFTAR DISINI</a>";
        }
    } else {
        // Data tidak terdaftar di tabel voters dan sign_up
        echo "<h3 class='mt-2'>Nomor Identitas Tidak terdaftar Di Data Induk, Hubungi Petugas Untuk info Lebih lanjut</h3>";
    }

    // Tutup koneksi database
    $conn->close();
}
