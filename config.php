<?php

// koneksi ke database
$server = "localhost";
$user = "root";
$pass = "";
$database = "vigenere";

$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
    die("<script>alert('Connection Failed.')</script>");
}
