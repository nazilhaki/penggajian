<?php
	include "../config/config.php";
	
	// Fungsi anti SQL Injection
	function antiinjection($data, $connection) {
		$filter_sql = mysqli_real_escape_string($connection, stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES))));
		return $filter_sql;
	}

	// Mengambil data dari form
	$username = antiinjection($_POST['username'], $connection);
	$password = antiinjection(md5($_POST['password']), $connection);

	// Query untuk mengecek pengguna
	$sql = "SELECT * FROM view_pengguna WHERE username='$username' AND password='$password'";
	$tampil = mysqli_query($connection, $sql);
	$jumlah = mysqli_num_rows($tampil);
	$data = mysqli_fetch_array($tampil);

	if ($jumlah > 0) {
		// Jika login berhasil, inisialisasi data pada session
		session_start();
		$_SESSION['nip'] = $data['nip'];
		$_SESSION['username'] = $data['username'];
		$_SESSION['password'] = $data['password'];
		$_SESSION['level'] = $data['level'];
		$_SESSION['nama_pegawai'] = $data['nama_pegawai'];
		$_SESSION['imagefile'] = $data['imagefile'];
		header('location:../index.php');
	} else {
		// Jika login gagal
		echo "<script>alert('Login Gagal, username atau password tidak cocok'); window.location = '../index.php'</script>";
	}
?>
