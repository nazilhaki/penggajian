<?php
	include "../config/config.php";
		$sql="UPDATE `t_penggajian` SET
		`no_penggajian` = '$_POST[no_penggajian]',
		`bonus` = '$_POST[bonus]' WHERE `no_penggajian` =
		'$_POST[no_penggajian]';";
	mysqli_query($sql) or die("Gagal Memperbaharui");
	header ("location:../index.php?p=data_gaji");
?>