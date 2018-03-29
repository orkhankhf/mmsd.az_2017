<?php
	if(isset($_POST['submit'])){
		include "../../../db/db.php";
		session_start();
		$old_login = $_SESSION["login_for_update"];
		$old_password = $_SESSION["password_for_update"];
		$editor_id = $_SESSION['new_editor_id'];

		$new_login = $_POST['login'];
		$new_password = $_POST['password'];

		$update = "UPDATE bakuweb_admin SET bw_login = '$new_login', bw_pass = '$new_password', aktiv = 1 WHERE id = '$editor_id' AND bw_login = '$old_login' AND bw_pass = '$old_password'";
		$netice = mysqli_query($conn,$update);
		if($netice){
			$_SESSION["login_fv26d5s1s8w92dfc"] = $new_login;
			$_SESSION["password_df165w6f1d5f94fq"] = $new_password;
			unset($_SESSION['new_editor_id']);
			mysqli_close($conn);
			echo "<script>window.location.href='../admin.php';</script>";
		}else{
			echo "Məlumatlar databazaya yazılmadı!";
		}
	}
?>