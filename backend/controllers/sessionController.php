<?php
function isSetSessionValidator($session) {
    if(!isset($session)) {
        session_unset();
        session_destroy();
        header('Location: sign-in');
    }
    else {
        // $current_url = $_SERVER['REQUEST_URI'];
        // header("Location: $current_url");
    }
}