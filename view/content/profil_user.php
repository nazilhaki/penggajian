<?php 
    if ($_SESSION['level']=='user'){
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
            <?php
                include "config/config.php";
                $sql="select * from view_pengguna where username='$_GET[username]'";
                $tampil=mysqli_query($sql);
                $data=mysqli_fetch_array($tampil);
            ?>
                <form class="form-horizontal d" data-parsley-validate="true" name="demo-form" action="model/update_pengguna_user.php" method="POST" enctype="multipart/form-data">
                <br>
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
                            <input type="hidden" name="username2" value="<?php echo "$data[username]"; ?>">
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
                            <input class="form-control" type="text" id="fullname" name="nama_lengkap" placeholder="Nama Pegawai" data-parsley-required="true"value="<?php echo $data['nama_pegawai']; ?>"  readonly/>
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
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
           <?php 
        }else{
            ?>
            <script type="text/javascript">
                window.location.href="halaman_error.php";
            </script>
        <?php
        }
     ?>