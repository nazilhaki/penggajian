<?php
include "../config/config.php";

// Cek apakah username dan nip sudah ada
$sql = "SELECT * FROM tb_pengguna WHERE username = ? AND nip = ?";
$stmt = mysqli_prepare($connection, $sql);
mysqli_stmt_bind_param($stmt, "ss", $_POST['username'], $_POST['nip']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$cek = mysqli_num_rows($result);

if ($cek > 0) {
    ?>
    <script type="text/javascript">
        alert('NIP / username telah digunakan!');
        window.location.href="../index.php?p=data_pengguna";
    </script>
    <?php
} else {
    if ($_FILES['imagefile']['type'] == "image/jpeg") {
        $ori_src = "D:/project/project1/assets/foto/imgori/" . strtolower(str_replace(' ', '_', $_FILES['imagefile']['name']));
        if (move_uploaded_file($_FILES['imagefile']['tmp_name'], $ori_src)) {
            chmod("$ori_src", 0777);
        } else {
            echo "Gagal melakukan proses upload file.";
            exit;
        }

        $thumb_src = "D:/project/project1/assets/foto/" . strtolower(str_replace(' ', '_', $_FILES['imagefile']['name']));
        
        $n_width = 150;
        $n_height = 150;
    
        if (($_FILES['imagefile']['type'] == "image/jpeg") || ($_FILES['imagefile']['type'] == "image/png") || ($_FILES['imagefile']['type'] == "image/gif")) {
            $im = @ImageCreateFromJPEG($ori_src) or // Read JPEG Image
                  $im = @ImageCreateFromPNG($ori_src) or // or PNG Image
                  $im = @ImageCreateFromGIF($ori_src) or // or GIF Image
                  $im = false; // If image is not JPEG, PNG, or GIF
            
            $width = ImageSx($im); // Original picture width is stored
            $height = ImageSy($im); // Original picture height is stored
            if (($n_height == 0) && ($n_width == 0)) {
                $n_height = $height;
                $n_width = $width;
            }   

            if (!$im) {
                echo '<p>Gagal membuat thumnail</p>';
                exit;
            } else {
                $newimage = @imagecreatetruecolor($n_width, $n_height);                 
                @imageCopyResized($newimage, $im, 0, 0, 0, 0, $n_width, $n_height, $width, $height);
                @ImageJpeg($newimage, $thumb_src);
                chmod("$thumb_src", 0777);
            }
        }

        $sql = "INSERT INTO tb_pengguna (username, password, level, imagefile, nip) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $sql);
        $password_hashed = md5($_POST['password']);
        mysqli_stmt_bind_param($stmt, "sssss", $_POST['username'], $password_hashed, $_POST['level'], $_FILES['imagefile']['name'], $_POST['nip']);
        mysqli_stmt_execute($stmt) or die("Data sudah ada!");
        header("location:../index.php?p=data_pengguna");
    } else {
        $sql = "INSERT INTO tb_pengguna (username, password, level, imagefile, nip) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $sql);
        $password_hashed = md5($_POST['password']);
        $default_image = 'default.jpg';
        mysqli_stmt_bind_param($stmt, "sssss", $_POST['username'], $password_hashed, $_POST['level'], $default_image, $_POST['nip']);
        mysqli_stmt_execute($stmt) or die("Data sudah ada!");
        header("location:../index.php?p=data_pengguna");
    }
}
?>
