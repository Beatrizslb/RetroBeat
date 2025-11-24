<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php?erro=2");
    exit;
}
?>
