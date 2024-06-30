<?php 
    if ($_SESSION['level']=='admin'){
 ?>
<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Home</a></li>
				<li><a href="javascript:;">Master</a></li>
				<li class="active">Edit Pegawai</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Pegawai</h1>
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
                            <h4 class="panel-title">Edit Pegawai</h4>
                        </div>
                        <div class="panel-body panel-form">
                   <?php 
                      include "config/config.php";
                      $sql="SELECT * FROM t_pegawai INNER JOIN t_jabatan ON t_pegawai.id_jabatan=t_jabatan.id_jabatan where nip='$_GET[nip]'";
                      $tampil=mysqli_query($sql);
                      while($data=mysqli_fetch_array($tampil)){
                     ?>
                            <form class="form-horizontal form-bordered" data-parsley-validate="true"  action="./model/update_pegawai.php" method="POST">
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" >NIP :</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" name="nip" value="<?php echo $data['nip'];?>" data-parsley-required="true" />
									</div>
								</div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4">Nama Pegawai :</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text" name="nama_pegawai" value="<?php echo $data['nama_pegawai'];?>" data-parsley-required="true" />
                                    </div>
                                </div>
                               <!--  <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4">Tanggal Lahir :</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="date" name="tgl_lhr" value="<?php echo $data['tgl_lhr'];?>" data-parsley-required="true" />
                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4">Tanggal Lahir * :</label>
                                    <div class="col-md-6 col-sm-6"> 
                                        <div class="input-group date" id="datepicker-default" data-date-format="dd-mm-yyyy">
                                            <input type="text" class="form-control" name="tgl_lhr" data-type="tgl_lhr" value="<?php echo date("m-d-Y", strtotime($data['tgl_lhr'])); ?>" data-parsley-required="true"/>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4">Alamat :</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text" name="alamat" value="<?php echo $data['alamat'];?>" data-parsley-required="true" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4">No. Telepon :</label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="text" name="tlp" value="<?php echo $data['tlp'];?>" data-parsley-required="true" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4">Jabatan :</label>
                                    <div class="col-md-6 col-sm-6">
                                          <select name="id_jabatan" data-live-search="true" data-style="btn-white" class="form-control selectpicker" >
                                             <option value="<?php echo $data['id_jabatan']; ?>"><?php echo $data['nama_jabatan']; ?></option>
                                             <?php
                                             $sql = mysqli_query("SELECT * FROM t_jabatan ORDER BY nama_jabatan ASC");
                                             if(mysqli_num_rows($sql) != 0){
                                                 while($data = mysqli_fetch_assoc($sql)){
                                                     echo '<option value='.$data['id_jabatan'].'>'.$data['nama_jabatan'].'</option>';
                                                 }
                                             }
                                             ?>
                                         </select>
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