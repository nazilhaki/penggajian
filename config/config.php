<?php
// konfigurasi database
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_base = 'apppenggajian';

// koneksi database
$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_base);

// Periksa koneksi
if (mysqli_connect_errno()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
