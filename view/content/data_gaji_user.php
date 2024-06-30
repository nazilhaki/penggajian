<?php 
    if ($_SESSION['level']=='user'){
 ?>
<!-- begin breadcrumb -->
            <ol class="breadcrumb pull-right">
                <li><a href="javascript:;">Home</a></li>
                <li><a href="javascript:;">Transaksi</a></li>
                <li class="active">Gaji</li>
            </ol>
            <!-- end breadcrumb -->
            <!-- begin page-header -->
            <h1 class="page-header">Data Gaji</h1>
            

      
            
            <div class="row">
                <!-- begin col-12 -->
                <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                            <h4 class="panel-title">List Data Gaji</h4>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                            <table id="data-table" class="table table-striped table-bordered">
                                
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Penggajian</th>
                                        <th>Periode Gaji</th>
                                        <th>Gaji Pokok</th>
                                        <th>Tunjangan</th>
                                        <th>Bonus</th>
                                        <th>Potongan</th>
                                        <th>Gaji Bresih</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                          include "config/config.php";
                                          $i=0;
                                          $n=$_SESSION['nip'];
                                          $sql="SELECT * FROM `view_gaji` WHERE nip=$n; ";
                                          $tampil=mysqli_query($sql);
                                          while($data=mysqli_fetch_array($tampil)){
                                          $i++;
                                         ?>
                                          <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo date("d-F-Y", strtotime($data['tanggal_penggajian'])); ?></td>
                                            <td><?php echo $data['bulan'].' / '.$data['tahun']; ?></td>
                                            <td align="right"><?php echo 'Rp. '.number_format($data['gaji_pokok']); ?></td>
                                            <td align="right"><?php echo 'Rp. '.number_format($data['tunjangan_jabatan']); ?></td>
                                            <td align="right"><?php echo 'Rp. '.number_format($data['bonus']); ?></td>
                                            <td align="right"><?php echo 'Rp. '.number_format($data['potongan']); ?></td>
                                            <td align="right"><?php echo 'Rp. '.number_format($data['gaji_bersih']); ?></td>

                                            
                                            <td>
                                                <a href='index.php?p=cetak_user&&no_penggajian=<?php echo $data['no_penggajian']; ?>'class='btn btn-primary btn-xs' title='Detail'><i class='glyphicon glyphicon-folder-open'></i></a>
                                            </td>
                                          </tr>
                                          <?php
                                          }
  ?>
                             
                                </tbody>
                            </table>
                                
                            </div>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
                       <?php 
        }else{
            ?>
            <script type="text/javascript">
                window.location.href="../../halaman_error.php";
            </script>
        <?php
        }
     ?>