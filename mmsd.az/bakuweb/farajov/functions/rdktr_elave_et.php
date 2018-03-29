<?php
	if(isset($_POST["submit"])){
		$ad = $_POST['ad'];
		$ad = trim($ad);
		$birdefelik_login = $_POST['birdefelik_login'];
		$birdefelik_login = trim($birdefelik_login);
		$birdefelik_sifre = $_POST['birdefelik_sifre'];
		$birdefelik_sifre = trim($birdefelik_sifre);

		include '../../../db/db.php';
	    if($conn){
	    	$insert = "INSERT INTO bakuweb_admin (ad,bw_login,bw_pass,rutbe,aktiv) VALUES ('$ad','$birdefelik_login','$birdefelik_sifre','redaktor',0)";
			$netice = mysqli_query($conn,$insert);
			if($netice){
				echo "<script>window.location.href='../redaktor_elave_et.php';</script>";
			}
		}
	}else{
		header('Location: ../../farajov');
	}
?>