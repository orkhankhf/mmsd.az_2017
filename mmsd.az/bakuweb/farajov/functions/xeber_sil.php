<?php
	if(isset($_POST['id']) && is_numeric($_POST['id']) && !empty($_POST['id'])){
		include "../../../db/db.php";
		$id = $_POST['id'];

		if($conn){
			$select_img_for_unlink = "SELECT tmp FROM news WHERE id='$id'";
			$netice_select_img = mysqli_query($conn,$select_img_for_unlink);
			while($row = mysqli_fetch_assoc($netice_select_img)){
				$tmp = $row['tmp'];
				$img_unlink = $row['tmp'];
			}

			$delete = "DELETE FROM news WHERE id='$id'";
			$netice = mysqli_query($conn,$delete);

			$delete_photos = "DELETE FROM photos WHERE tmp='$tmp'";
			$netice_photos = mysqli_query($conn,$delete_photos);

			if($netice && $netice_photos && !empty($img_unlink)){
				$folder_is_empty = false;
				foreach (glob("../../../news_files/".$img_unlink."/*.*") as $filename){
				    if(is_file($filename)){
				        unlink($filename);
				        $folder_is_empty = true;
				    }
				}
				if($folder_is_empty == true){
					rmdir("../../../news_files/".$img_unlink);
					echo "ok";
				}
			}else{
				echo "xeber_yoxdur";
			}
		}else{
			echo "Bağlantı qurulmadı";
		}
	}else{
		echo "ID adresi düzgün deyil";
	}
	mysqli_close($conn);
?>