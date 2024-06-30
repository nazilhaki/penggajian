<?php
	 include "../config/config.php";
	 if ($_FILES['imagefile']['type'] == "image/jpeg"){
					$ori_src="D:/project/project1/assets/foto/imgori/".strtolower( str_replace(' ','_',$_FILES['imagefile']['name']) );
					if(move_uploaded_file ($_FILES['imagefile']['tmp_name'],$ori_src))
					{
						chmod("$ori_src",0777);
					}else{
						echo "Gagal melakukan proses upload file.";
						exit;
					}

					$thumb_src="D:/project/project1/assets/foto/".strtolower( str_replace(' ','_',$_FILES['imagefile']['name']) );
					
					$n_width = 150;
					$n_height = 150;
				
					if(($_FILES['imagefile']['type']=="image/jpeg") || ($_FILES['imagefile']['type']=="image/png") ||($_FILES['imagefile']['type']=="image/gif"))
					{
						$im = @ImageCreateFromJPEG ($ori_src) or // Read JPEG Image
						$im = @ImageCreateFromPNG ($ori_src) or // or PNG Image
						$im = @ImageCreateFromGIF ($ori_src) or // or GIF Image
						$im = false; // If image is not JPEG, PNG, or GIF
						
						//$im=ImageCreateFromJPEG($ori_src); 
						$width=ImageSx($im);              // Original picture width is stored
						$height=ImageSy($im);             // Original picture height is stored
						if(($n_height==0) && ($n_width==0)) {
							$n_height = $height;
							$n_width = $width;
						}	
		
						if(!$im) {
							echo '<p>Gagal membuat thumnail</p>';
							exit;
						}
						else {				
							$newimage=@imagecreatetruecolor($n_width,$n_height);                 
							@imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
							@ImageJpeg($newimage,$thumb_src);
							chmod("$thumb_src",0777);
						}
					}
					if ($_POST['password']=='') {
						$sql = "UPDATE tb_pengguna SET
						username = '".$_POST['username']."',
						imagefile='".$_FILES['imagefile']['name']."' WHERE username = '".$_POST['username2']."'";
					}else{
						$sql = "UPDATE tb_pengguna SET
						username = '".$_POST['username']."',
						password = '".md5($_POST['password'])."',
						imagefile='".$_FILES['imagefile']['name']."' WHERE username = '".$_POST['username2']."'";
					}
					mysqli_query($sql) or die("Gagal Memperbaharui");
					header ("location:../index.php");
					
				}elseif ($_POST['password']=='') {
						$sql = "UPDATE tb_pengguna SET
						username = '".$_POST['username']."' WHERE username = '".$_POST['username2']."'";
					}else{
						$sql = "UPDATE tb_pengguna SET
						username = '".$_POST['username']."',
						password = '".md5($_POST['password'])."'WHERE username = '".$_POST['username2']."'";
					}
					mysqli_query($sql) or die("Gagal Memperbaharui");
					header ("location:../index.php");
		

?>