<?php
	if(isset($_POST["submit"])){
		include '../../../db/db.php';
		$id = $_POST['id'];
		$img_tmp = $_POST['img_tmp'];
		$basliq = $_POST["basliq"];
		$basliq = trim($basliq);
		//eger stringde ' varsa onu " et
		$basliq = str_replace("'",'"',$basliq);
		$basliq_iki = $_POST["basliq_iki"];
		$basliq_iki = trim($basliq_iki);
		//eger stringde ' varsa onu " et
		$basliq_iki = str_replace("'",'"',$basliq_iki);
		$metn = $_POST['metn'];
		$metn = trim($metn);
		$kateqoriya = $_POST["kateqoriya"];
		$sekil_move_olub = false;

		$image_names = array();
		//eger diger sekiller silinecekse, yeni inputtan gelen deyer bos deyilse
		if(isset($_POST['silinecek_sekiller']) && $_POST['silinecek_sekiller'] != null){
			$silinecek_sekiller = $_POST['silinecek_sekiller'];
			$silinecek_sekiller = explode("-",$silinecek_sekiller);
			for($a=0; $a<count($silinecek_sekiller); $a++){
				array_push($image_names, $silinecek_sekiller[$a]);
			}
			$image_names = implode(' || id = ', $image_names);

			$select = "SELECT image FROM photos WHERE id = ".$image_names;
			$netice = mysqli_query($conn,$select);
			while($row = mysqli_fetch_assoc($netice)){
				unlink('../../../news_files/'.$img_tmp."/".$row['image']);
			}
			$delete = "DELETE FROM photos WHERE id = ".$image_names;
			$delete_netice = mysqli_query($conn,$delete);
		}

		//eger sekil varsa file inputunda
		if(!empty($_FILES['image']['name'][0])){
			$total = count($_FILES['image']['name']);
		    for($a=0;$a<$total;$a++){
			   	$yeri = $_FILES['image']['tmp_name'][$a];
				$olcusu = $_FILES['image']['size'][$a];
				if($yeri != "" && $olcusu < 20000000){
				    $yeni_yeri = "../../../news_files/".$img_tmp."/".$_FILES['image']['name'][$a];
				    if(move_uploaded_file($yeri, $yeni_yeri)){
						$sekil_move_olub = true;
						$this_img_nm = $_FILES['image']['name'][$a];
						if($this_img_nm != "esas.jpg"){
							$insert = "INSERT INTO photos (image,tmp) VALUES ('$this_img_nm','$img_tmp')";
							$netice = mysqli_query($conn,$insert);
						}
					}
				}else{
				  	echo "Faylın göndərilməsində problem yaşandı!";
				}
			}
			if($sekil_move_olub != true){
				echo "Şəkillərin serverə yüklənməsində problem yaşandı !";
			}
		}
			//diger sehifelerdeki kicik sekiller ucun thumbnail duzeldir (esas sekilin 100 px olcusunde yenisini yaradir)
			function make_thumb($src, $dest, $desired_width){
				/* read the source image */
				$source_image = imagecreatefromjpeg($src);
				$width = imagesx($source_image);
				$height = imagesy($source_image);
				
				/* find the "desired height" of this thumbnail, relative to the desired width  */
				$desired_height = floor($height * ($desired_width / $width));
				
				/* create a new, "virtual" image */
				$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
				
				/* copy source image at a resized size */
				imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
				
				/* create the physical thumbnail image to its destination */
				imagejpeg($virtual_image, $dest);
			}
			make_thumb("../../../news_files/".$img_tmp."/esas.jpg","../../../news_files/".$img_tmp."/thumb.jpg", '100px');

	    $insert = "UPDATE news SET basliq = '$basliq', basliq_iki = '$basliq_iki', metn = '$metn', kateqoriya = '$kateqoriya' WHERE id = '$id'";
		$netice = mysqli_query($conn,$insert);
	    if($netice){
	    	mysqli_close($conn);
	    	echo "<script>window.location.href='../admin.php';</script>";
	    }else{
	    	echo "Məlumatlar databazaya yazılmadı!";
	    }
	}else{
		header('Location: ../../farajov');
	}
?>