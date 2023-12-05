<?php
require('../backend/connect/conn.php');
function query($query) {
    $result = mysqli_query($GLOBALS['conn'], $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}