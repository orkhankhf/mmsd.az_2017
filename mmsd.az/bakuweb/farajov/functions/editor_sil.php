<?php
	if(isset($_POST['id']) && is_numeric($_POST['id']) && !empty($_POST['id'])){
		include "../../../db/db.php";
		$id = $_POST['id'];

		if($conn){
			$delete = "DELETE FROM bakuweb_admin WHERE id='$id'";
			$netice = mysqli_query($conn,$delete);

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