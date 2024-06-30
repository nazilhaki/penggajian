<?php
include "../config/config.php";
$sql="DELETE FROM `t_pegawai` WHERE `nip` =
'$_POST[nip]'";
if(mysqli_query($sql)){
	$data['say'] = "ok";
}else{
	$data['say'] = "NotOk";
}
if('IS_AJAX'){
    echo json_encode($data); //echo json string if ajax request
}
?>