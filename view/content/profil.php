<?php 
    if ($_SESSION['level'] == 'admin') {
        include __DIR__ . "/../../config/config.php"; // Sesuaikan path sesuai struktur folder Anda

        // Pastikan koneksi ke database tersedia
        if (!$connection) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }

        // Ambil username dari parameter GET dengan aman
        $username = isset($_GET['username']) ? mysqli_real_escape_string($connection, $_GET['username']) : '';

        // Lakukan query menggunakan prepared statement
        $query = "SELECT * FROM view_pengguna WHERE username = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_array($result);
?>
<ol class="breadcrumb pull-right">
    <li><a href="javascript:;">Home</a></li>
    <li><a href="javascript:;">Admin</a></li>
    <li class="active">Profil</li>
</ol>
<h1 class="page-header">Profil</h1>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-inverse" data-sortable-id="form-validation-1">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Edit Profil</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal d" data-parsley-validate="true" name="demo-form" action="model/update_pengguna.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12" align="center">
                            <img src="assets/foto/<?php echo $data['imagefile']; ?>">
                            <br>
                            <b><?php echo $data['nama_pegawai']; ?></b>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4" for="fullname">Username :</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="text" id="fullname" name="username" placeholder="Username" data-parsley-required="true" value="<?php echo $data['username']; ?>" />
                            <input type="hidden" name="username2" value="<?php echo $data['username']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4">Password :</label>
                        <div class="col-md-6 col-sm-6">
                            <input type="password" name="password" id="password-indicator-default" class="form-control m-b-5" />
                            <div id="passwordStrengthDiv" class="is0 m-t-5"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4" for="fullname">Nama Lengkap :</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="text" id="fullname" name="nama_lengkap" placeholder="Nama Pegawai" data-parsley-required="true" value="<?php echo $data['nama_pegawai']; ?>"  readonly/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4">Level :</label>
                        <div class="col-md-6 col-sm-6">
                            <select class="form-control" id="select-required" name="level" data-parsley-required="true">
                                <option><?php echo $data['level']; ?> </option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4">Foto</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="file" name="imagefile"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4"></label>
                        <div class="col-md-6 col-sm-6">
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php 
    } else {
?>
<script type="text/javascript">
    window.location.href = "halaman_error.php";
</script>
<?php
    }
?>
