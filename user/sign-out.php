<?php
session_start();

// Hapus semua informasi sesi
session_unset();
session_destroy();

// Redirect ke halaman login
header("Location: sign-in");
exit();
?>
