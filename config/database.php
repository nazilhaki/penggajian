<?php

// konfigurasi database
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_base = 'apppenggajian';

// koneksi database
$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_base);

// Check connection
if (!$connection) {
    die('Tidak terhubung ke MySQL: ' . mysqli_connect_error());
}

?>
