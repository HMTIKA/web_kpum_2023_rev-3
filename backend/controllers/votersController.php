<?php

function updateVoter($conn, $new_name, $new_token, $new_identity_number, $old_identity_number) {
    $sqlIdentityNumber = "SELECT * FROM data_induk_pemilih WHERE identity_number = ?";
    $stmtIdentityNumber = $conn->prepare($sqlIdentityNumber);
    $stmtIdentityNumber->bind_param("s", $new_identity_number);
    $stmtIdentityNumber->execute();
    $resultIdentityNumber = $stmtIdentityNumber->get_result();

    if ($resultIdentityNumber->num_rows > 0) {
        $sqlUpdate = "UPDATE data_induk_pemilih SET name = ?, voter_token = ? WHERE identity_number = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("sss", $new_name, $new_token, $old_identity_number);
        $stmtUpdate->execute();
        ?>
            <script>
                alert("Nomor Identitas Tidak Diubah");
            </script>
        <?php
    } else {
        $sqlUpdate = "UPDATE data_induk_pemilih SET name = ?, identity_number = ?, voter_token = ? WHERE identity_number = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("ssss", $new_name, $new_identity_number, $new_token, $old_identity_number);
        $stmtUpdate->execute();?>
        <script>
            alert("Data Berhasil Diubah");
        </script>
    <?php
    }
}

function setVoterIsVoted($conn, $is_voted, $old_identity_number) {
    $sqlUpdate = "UPDATE data_induk_pemilih SET is_voted = ? WHERE identity_number = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("is", $is_voted, $old_identity_number);
    $stmtUpdate->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["set_voter"])) {
        updateVoter(
            $conn,
            $_POST["new_name"],
            $_POST["new_token"],
            $_POST["new_identity_number"],
            $_POST["old_identity_number"]
        );
        header("Refresh:0");
        exit();
    } elseif (isset($_POST["set_is_voted_0"])) {
        setVoterIsVoted($conn, 0, $_POST["old_identity_number"]);
        header("Refresh:0");
        exit();
    } elseif (isset($_POST["set_is_voted_1"])) {
        setVoterIsVoted($conn, 1, $_POST["old_identity_number"]);
        header("Refresh:0");
        exit();
    }
}

?>
