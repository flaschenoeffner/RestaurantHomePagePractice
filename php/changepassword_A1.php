<?php
	session_start();
	$pdo = new PDO('mysql:host=localhost;dbname=praktikum','root','');
	$error = false;
	$username = $_GET['username'];
	$passwort=$_POST['password1'];
	$passwort2=$_POST['password2'];
	
	if(strlen($passwort)==0){
		"Bitte ein Passwortangeben <a href = 'changepassword.php'>zurück</a><br>";
		$error = true;
	}
	
	if($passwort!=$passwort2){
		echo "Die Passwörter müssen übereinstimmen <a href = 'changepassword.php'>zurück</a><br>";
		$errror = true;
	}
	
	if(!$error){
		$passwort_hash = password_hash($passwort,PASSWORD_DEFAULT);
		
		$sql = "UPDATE login SET passwort = '$passwort_hash', updated_at = NOW() WHERE username = '$username'";
		if($pdo->exec($sql)===1)
			header("Location: kommentaradmin.php");   
	}
?>