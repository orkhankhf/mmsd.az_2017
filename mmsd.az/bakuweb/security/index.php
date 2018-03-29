<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Təhlükə!</title>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../farajov/bootstrap/css/bootstrap.min.css">
	<style type="text/css">
		strong{
			font-size: 23px;
		}
		p{
			font-size: 20px;
			line-height: 35px;
		}
		.alert-danger{
			width: 50%;
			position: absolute;
			left: 25%;
			top: 100px;
		}
	</style>
</head>
<body>
	<div class="alert alert-danger">
	  <strong>Diqqət!</strong><p>Siz, qanunsuz olaraq başqasının mülkiyyəti olan sayta hücuma (zərər verib, sıradan çıxartmağa) cəhd etdiyiniz üçün IP (Internet Protocol) adresiniz qeydiyyata alındı və Azərbaycan Respublikası Cinayət Məcəlləsinin otuzuncu fəslində (Kiber cinayət) göstərilən 271, 272, 273-cü maddələrinə əsasən barənizdə tədbir görülməsi üçün Dövlət Təhlükəsizlik Xidmətinə müraciyət olunacaq.</p>
	</div>
	<?php
	if(!isset($_SESSION['login_atack']) && !isset($_SESSION['password_atack'])){
			header('Location: ../farajov');
		}
		date_default_timezone_set("Asia/Baku");
		$date = new \DateTime();
		$IP1 = $_SERVER['REMOTE_ADDR'];
		$PORT = $_SERVER['REMOTE_PORT'];
		$IP2 = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
		$date_time = date_format($date, 'Y-m-d H:i:s');
		$login_atack = $_SESSION['login_atack'];
		$password_atack = $_SESSION['password_atack'];

		// Create the email and send the message
		$to = "orhandwk@code.edu.az"; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
		$email_subject = "MMSD.AZ'a zərərli məzmun göndərildi! ($date_time)";
		$email_body = "Məlumatlar:\n\nIP: $IP1\n\nPORT: $PORT\n\nIP2: $IP2\n\nTarix və saat: $date_time\n\nAdminpanel giriş'də təsbit edilən zərərli məzmun: \n\nLogin: $login_atack\n\nŞifrə: $password_atack";
		$headers = "From: info@mmsd.az\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
		$headers .= "Reply-To: info@mmsd.az";
		$send = mail($to,$email_subject,$email_body,$headers); // 
		unset($_SESSION['login_atack']);
		unset($_SESSION['password_atack']);
	?>
</body>
</html>