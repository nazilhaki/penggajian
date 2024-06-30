<?php 
    if ($_SESSION['level']=='admin'){
 ?>
<!-- begin breadcrumb -->
            <ol class="breadcrumb pull-right">
                <li><a href="javascript:;">Home</a></li>
                <li><a href="javascript:;">Transaksi</a></li>
                <li class="active">Absensi Pegawai</li>
            </ol>
            <!-- end breadcrumb -->
            <!-- begin page-header -->
            <h1 class="page-header">Absensi Pegawai</h1>
            <!-- end page-header -->
            
            <!-- begin row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                            <h4 class="panel-title">Input Absensi</h4>
                        </div>
                        <div class="panel-body panel-form">
                          <?php 
                              include "config/config.php";
                              $sqli="SELECT * FROM t_absen INNER JOIN t_pegawai ON t_absen.nip=t_pegawai.nip where id='$_GET[id]'";
                              $tampil1=mysqli_query($sqli);
                              while($data=mysqli_fetch_array($tampil1)){
                             ?>
                            <form class="form-horizontal form-bordered" data-parsley-validate="true" name="absen" action="./model/update_absen.php" method="POST">
                                <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                    <label class="control-label col-md-4 col-sm-4" >Bulan/Tahun </label>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                               <input class="form-control" type="text" name="bulan" value="<?php echo $data['bulan'] ?>"   data-parsley-required="true" readonly/>
                                            </div>
                                            <div class="col-md-6">
                                               <input class="form-control" type="text" name="tahun" value="<?php echo $data['tahun'] ?>"   data-parsley-required="true" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >NIP</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text" name="nip" id="nip" value="<?php echo $data['nip'] ?>"  data-parsley-required="true" readonly />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Nama Pegawai</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text" name="nama_pegawai" id="nama_pegawai" value="<?php echo $data['nama_pegawai'] ?>"  data-parsley-required="true" readonly />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Hadir</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text"  data-parsley-type="number"  name="hadir" value="<?php echo $data['hadir'] ?>"    data-parsley-required="true" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Sakit</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text"  data-parsley-type="number"  name="sakit" value="<?php echo $data['sakit'] ?>"  data-parsley-required="true" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Ijin</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text" data-parsley-type="number"  name="ijin" value="<?php echo $data['ijin'] ?>"  data-parsley-required="true" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4" >Tanpa Keterangan</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text" data-parsley-type="number"  name="tanpa_keterangan" value="<?php echo $data['tanpa_keterangan'] ?>"  data-parsley-required="true" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4"></label>
                                    <div class="col-md-6 col-sm-6">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                             <?php
                  }
                  ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    
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