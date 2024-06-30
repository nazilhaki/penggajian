<?php
	include "../config/config.php";
		$sql="UPDATE `t_jabatan` SET
		`nama_jabatan` = '$_POST[nama_jabatan]',
		`gapok` = '$_POST[gapok]',
		`tunjangan` = '$_POST[tunjangan]' WHERE `id_jabatan` =
		'$_POST[id_jabatan]';";
	mysqli_query($sql) or die("Gagal Memperbaharui");
	header ("location:../index.php?p=data_jabatan");
?>