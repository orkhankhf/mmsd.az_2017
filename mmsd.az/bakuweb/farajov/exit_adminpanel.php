<?php
session_start();
if(isset($_POST['exit']) && $_POST['exit'] == "exit"){
	unset($_SESSION["login_fv26d5s1s8w92dfc"]);
	unset($_SESSION["password_df165w6f1d5f94fq"]);
	echo "admin_exit";
}
?>