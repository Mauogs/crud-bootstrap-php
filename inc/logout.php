<?php
include "../config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION = [];
session_destroy();

header('Location: ' . BASEURL . 'index.php');
exit;
