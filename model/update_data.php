<?php
	include "../config/config.php";
		$sql="UPDATE `tb_test` SET
		`id_data` = '$_POST[id_data]',
		`nama_data` = '$_POST[nama_data]',
		`jumlah` = '$_POST[jumlah]' WHERE `id_data` =
		'$_POST[id_data2]';";
	mysqli_query($sql) or die("Gagal Memperbaharui");
	header ("location:../index.php?p=absen");
?>