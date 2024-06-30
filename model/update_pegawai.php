<?php
	include "../config/config.php";
		$sql="UPDATE `t_pegawai` SET
		`nip` = '$_POST[nip]',
		`nama_pegawai` = '$_POST[nama_pegawai]',
		`tgl_lhr` = '$_POST[tgl_lhr]',
		`alamat` = '$_POST[alamat]',
		`tlp` = '$_POST[tlp]',
		`id_jabatan` = '$_POST[id_jabatan]' WHERE `nip` =
		'$_POST[nip]';";
	mysqli_query($sql) or die("Gagal Memperbaharui");
	header ("location:../index.php?p=data_pegawai");
?>