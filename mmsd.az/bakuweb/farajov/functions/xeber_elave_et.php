<?php
	session_start();
	if(isset($_POST["submit"])){
		$total = count($_FILES['image']['name']);

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

		date_default_timezone_set("Asia/Baku");
		$date = new \DateTime();
		$tarix = date_format($date, 'y/m/d');

		$saat = date_format($date, 'H:i');

		$muellif_id = $_SESSION['yonetici_id'];
		
		$sekil_move_olub = false;
		$img_names = array();

			//eger sekil sayi 15 den cox deyilse
			if($total < 16){
				//news_files papkasinda yeni xeber sekilleri ucun papka yaradilir start
				$item_folder = time();
				mkdir("../../../news_files/".$item_folder);
				//news_files papkasinda yeni xeber sekilleri ucun papka yaradilir finish

				for($i=0; $i<$total; $i++){
				  $yeri = $_FILES['image']['tmp_name'][$i];
				  $olcusu = $_FILES['image']['size'][$i];
				  array_push($img_names, $_FILES['image']['name'][$i]);
				  //Make sure we have a filepath
				  if($yeri != "" && $olcusu < 20000000){
				    //Setup our new file path
				    $yeni_yeri = "../../../news_files/".$item_folder."/".$_FILES['image']['name'][$i];
				    //Upload the file into the temp dir
				    if(move_uploaded_file($yeri, $yeni_yeri)){
				    	$sekil_move_olub = true;
				    }
				  }else{
				  	echo "Faylın göndərilməsində problem yaşandı!";
				  }
				}
			}else{
				echo "<script>alert('Maksimum 15 şəkil yükləmək olar!');
						window.location.href='../admin.php';</script>";
			}
		if($sekil_move_olub == true){
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
			make_thumb("../../../news_files/".$item_folder."/esas.jpg","../../../news_files/".$item_folder."/thumb.jpg", '100px');
	    	include '../../../db/db.php';
	    	if($conn){
	    		$insert = "INSERT INTO news (basliq,basliq_iki,metn,kateqoriya,tmp,tarix,saat,muellif) VALUES ('$basliq','$basliq_iki','$metn','$kateqoriya','$item_folder','$tarix','$saat','$muellif_id')";
				$netice = mysqli_query($conn,$insert);
				$update = "UPDATE bakuweb_admin SET xeber_sayi = xeber_sayi + 1 WHERE id = '$muellif_id'";
				$update_netice = mysqli_query($conn,$update);
	    		for($i=0; $i < count($img_names); $i++){ 
					$insert_photos = "INSERT INTO photos (image,tmp) VALUES ('$img_names[$i]','$item_folder')";
					$netice_in_ph = mysqli_query($conn,$insert_photos);
				}
				if($netice && $netice_in_ph){
	    			mysqli_close($conn);
	    			echo "<script>window.location.href='../admin.php';</script>";
	    		}else{
	    			echo "Məlumatlar databazaya yazılmadı!";
	    		}
			}
		}else{
			echo "Şəkillər yüklənmədi!";
		}
	}else{
		header('Location: ../../farajov');
	}
?>