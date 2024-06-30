<?php 
    if ($_SESSION['level']=='admin'){
 ?>
<!-- begin breadcrumb -->
            <ol class="breadcrumb pull-right">
                <li><a href="javascript:;">Home</a></li>
                <li><a href="javascript:;">Transaksi</a></li>
                <li class="active">Gaji</li>
            </ol>
            <!-- end breadcrumb -->
            <!-- begin page-header -->
            <h1 class="page-header">Edit Gaji</h1>
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
                            <h4 class="panel-title">Tambah Data</h4>
                        </div>
                        <div class="panel-body panel-form">

                            <form class="form-horizontal form-bordered" data-parsley-validate="true" name="data_pengguna" action="./model/update_gaji.php" method="POST">
                                <?php 
                                  include "config/config.php";
                                  $sql="select *, (gaji_pokok+tunjangan_jabatan+bonus-potongan) as gaji_bersih from t_penggajian inner join t_pegawai on t_penggajian.nip=t_pegawai.nip inner join t_jabatan on t_pegawai.id_jabatan=t_jabatan.id_jabatan where no_penggajian='$_GET[no_penggajian]'";
                                  $tampil=mysqli_query($sql);
                                  while($data=mysqli_fetch_array($tampil)){
                                 ?>
                                 <input type="hidden" name="no_penggajian" value="<?php echo $data['no_penggajian'];?>" />
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Tanggal </label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="date" name="tanggal_penggajian" id="tanggal_penggajianx" readonly value="<?php echo $data['tanggal_penggajian'];?>" data-parsley-required="true" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4">NIP</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text" name="nip" id="nipx" value="<?php echo $data['nip'];?>" readonly  data-parsley-required="true" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Nama Pegawai</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text" name="nama_pegawai" id="nama_pegawaix" readonly value="<?php echo $data['nama_pegawai'];?>"  data-parsley-required="true" />
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Jabatan</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text" name="nama_jabatan" id="nama_jabatanx" readonly value="<?php echo $data['nama_jabatan'];?>"data-parsley-required="true" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Gaji Pokok</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text" name="gaji_pokok" id="gaji_pokokx"readonly value="<?php echo $data['gaji_pokok'];?>" data-parsley-required="true" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Tunjangan Jabatan</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text" name="tunjangan_jabatan" readonly id="tunjangan_jabatanx" value="<?php echo $data['tunjangan_jabatan'];?>"  data-parsley-required="true" />
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Bonus</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="number" name="bonus" id="bonusx" value="<?php echo $data['bonus'];?>"  data-parsley-required="true" />
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Potongan</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text" name="potongan" id="potonganx" value="<?php echo $data['potongan'];?>"  data-parsley-required="true" readonly/>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Gaji Bersih</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text" name="gaji_bersih" readonly id="gaji_bersihx" value="<?php echo $data['gaji_bersih'];?>"  data-parsley-required="true" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4"></label>
                                    <div class="col-md-6 col-sm-6">
                                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
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