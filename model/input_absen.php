<?php
include "../config/config.php";

// Pastikan semua data POST telah di-set dan tidak kosong
if (isset($_POST['nip'], $_POST['bulan'], $_POST['tahun'], $_POST['hadir'], $_POST['sakit'], $_POST['ijin'], $_POST['tanpa_keterangan'])) {
    
    // Lindungi input dari SQL Injection dengan mysqli_real_escape_string
    $nip = mysqli_real_escape_string($connection, $_POST['nip']);
    $bulan = mysqli_real_escape_string($connection, $_POST['bulan']);
    $tahun = mysqli_real_escape_string($connection, $_POST['tahun']);
    $hadir = mysqli_real_escape_string($connection, $_POST['hadir']);
    $sakit = mysqli_real_escape_string($connection, $_POST['sakit']);
    $ijin = mysqli_real_escape_string($connection, $_POST['ijin']);
    $tanpa_keterangan = mysqli_real_escape_string($connection, $_POST['tanpa_keterangan']);

    // Query untuk memeriksa apakah data absen sudah ada
    $query_check = "SELECT * FROM t_absen WHERE nip = '$nip' AND bulan = '$bulan' AND tahun = '$tahun'";
    $result_check = mysqli_query($connection, $query_check);

    // Periksa jumlah baris hasil query
    if (mysqli_num_rows($result_check) > 0) {
        ?>
        <script type="text/javascript">
        alert('Absensi pada bulan ini telah dilakukan!');
        window.location.href = "../index.php?p=absen";
        </script>
        <?php
    } else {
        // Query untuk insert data absen
        $query_insert = "INSERT INTO t_absen (tanggal, bulan, tahun, nip, hadir, sakit, ijin, tanpa_keterangan) 
                         VALUES (CURDATE(), '$bulan', '$tahun', '$nip', '$hadir', '$sakit', '$ijin', '$tanpa_keterangan')";
        
        // Eksekusi query
        if (mysqli_query($connection, $query_insert)) {
            header("location:../index.php?p=absen");
            exit;
        } else {
            die("Gagal menyimpan data: " . mysqli_error($connection));
        }
    }

} else {
    // Jika ada data POST yang tidak lengkap
    echo "Data tidak lengkap.";
}

// Tutup koneksi
mysqli_close($connection);
?>
