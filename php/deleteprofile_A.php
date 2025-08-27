<?php
	$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
	$username = $_GET['username'];
	$sql = "DELETE FROM profil WHERE username = '$username'";
	$affected = $pdo->exec($sql);
	header("Location: kommentaradmin.php");
?>