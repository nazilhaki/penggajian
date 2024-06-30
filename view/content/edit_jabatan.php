<?php 
    if ($_SESSION['level']=='admin'){
 ?>
<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Home</a></li>
				<li><a href="javascript:;">Master</a></li>
				<li class="active">Edit Jabatan</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Jabatan</h1>
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
                            <h4 class="panel-title">Edit Jabatan</h4>
                        </div>
                        <div class="panel-body panel-form">
                   <?php 
                      include "config/config.php";
                      $sql="select * from t_jabatan where id_jabatan='$_GET[id_jabatan]'";
                      $tampil=mysqli_query($sql);
                      while($data=mysqli_fetch_array($tampil)){
                     ?>
                            <form class="form-horizontal form-bordered" data-parsley-validate="true"  action="./model/update_jabatan.php" method="POST">
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" >Nama Jabatan :</label>
									<div class="col-md-6 col-sm-6">
                                        <input type="hidden" name="id_jabatan" value="<?php echo $data['id_jabatan'];?>">
										<input class="form-control" type="text" name="nama_jabatan" value="<?php echo $data['nama_jabatan'];?>" data-parsley-required="true" />
									</div>
								</div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4">Gaji Pokok :</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="number" name="gapok" value="<?php echo $data['gapok'];?>" data-parsley-required="true" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4">Tunjangan :</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="number" name="tunjangan" value="<?php echo $data['tunjangan'];?>" data-parsley-required="true" />
                                    </div>
                                </div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4"></label>
									<div class="col-md-6 col-sm-6">
										<button type="submit" class="btn btn-primary btn-sm">Update</button> 
									</div>
								</div>
                            </form>
                      <?php
                  }
                  ?>
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