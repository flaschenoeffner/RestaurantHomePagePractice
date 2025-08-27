<! DOCTYPE html>
<html lang = "de">
	<head>
		<meta charset = "UTF-8">
		<title>Restaurant Frische Vögel</title>
		<link rel = "stylesheet" href="../css/style.css">
	</head>
	
	<body>
		<header>
			<p>Vögel sind laut</p>
		</header>
		<nav>
			<ul>
			<li><a href = "../index.php">Start</a></li>
			<li><a href = "arten.php">Arten & Herkunft </a></li>
			<li><a href = "bilder.php">Bilder</a></li>
			<li><a href = "essen_preise.php">Gerichte & Preise</a></li>
			<li><a href = "kontakt.php">Öffnungszeiten & Kontakt</a></li>
			<li><a href = "kommentar.php">Kommentare</a></li>
			<li>Login</li>
			</ul>
		</nav>
		<article class = "rest">
		
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
		header("location:profil.php");
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
	<div class= "formular">
	<form action = "?login=1" method = "post">
		<label for "email">E-Mail:</label>
		<input type = "email" size = "40" maxlength="250" name = "email"><br><br>
		<label for "passwort">Dein Passwort:</label>
		<input type = "password" size = "40" maxlength="250" name="passwort"><br><br>

		<input type ="submit" value = "Login">
	</form>
	</div>
		<br>
		<p>Noch kein Mitglied? <a href = "registrierungFrischeV.php">Hier gehts zur Registrierung</a>
		</article>
		<div class = "platz1"></div>
		<footer>
			<p>Der Abschluss der Seite</p>
		</footer>
	</body>
</html>