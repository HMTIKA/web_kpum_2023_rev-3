<?php
// print_r($_POST);
    // search in data_induk where identity_number = identity_number value in sign up form
    $search_voter_data = query("SELECT * FROM data_registrasi_pemilih WHERE identity_number = '$identity_number'");
    // print_r($search_voter_data);
    if(count($search_voter_data) > 0) {
        $voter_data = $search_voter_data[0];
        $voter_no_id = $voter_data['identity_number'];
        // search voter identity_number in data induk
        $filter_data_induk = query("SELECT * FROM data_induk_pemilih WHERE identity_number = '$voter_no_id'");
        // print_r($filter_data_induk);
        if(count($filter_data_induk) > 0) {
            if($filter_data_induk[0]['activation_status'] == '1') {
                echo "<script>alert('No Identitas Anda sudah terdaftar sebagai pemilih.')</script>";
                echo "<script>alert('Kunjungi halaman Account Checker untuk cek aktivasi akun.')</script>";
            }
            else {
                print_r($filter_data_induk[0]['activation_status']);
                // activation account and account is registered
                mysqli_query($GLOBALS['conn'], "UPDATE data_induk_pemilih SET activation_status = '1' WHERE identity_number = '$voter_no_id'");
                echo `<script>alert('NIM Anda berhasil terdaftar sebagai calon pemilih.\nKunjungi halaman Account Checker untuk cek aktivasi akun.')</script>`;
            }
        }
        
    }
    else {
        // search voter identity_number in data induk
        $filter_data_induk = query("SELECT * FROM data_induk_pemilih WHERE identity_number = '$identity_number'");
        if(count($filter_data_induk) > 0) {
            $voter_no_id = $filter_data_induk[0]['identity_number'];
            print_r($voter_no_id);
            // tambah data registran pemilih
            mysqli_query($GLOBALS['conn'], 
                        "INSERT INTO data_registrasi_pemilih (id, identity_number) 
                            VALUES ('', '1')");
            // // activation account and account is registered
            // mysqli_query($GLOBALS['conn'], 
            //             "UPDATE data_induk_pemilih 
            //             SET activation_status = '1' 
            //             WHERE identity_number = '$identity_number'");

            // echo "<script>alert('No Identitas Anda berhasil terdaftar sebagai pemilih.')</script>";
            // echo "<script>alert('Kunjungi halaman Account Checker untuk cek aktivasi akun.')</script>";
        }
        else {
            echo "<script>alert('No Identitas Anda tidak terdaftar.')</script>";
        }
    }
?>