<?php
	session_start();
	$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
	$username = $_SESSION['username'];
	$ferienwohnung=$_GET['ferienwohnung'];
	$ferienwohnung = str_replace(' ','_',$ferienwohnung);
	$sql = "DELETE FROM mieter WHERE username = '$username' AND bezahlt = 0 AND ferienwohnung='$ferienwohnung'";
	$affected = $pdo->exec($sql);
	header("location:ferienwohnungen.php");
?>