<?php
$check_data_induk = query("SELECT * FROM data_induk_pemilih WHERE identity_number = '$identity_number'");
// jika count > 0, maka data ada
if(count($check_data_induk) > 0) {
    $result_check_data_induk = $check_data_induk[0];
    // check di data registrasi, apakah sudah terdaftar
    $check_data_registrasi = query("SELECT * FROM data_registrasi_pemilih WHERE identity_number = '$identity_number'");
    // print_r($check_data_registrasi);
    if(count($check_data_registrasi) > 0) {
        // $result_check_data_registrasi = $check_data_registrasi[0];
        echo "<script>alert('No Identitas Anda sudah terdaftar sebagai pemilih.')</script>";
        echo "<script>alert('Kunjungi halaman Account Checker untuk cek aktivasi akun.')</script>";
    }
    else {
        $voter_no_id = $check_data_induk[0]['identity_number'];
        print_r($voter_no_id);
        $sql = "INSERT INTO data_registrasi_pemilih (id, identity_number) VALUES ('', '$voter_no_id')";
        mysqli_query($GLOBALS['conn'], $sql);
    }
}
else {
    echo "<script>alert('No Identitas Anda tidak terdaftar.')</script>";
}
?>