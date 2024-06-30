<?php
	include "../config/config.php";
		$sql="UPDATE `t_absen` SET
		`hadir` = '$_POST[hadir]',
		`sakit` = '$_POST[sakit]',
		`ijin` = '$_POST[ijin]',
		`tanpa_keterangan` = '$_POST[tanpa_keterangan]' WHERE `id` =
		'$_POST[id]';";
	mysqli_query($sql) or die("Gagal Memperbaharui");
	header ("location:../index.php?p=absen");
?>