<?php 
	if ($_SESSION['level']=='admin'){
 ?>
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<a href="index.php" class="navbar-brand"><span class="navbar-logo"></span> APP Penggajian</a>
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- end mobile sidebar expand / collapse button -->
				
				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
					<li>
						<form class="navbar-form full-width">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Enter keyword" />
								<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
							</div>
						</form>
					</li>
					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<img src="assets/foto/<?php echo $_SESSION['imagefile']; ?>" alt="" /> 
							<span class="hidden-xs"><?php echo  ucwords($_SESSION['nama_pegawai']); ?></span> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
							<li><a href="">Edit Profile</a></li>
							<li class="divider"></li>
							<li><a href="model/aksi_logout.php">Log Out</a></li>
						</ul>
					</li>
				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<div class="image">
							<a href="index.php?p=profil&&username=<?php echo $_SESSION['username']; ?>"><img src="assets/foto/<?php echo $_SESSION['imagefile']; ?>" alt="" /> </a>
						</div>
						<div class="info">
							<?php echo  ucwords($_SESSION['nama_pegawai']); ?>
							<small><?php echo  ucwords($_SESSION['level']); ?></small>
						</div>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header">Navigation</li>
					<li class="has-sub active">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
						    <i class="fa fa-laptop"></i>
						    <span> Admin</span>
					    </a>
						<ul class="sub-menu">
						    <li><a href="index.php?p=profil&&username=<?php echo $_SESSION['username']; ?>"> Profil</a></li>
						    <li><a href="index.php?p=data_pengguna"> Data Pengguna</a></li>
						</ul>
					</li>
					<li class="has-sub active">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
						    <i class="fa fa-suitcase"></i>
						    <span>Master</span> 
						</a>
						<ul class="sub-menu">
							<li><a href="index.php?p=data_jabatan">Data Jabatan</a></li>
							<li><a href="index.php?p=data_pegawai">Data Pegawai</a></li>
						</ul>
					</li>
					<li class="has-sub active">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
						    <i class="glyphicon glyphicon-shopping-cart"></i>
						    <span>Transaksi</span> 
						</a>
						<ul class="sub-menu active">
							<li><a href="index.php?p=absen">Absen</a></li>
							<li><a href="index.php?p=data_gaji">Gaji</a></li>
						</ul>
					</li>
					
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			        <!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
		<?php
            $pages_dir = 'view/content';
                if(!empty($_GET['p'])){
                    $pages = scandir($pages_dir, 0);
                    unset($pages[0], $pages[1]);
                    $p = $_GET['p'];
                    if(in_array($p.'.php', $pages)){
                        include($pages_dir.'/'.$p.'.php');
                    } else {
                        ?>
				            <script type="text/javascript">
				                window.location.href="halaman_error.php";
				            </script>
				        <?php
                    }
                } else {
                    include($pages_dir.'/home.php');
                }
            ?>
			
		</div>
        
        <!-- end theme-panel -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
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