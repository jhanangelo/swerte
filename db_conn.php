<?php
$host = "localhost";
$user = "root";       // your DB username
$pass = "";           // your DB password
$db = "suerte_motoplaza"; // your DB name

$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
