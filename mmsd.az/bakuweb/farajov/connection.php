<?php
	session_start();
	$login = htmlentities($_POST["login"], ENT_QUOTES, 'UTF-8');
	$password = htmlentities($_POST["password"], ENT_QUOTES, 'UTF-8');

	$input = $login.$password;
	$login_password_counter = 0;

	for($i=0;$i<strlen($input);$i++){
		if($input[$i] == "\\" || $input[$i] == "-" || $input[$i] == "+" || $input[$i] == "*" || $input[$i] == "/" || $input[$i] == "." || $input[$i] == "|" || $input[$i] == "=" || $input[$i] == "_" || $input[$i] == ")" || $input[$i] == "(" || $input[$i] == "&" || $input[$i] == "^" || $input[$i] == "%" || $input[$i] == "$" || $input[$i] == "#" || $input[$i] == "@" || $input[$i] == "!" || $input[$i] == "`" || $input[$i] == "~" || $input[$i] == "}" || $input[$i] == "]" || $input[$i] == "{" || $input[$i] == "[" || $input[$i] == "'" || $input[$i] == '"' || $input[$i] == ";" || $input[$i] == ":" || $input[$i] == "/" || $input[$i] == "?" || $input[$i] == ">" || $input[$i] == "<" || $input[$i] == "," || $input[$i] == " " || $input[$i] == "" ){
			$_SESSION['login_atack'] = $login;
			$_SESSION['password_atack'] = $password;
			header('Location: ../security');
			break;
		}else{
			$login_password_counter++;
		}
	}

	if($login_password_counter == strlen($input)){
		include "../../db/db.php";
		if($conn){
			$select = "SELECT * FROM bakuweb_admin WHERE bw_login = '$login' AND bw_pass = '$password'";
			$result = mysqli_query($conn,$select);
			while($row = mysqli_fetch_assoc($result)){
				$loginDB = $row['bw_login'];
				$passwordDB = $row['bw_pass'];
				$rutbe = $row['rutbe'];
				$yonetici_ismi = $row['ad'];
				$yonetici_id = $row['id'];
				if($row['aktiv'] == 0){
					$_SESSION["login_for_update"] = $login;
					$_SESSION["password_for_update"] = $password;
					$_SESSION['new_editor_id'] = $row['id'];
					header("Location: functions/new_editor.php");
					exit();
				}
			}
			if($login == $loginDB && $password == $passwordDB){
				if($rutbe == "redaktor"){
					$_SESSION['rutbe'] = "redaktor";
				}else{
					$_SESSION['rutbe'] = "bas_admin";
				}
				$_SESSION['yonetici_ismi'] = $yonetici_ismi;
				$_SESSION['yonetici_id'] = $yonetici_id;
				$_SESSION["login_fv26d5s1s8w92dfc"] = $login;
				$_SESSION["password_df165w6f1d5f94fq"] = $password;
				header('Location: admin.php');
			}else{
				header('Location: ../farajov');
			}
			mysqli_close($conn);
		}
	}
?>