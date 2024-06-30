<?php
include __DIR__ . '/../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nip = $_POST['nip'];
    $nama_pegawai = $_POST['nama_pegawai'];
    $tgl_lhr = $_POST['tgl_lhr'];
    $alamat = $_POST['alamat'];
    $tlp = $_POST['tlp'];
    $id_jabatan = $_POST['id_jabatan'];

    // Query SQL untuk menyimpan data pegawai
    $query = "INSERT INTO t_pegawai (nip, nama_pegawai, tgl_lhr, alamat, tlp, id_jabatan) 
              VALUES ('$nip', '$nama_pegawai', '$tgl_lhr', '$alamat', '$tlp', '$id_jabatan')";

    // Eksekusi query dengan menggunakan koneksi database
    $result = mysqli_query($connection, $query);

    // Periksa apakah query berhasil dieksekusi
    if ($result) {
        // Redirect ke halaman data pegawai setelah berhasil disimpan
        header("Location: ../index.php?p=data_pegawai");
        exit();
    } else {
        // Jika query gagal dieksekusi, tampilkan pesan error
        die("Gagal Menyimpan: " . mysqli_error($connection));
    }
}
?>
