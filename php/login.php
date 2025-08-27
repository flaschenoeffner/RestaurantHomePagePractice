<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=praktikum','root','');

if(isset($_GET['login'])){
	$email = $_POST['email'];
	$passwort = $_POST['passwort'];
	
	$statement = $pdo->prepare("SELECT * FROM login WHERE email = :email");
	$result = $statement->execute(array('email' => $email));
	$user = $statement->fetch();
	if($user !== false && password_verify($passwort,$user['passwort'])){
		$_SESSION['username']=$user['username'];
		die('login erfolgreich. Weiter zu <a href="geheim.php">internen Bereich</a>');
	}
	else{
		$errorMessage = "E-Mail oder Passwort war ungültig<br>";
	}
}
?>

<?php
if(isset($errorMessage)){
	echo $errorMessage;
}
?>

<form action = "?login=1" method = "post">
E-MAil:<br>
<input type = "email" size = "40" maxlength="250" name = "email"><br><br>
Dein Passwort:<br>
<input type = "password" size = "40" maxlength="250" name="passwort"><br><br>

<input type ="submit" value = "Abschicken">
</form>