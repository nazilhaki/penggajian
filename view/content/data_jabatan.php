<?php 
include __DIR__ . "/../../config/config.php";

if ($_SESSION['level'] == 'admin') {
?>
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="javascript:;">Home</a></li>
    <li><a href="javascript:;">Master</a></li>
    <li class="active">Data Jabatan</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Data Jabatan</h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
    <!-- begin col-6 -->
    <div class="col-md-6">
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-validation-1">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Tambah Data Jabatan</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered" data-parsley-validate="true" name="data_pengguna" action="./model/input_jabatan.php" method="POST">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4" >Nama Jabatan :</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="text" name="nama_jabatan" placeholder="Nama Jabatan" data-parsley-required="true" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4">Gaji Pokok :</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="number" name="gapok" placeholder="Gaji Pokok" data-parsley-required="true" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4">Tunjangan :</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="number" name="tunjangan" placeholder="Tunjangan" data-parsley-required="true" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4"></label>
                        <div class="col-md-6 col-sm-6">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button> <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

<!-- begin row -->
<div class="row">
    <!-- begin col-12 -->
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">List Data Jabatan</h4>
            </div>
            <div class="panel-body">
                <table id="data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Jabatan</th>
                            <th>Gaji Pokok</th>
                            <th>Tunjangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM `t_jabatan`";
                        $result = mysqli_query($connection, $query);

                        if (!$result) {
                            die("Query tidak berhasil: " . mysqli_error($connection));
                        }

                        $i = 0;
                        while ($data = mysqli_fetch_assoc($result)) {
                            $i++;
                            $nip = $data['id_jabatan'];
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $data['nama_jabatan']; ?></td>
                                <td><?php echo 'Rp.'.number_format($data['gapok']); ?></td>
                                <td><?php echo 'Rp.'.number_format($data['tunjangan']); ?></td>
                                <td align="center">
                                    <a class="btn btn-default btn-icon btn-sm" href="index.php?p=edit_jabatan&&id_jabatan=<?php echo $data['id_jabatan']; ?>"><i class="fa fa-expand"></i></a>
                                    <a class="btn btn-danger btn-icon btn-sm" onclick="konfirmasi('<?php echo $nip;?>','<?php echo $halaman;?>','<?php echo $action;?>')"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?php 
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-12 -->
</div>
<!-- end row -->
<?php 
} else {
?>
<script type="text/javascript">
    window.location.href="halaman_error.php";
</script>
<?php
}
?>
