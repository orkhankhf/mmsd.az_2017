<?php
	if(isset($_POST['id']) && is_numeric($_POST['id']) && !empty($_POST['id'])){
		include "../../../db/db.php";
		$id = $_POST['id'];

		if($conn){
			$update_slider = "UPDATE news SET slider=0 WHERE id='$id'";
			$netice = mysqli_query($conn,$update_slider);
			if($netice){
				echo "ok";
			}
		}else{
			echo "Bağlantı qurulmadı";
		}
	}else{
		echo "ID adresi düzgün deyil";
	}
	mysqli_close($conn);
?>