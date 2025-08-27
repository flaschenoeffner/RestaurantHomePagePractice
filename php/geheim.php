<?php
session_start();
if(!isset($_SESSION['username'])){
	die('Bitte zuerst<a href="login.php">einloggen</a>');
}

$username = $_SESSION['username'];

echo "Hallo ".$username;
?>