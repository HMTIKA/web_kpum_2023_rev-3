<?php
if (!$_SESSION["admin"]) {
    // Redirect ke halaman login jika belum login
    header("Location: /");
}
?>