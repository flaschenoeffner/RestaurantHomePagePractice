<?php

	$pdo = new PDO('mysql:host=localhost;dbname=praktikum','root','');
	session_start();
	$username = $_SESSION['username'];
	$gericht_z = $_GET['gericht_z'];
	$menge_z = $_GET['menge_z'];
	$menge_z--;
	$einzelpreis = $_GET['einzelpreis'];
	$gesamtpreis = $menge_z*$einzelpreis;
	$sql = "UPDATE zwischenablage SET menge_z = '$menge_z',
			updated_at = NOW() WHERE username = '$username' AND gericht_z = '$gericht_z'";
	if($pdo->exec($sql)===1){
		$sql1 = "UPDATE zwischenablage SET gesamtpreis = '$gesamtpreis',
			updated_at = NOW() WHERE username = '$username' AND gericht_z = '$gericht_z'";
			if($pdo->exec($sql1)===1)
				header('Location:zwischenablage_anzeigen.php');
	}
		
?>
