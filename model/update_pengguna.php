<?php
// Pastikan path untuk include config.php sudah benar
include __DIR__ . "/../../config/config.php";

// Pastikan koneksi database tersedia
if (!$connection) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lakukan penanganan upload file jika file yang diupload adalah JPEG
    if ($_FILES['imagefile']['type'] == "image/jpeg") {
        $ori_src = "D:/project/project1/assets/foto/imgori/" . strtolower(str_replace(' ', '_', $_FILES['imagefile']['name']));

        if (move_uploaded_file($_FILES['imagefile']['tmp_name'], $ori_src)) {
            chmod($ori_src, 0777); // Set permissions to uploaded file

            // Tentukan path untuk thumbnail
            $thumb_src = "D:/project/project1/assets/foto/" . strtolower(str_replace(' ', '_', $_FILES['imagefile']['name']));
            $n_width = 150;
            $n_height = 150;

            // Buat thumbnail jika file adalah JPEG, PNG, atau GIF
            if ($_FILES['imagefile']['type'] == "image/jpeg" || $_FILES['imagefile']['type'] == "image/png" || $_FILES['imagefile']['type'] == "image/gif") {
                $im = @ImageCreateFromJPEG($ori_src) or
                      $im = @ImageCreateFromPNG($ori_src) or
                      $im = @ImageCreateFromGIF($ori_src) or
                      $im = false;

                $width = ImageSx($im);
                $height = ImageSy($im);

                if (($n_height == 0) && ($n_width == 0)) {
                    $n_height = $height;
                    $n_width = $width;
                }

                if (!$im) {
                    echo '<p>Gagal membuat thumbnail</p>';
                    exit;
                } else {
                    $newimage = @imagecreatetruecolor($n_width, $n_height);
                    @imageCopyResized($newimage, $im, 0, 0, 0, 0, $n_width, $n_height, $width, $height);
                    @ImageJpeg($newimage, $thumb_src);
                    chmod($thumb_src, 0777); // Set permissions to thumbnail
                }
            }
        } else {
            echo "Gagal melakukan proses upload file.";
            exit;
        }
    }

    // Siapkan variabel untuk update
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = isset($_POST['password']) && $_POST['password'] !== '' ? md5($_POST['password']) : '';
    $level = mysqli_real_escape_string($connection, $_POST['level']);
    $username2 = mysqli_real_escape_string($connection, $_POST['username2']);
    $imagefile = isset($_FILES['imagefile']['name']) ? mysqli_real_escape_string($connection, $_FILES['imagefile']['name']) : '';

    // Lakukan update berdasarkan kondisi
    if ($password == '') {
        $sql = "UPDATE tb_pengguna SET username = ?, level = ?, imagefile = ? WHERE username = ?";
    } else {
        $sql = "UPDATE tb_pengguna SET username = ?, password = ?, level = ?, imagefile = ? WHERE username = ?";
    }

    // Persiapkan statement
    $stmt = mysqli_prepare($connection, $sql);
    if ($stmt === false) {
        die("Prepare statement failed: " . mysqli_error($connection));
    }

    // Bind parameter ke statement
    if ($password == '') {
        mysqli_stmt_bind_param($stmt, "ssss", $username, $level, $imagefile, $username2);
    } else {
        mysqli_stmt_bind_param($stmt, "sssss", $username, $password, $level, $imagefile, $username2);
    }

    // Eksekusi statement
    if (mysqli_stmt_execute($stmt)) {
        header("location: ../index.php?p=data_pengguna");
        exit;
    } else {
        die("Gagal Memperbaharui: " . mysqli_error($connection));
    }
} else {
    echo "Metode request tidak diizinkan.";
}
?>
