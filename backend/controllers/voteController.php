<?php
include('../backend/connect/conn.php');
include('../backend/controllers/query.php');

// function signupController($identity_number) {
//     print_r($identity_number);
//     // add registran data to data_registrasi_pemilih table
//     // mysqli_query($GLOBALS['conn'], 
//     //                 "INSERT INTO data_registrasi_pemilih (id, identity_number) 
//     //                     VALUES ('','$identity_number')");
//     // echo "<script>alert('No Indentitas berhasil didaftarkan. Silakan check aktivasi akun.')</script>";
//     // echo "<script>window.location.href = './account-checker'</script>";
// }

function signinController($identity_number, $voter_token)
{
    // Gunakan prepared statement untuk mencegah SQL injection

    include('../backend/connect/conn.php');
    $stmt = $conn->prepare("SELECT * FROM data_induk_pemilih WHERE identity_number = ? AND voter_token = ?");
    $stmt->bind_param("ss", $identity_number, $voter_token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $voter_data = $result->fetch_assoc();

        if ($voter_data['is_voted'] != 1) {
            // Set session
            $_SESSION['user'] = $identity_number;
            echo "<script>alert('Berhasil masuk.')</script>";
            echo "<script>window.location.href = 'vote'</script>";
        } else {
?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // JavaScript script here
                    document.getElementById('signin-result').innerHTML = 'Akun sudah melakukan pemungutan suara';
                });
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // JavaScript script here
                document.getElementById('signin-result').innerHTML = 'Username atau Token salah';
            });
        </script>
<?php
    }

    // Tutup prepared statement
    $stmt->close();
}


$result = [];
$identity_number = '-';
$name = '-';
function accountChecker($identity_number)
{
    $voter_data_to_check = $identity_number;
    $search_in_registration_data = query("SELECT * FROM data_registrasi_pemilih WHERE identity_number = '$voter_data_to_check'");
    if (count($search_in_registration_data) > 0) {
        $voter_data = query("SELECT * FROM data_induk_pemilih WHERE identity_number = '$voter_data_to_check'");
        if (count($voter_data) > 0) {
            $identity_number = $voter_data[0]['identity_number'];
            $name = $voter_data[0]['name'];
            $result = [$identity_number, $name];
            return $result;
        }
        // else {
        //     $result = [$identity_number, $GLOBALS['name'], $GLOBALS['grade']];
        //     return $result;
        // }
    } else {
        $identity_number = $voter_data_to_check;
        $name = '-';
        $result = [$identity_number, $name];
        return $result;
    }
}

// function takeVoteController($voter_token, $candidate_selected) {
//     $search_voter_data = query("SELECT * FROM data_induk_pemilih WHERE voter_token = '$voter_token'");
//     if(count($search_voter_data) > 0) {
//         $voter_data = $search_voter_data[0];
//         if($voter_data['is_voted'] != '1') {
//             $voter_id = $voter_data['id_voter'];
//             // set selection candidate
//             mysqli_query($GLOBALS['conn'], "INSERT INTO votes (id_vote, candidate_selected) VALUES ('1', '$candidate_selected')");
//             // set the column is voted's value is 1
//             mysqli_query($GLOBALS['conn'], "UPDATE data_induk_pemilih SET is_voted = '1' WHERE id_voter = '$voter_id'");
//             // alert thanks to the vote
//             echo "<script>alert('Terimakasih telah melakukan pemungutan suara. Satu suara Anda sangat berarti.')</script>";
//             // redirect to sign in page
//             echo "<script>window.location.href = './signin'</script>";
//         }
//         else {
//             echo '<script>alert("Anda sudah mengambil suara.")</script>';
//         }

//     }
// }

function isVoted($voter_token)
{
    $search_voter_data = query("SELECT * FROM data_induk_pemilih WHERE voter_token = '$voter_token'");
    // print_r($search_voter_data[0]);
    if ($search_voter_data[0]['is_voted'] == '1') {
        echo "<script>alert('Anda sudah melakukan pemungutan suara!')</script>";
        echo "<script>window.location.href = 'sign-out'</script>";
    } else {
    }
}
