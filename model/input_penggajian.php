<?php
include "../config/config.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $bulan = mysqli_real_escape_string($connection, $_POST['bulan']);
    $tahun = mysqli_real_escape_string($connection, $_POST['tahun']);
    $nip = mysqli_real_escape_string($connection, $_POST['nip']);
    $gaji_pokok = mysqli_real_escape_string($connection, $_POST['gaji_pokok']);
    $tunjangan_jabatan = mysqli_real_escape_string($connection, $_POST['tunjangan_jabatan']);
    $bonus = mysqli_real_escape_string($connection, $_POST['bonus']);
    $potongan = mysqli_real_escape_string($connection, $_POST['potongan']);

    // Check if the salary for this employee in this month and year already exists
    $check_query = "SELECT * FROM t_penggajian WHERE nip = '$nip' AND bulan = '$bulan' AND tahun = '$tahun'";
    $check_result = mysqli_query($connection, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        ?>
        <script type="text/javascript">
            alert('Gaji pada bulan ini telah diinput!');
            window.location.href="../index.php?p=data_gaji";
        </script>
        <?php
    } else {
        // Insert salary data into database
        $insert_query = "INSERT INTO t_penggajian (tanggal_penggajian, bulan, tahun, nip, gaji_pokok, tunjangan_jabatan, bonus, potongan) 
                         VALUES (CURDATE(), '$bulan', '$tahun', '$nip', '$gaji_pokok', '$tunjangan_jabatan', '$bonus', '$potongan')";
        if (mysqli_query($connection, $insert_query)) {
            header("location:../index.php?p=data_gaji");
            exit();
        } else {
            die("Gagal menyimpan data gaji: " . mysqli_error($connection));
        }
    }
} else {
    // Handle jika form tidak disubmit dengan benar
    echo "Invalid request";
}
?>
