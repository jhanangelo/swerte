<?php
session_start();
if (!isset($_SESSION['position']) || $_SESSION['position'] != 'stock') {
    header("Location: unauthorized.php"); // Or redirect to login
    exit();
}
?>
