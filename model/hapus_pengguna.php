<?php
include "../config/config.php";
$sql="DELETE FROM `tb_pengguna` WHERE `username` =
'$_POST[nip]'";
if(mysql_query($sql)){
	$data['say'] = "ok";
}else{
	$data['say'] = "NotOk";
}
if('IS_AJAX'){
    echo json_encode($data); //echo json string if ajax request
}
?>