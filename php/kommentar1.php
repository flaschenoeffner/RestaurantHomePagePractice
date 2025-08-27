<?php
	session_start();

	
	$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
	$statement = $pdo->prepare("INSERT INTO chat(username,kommentar)VALUES(?,?)");
	$statement->bindParam(1,$username);
	$statement->bindParam(2,$kommentar);
	
	$username = $_SESSION['username'];
	$kommentar = $_POST["comment"];
	if($statement->execute())
		  header("Location: kommentar.php");  
	?>
