<?php
// Konfigurasi database
$host = "localhost";
$username = "root";
$password = "";
$database = "apotekberva";

// Membuat koneksi
$conn = mysqli_connect($host, $username, $password, $database);

// Periksa koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>