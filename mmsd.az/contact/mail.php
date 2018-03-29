<?php
// Check for empty fields
if(empty($_POST['ad'])  		||
   empty($_POST['email']) 		||
   empty($_POST['muraciet']) 		||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	  exit('fail');
   }

$ip = $_SERVER['REMOTE_ADDR'];
 
	
$name = $_POST['ad'];
$email_address = $_POST['email'];
$message = $_POST['muraciet'];

// Create the email and send the message
$to = 'orhandwk@code.edu.az,info@mmsd.az'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "MMSD.AZ'a müraciət edən:  $name";
$email_body = "Ad: $name\n\nE-mail: $email_address\n\nIP: $ip\n\nMüraciətin məzmunu:\n$message";
$headers = "From: MMSD.AZ-Muraciət@mmsd.az\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";	
$send = mail($to,$email_subject,$email_body,$headers);
if($send){
	echo "<script>window.location.href='../contact';</script>";;
}else{
	echo "<script>alert('Xəta baş verdi!');</script>";
	echo "<script>window.location.href='../contact';</script>";
}
?>