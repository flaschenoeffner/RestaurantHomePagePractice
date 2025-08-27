<?php
	$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
	$id = $_GET['idchat'];
	$sql = "DELETE FROM chat WHERE idchat = '$id'";
	$affected = $pdo->exec($sql);
	header("Location: kommentaradmin.php");
?>