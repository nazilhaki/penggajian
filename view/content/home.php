<?php 
	include "config/config.php";
	$tampil=mysqli_query($connection, "select * from t_pegawai");
	$jumlah_karyawan=mysqli_num_rows($tampil);

	
	$bulan = date("Y-m");
	$tampil2=mysqli_query($connection, "select * from t_penggajian WHERE LEFT(tanggal_penggajian,7) = '$bulan'");
	$jumlah_gaji=mysqli_num_rows($tampil2);

 ?>
<ol class="breadcrumb pull-right">
	<li><a href="javascript:;">Home</a></li>
	<li class="active">Dashboard</li>    
</ol>
<h1 class="page-header">Dashboard <small>APP Penggajian</small></h1>
<div class="row">
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-green">
			<div class="stats-icon"><i class="fa fa-desktop"></i></div>
			<div class="stats-info">
				<h4>PENERIMA GAJI</h4>
				<p><?php echo $jumlah_gaji; ?> <small> / <?php echo $jumlah_karyawan; ?> ORANG</small></p>	
			</div>
			<div class="stats-link">
				<a href="javascript:;"><i class="fa fa-arrow-circle-o-right"></i></a>
			</div>
		</div>
	</div>
	
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-purple">
			<div class="stats-icon"><i class="fa fa-users"></i></div>
			<div class="stats-info">
				<h4>TOTAL KARYAWAN</h4>
				<p><?php echo $jumlah_karyawan; ?> ORANG</p>	
			</div>
			<div class="stats-link">
				<a href="javascript:;"> <i class="fa fa-arrow-circle-o-right"></i></a>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-blue">
			<div class="stats-icon"><i class="fa fa-chain-broken"></i></div>
			<div class="stats-info">
				<h4>TANGGAL</h4>
				<p><span id="footer-date"></span></p>	
			</div>
			<div class="stats-link">
				<a href="javascript:;"><i class="fa fa-arrow-circle-o-right"></i></a>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-red">
			<div class="stats-icon"><i class="fa fa-clock-o"></i></div>
			<div class="stats-info">
				<h4>WAKTU</h4>
				<p><span id="footer-time"></span></p>	
			</div>
			<div class="stats-link">
				<a href="javascript:;"><i class="fa fa-arrow-circle-o-right"></i></a>
			</div>
		</div>
	</div>

</div>
<div class="panel panel-inverse">
    <div class="panel-heading">
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
        </div>
        <h4 class="panel-title">Kalender</h4>
    </div>
    <div class="panel-body p-0">
        <div class="vertical-box">
            <div id="calendar" class="vertical-box-column p-15 calendar"></div>
        </div>
    </div>
</div>
