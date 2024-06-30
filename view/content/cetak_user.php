<?php 
    if ($_SESSION['level']=='user'){
 ?>
<ol class="breadcrumb hidden-print pull-right">
	<li><a href="javascript:;">Transaksi</a></li>
	<li class="active">Slip</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header hidden-print">Gaji <small>Slip Gaji</small></h1>
<!-- end page-header -->

<!-- begin invoice -->
<?php 
          include "config/config.php";
          $i=0;
          $a=$_GET['no_penggajian'];
          $sql="select *, (gaji_pokok+tunjangan_jabatan+bonus-potongan) as gaji_bersih from t_penggajian inner join t_pegawai on t_penggajian.nip=t_pegawai.nip inner join t_jabatan on t_pegawai.id_jabatan=t_jabatan.id_jabatan where no_penggajian=$a";
          $tampil=mysqli_query($sql);
          while($data=mysqli_fetch_array($tampil)){
            $noslip=str_replace('-', '', $data['tanggal_penggajian']);
          $i++;
         ?>
<div class="invoice">
    <div class="invoice-company">
    <span class="pull-right hidden-print">
                    <a href="cetak_invoice.php?no_penggajian=<?php echo $data['no_penggajian']; ?>"class="btn btn-sm btn-success m-b-10"><i class="glyphicon glyphicon-eye-open m-r-5"></i> Lihat & Cetak</a>
                    </span>
        CV.Archindo Media Karya
    </div>
    <div class="invoice-header">
        <div class="invoice-from">
            <address class="m-t-5 m-b-5">
                NIP <br />
                <strong><?php echo $data['nip']; ?></strong><br />
                Nama <br />
                <strong><?php echo $data['nama_pegawai']; ?></strong><br />
                
            </address>
        </div>
        <div class="invoice-date">
            <small>No Slip</small>
            <div class="date m-t-5"><?php echo $noslip.$data['nip']; ?></div>
            <small>Gaji Periode</small>
            <div class="date m-t-5"><?php echo date("d-F-Y", strtotime($data['tanggal_penggajian'])); ?></div>
        </div>
    </div>
    <div class="invoice-content">
        <div class="table-responsive">
            <table class="table table-invoice">
                <thead>
                    <tr>
                        <th>DESKRIPSI</th>
                        <th></th>
                        <th></th>
                        <th><p align="right">TOTAL</p></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            Gaji Pokok<br />
                        </td>
                        <td></td>
                        <td></td>
                        <td align="right"><?php echo 'Rp.'.number_format($data['gaji_pokok']); ?></td>
                    </tr>
                    <tr>
                        <td>
                            Tunjangan<br />
                        </td>
                        <td></td>
                        <td></td>
                        <td align="right"><?php echo 'Rp.'.number_format($data['tunjangan_jabatan']); ?></td>
                    </tr>
                    <tr>
                        <td>
                            Bonus<br />
                        </td>
                        <td></td>
                        <td></td>
                        <td align="right"><?php echo 'Rp.'.number_format($data['bonus']); ?></td>
                    </tr>
                    <tr>
                        <td>
                            Potongan<br />
                        </td>
                        <td></td>
                        <td></td>
                        <td align="right"><?php echo 'Rp.'.number_format($data['potongan']); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="invoice-price">
            <div class="invoice-price-left">
                <div class="invoice-price-row">
                    <div class="sub-price">
                        <small>GAJI POKOK</small>
                        <?php echo 'Rp.'.number_format($data['gaji_pokok']); ?>
                    </div>
                    <div class="sub-price">
                        <i class="fa fa-plus"></i>
                    </div>
                    <div class="sub-price">
                        <small>TUNJANGAN</small>
                        <?php echo 'Rp.'.number_format($data['tunjangan_jabatan']); ?>
                    </div>
                    <div class="sub-price">
                        <i class="fa fa-plus"></i>
                    </div>
                    <div class="sub-price">
                        <small>BONUS</small>
                        <?php echo 'Rp.'.number_format($data['bonus']); ?>
                    </div>
                    <div class="sub-price">
                        <i class="fa fa-minus"></i>
                    </div>
                    <div class="sub-price">
                        <small>POTONGAN</small>
                        <?php echo 'Rp.'.number_format($data['potongan']); ?>
                    </div>
                </div>
            </div>
            <div class="invoice-price-right">
                <small>TOTAL</small> <?php echo 'Rp.'.number_format($data['gaji_bersih']); ?>
            </div>
        </div>
    </div>
     <?php
    }
    ?> 
    <div class="invoice-footer text-muted">
        <p class="text-center m-b-5">
        TERIMAKASIH
        </p>
        <p class="text-center">
            <span class="m-r-10"><i class="fa fa-globe"></i> archindomediakarya.com</span>
            <span class="m-r-10"><i class="fa fa-phone"></i> T:016-18192302</span>
            <span class="m-r-10"><i class="fa fa-envelope"></i> archindomediakarya@gmail.com</span>
        </p>
    </div>
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