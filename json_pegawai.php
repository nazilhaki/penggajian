<?php
include "config/config.php";

$tampil=mysqli_query("SELECT * from t_pegawai inner join t_jabatan on t_pegawai.id_jabatan=t_jabatan.id_jabatan JOIN t_absen on t_pegawai.nip = t_absen.nip and t_pegawai.nip='$_POST[nip]' WHERE t_absen.bulan='$_POST[bulan]' AND t_absen.tahun='$_POST[tahun]'");
$data=mysqli_fetch_array($tampil);
$pegawai['nama_pegawai']=$data['nama_pegawai'];
$pegawai['nama_jabatan']=$data['nama_jabatan'];
$pegawai['gaji_pokok']=$data['gapok'];
$pegawai['tunjangan_jabatan']=$data['tunjangan'];
$pegawai['hadir']=$data['hadir'];
$pegawai['sakit']=$data['sakit'];
$pegawai['ijin']=$data['ijin'];
$pegawai['tanpa_keterangan']=$data['tanpa_keterangan'];
$pegawai['bulan']=$data['bulan'];
$pegawai['tahun']=$data['tahun'];
echo json_encode($pegawai);

?>
