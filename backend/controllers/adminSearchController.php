<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Dapatkan istilah pencarian dari formulir
    $searchTerm = mysqli_real_escape_string($conn, $_GET["search"]);

    // Kueri SQL untuk mencari data berdasarkan nama
    $sqlName = "SELECT * FROM data_induk_pemilih WHERE TRIM(name) LIKE ?";
    $stmtName = $conn->prepare($sqlName);
    $stmtName->bind_param("s", $searchTerm);
    $stmtName->execute();
    $resultName = $stmtName->get_result();

    if ($resultName->num_rows > 0) {
        // Output data dari setiap baris
?>
        <table class="table table-striped table-hover table-bordered mt-3">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">NAMA</th>
                    <th scope="col">NOMOR IDENTITAS</th>
                    <th scope="col">STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php while ($voter = $resultName->fetch_assoc()) { ?>
                    <tr>
                        <form method="post">
                            <th scope="row">
                                <?= $i ?>
                            </th>
                            <td>
                                <input type="text" name="new_name" value="<?= htmlspecialchars($voter['name']); ?>">
                            </td>
                            <td>
                                <input type="hidden" name="old_identity_number" value="<?= $voter['identity_number']; ?>">
                                <input type="text" name="new_identity_number" value="<?= htmlspecialchars($voter['identity_number']); ?>">
                            </td>
                            <td>
                                <input type="text" name="new_token" value="<?= htmlspecialchars($voter['voter_token']); ?>">
                            </td>
                            <td>
                                <?php
                                $isvoted = $voter['is_voted'];
                                if ($isvoted == 1) {
                                ?>
                                    <p class="text-success">Sudah Memilih</p>
                                    <button type="submit" name="set_is_voted_0" class="btn btn-sm btn-warning w-100 mb-2 text-dark">
                                        Jadikan Belum memilih
                                    </button>
                                <?php
                                } else {
                                ?>
                                    <p class="text-danger">Belum Memilih</p>
                                    <button type="submit" name="set_is_voted_1" class="btn btn-sm btn-warning w-100 mb-2 text-dark">
                                        Jadikan Sudah memilih
                                    </button>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <button type="submit" name="set_voter" class="btn btn-md btn-warning w-100 mb-2">
                                    Update
                                </button>
                                <button class="btn btn-md btn-danger w-100 mb-2">
                                    Delete
                                </button>
                            </td>
                        </form>
                    </tr>
                    <?php $i = $i + 1 ?>
                <?php } ?>
            </tbody>
        </table>
        <?php
    } else {
        // Kueri SQL untuk mencari data berdasarkan nomor identitas
        $sqlIdentityNumber = "SELECT * FROM data_induk_pemilih WHERE identity_number = ?";
        $stmtIdentityNumber = $conn->prepare($sqlIdentityNumber);
        $stmtIdentityNumber->bind_param("s", $searchTerm);
        $stmtIdentityNumber->execute();
        $resultIdentityNumber = $stmtIdentityNumber->get_result();

        if ($resultIdentityNumber->num_rows > 0) {
        ?>
            <table class="table table-striped table-hover table-bordered mt-3">
                <thead>
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">NAMA</th>
                        <th scope="col">NOMOR IDENTITAS</th>
                        <th scope="col">TOKEN</th>
                        <th scope="col">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php while ($voter = $resultIdentityNumber->fetch_assoc()) { ?>
                        <tr>
                            <form method="post">
                                <th scope="row">
                                    <?= $i ?>
                                </th>
                                <td>
                                    <input type="text" name="new_name" value="<?= htmlspecialchars($voter['name']); ?>">
                                </td>
                                <td>
                                    <input type="hidden" name="old_identity_number" value="<?= $voter['identity_number']; ?>">
                                    <input type="text" name="new_identity_number" value="<?= htmlspecialchars($voter['identity_number']); ?>">
                                </td>
                                <td>
                                    <input type="text" name="new_token" value="<?= htmlspecialchars($voter['voter_token']); ?>">
                                </td>
                                <td>
                                    <?php
                                    $isvoted = $voter['is_voted'];
                                    if ($isvoted == 1) {
                                    ?>
                                        <p class="text-success">Sudah Memilih</p>
                                        <button type="submit" name="set_is_voted_0" class="btn btn-sm btn-danger w-100 mb-2 text-light">
                                            Jadikan Belum memilih
                                        </button>
                                    <?php
                                    } else {
                                    ?>
                                        <p class="text-danger">Belum Memilih</p>
                                        <button type="submit" name="set_is_voted_1" class="btn btn-sm btn-success w-100 mb-2 text-light">
                                            Jadikan Sudah memilih
                                        </button>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <button type="submit" name="set_voter" class="btn btn-md btn-warning w-100 mb-2">
                                        Update
                                    </button>
                                    <button class="btn btn-md btn-danger w-100 mb-2">
                                        Delete
                                    </button>
                                </td>
                            </form>
                        </tr>
                        <?php $i = $i + 1 ?>
                    <?php } ?>
                </tbody>
            </table>
        <?php
        } else {
        ?>
            <h2 class="mt-3">Tidak Ditemukan</h2>
<?php
        }
    }
}
?>