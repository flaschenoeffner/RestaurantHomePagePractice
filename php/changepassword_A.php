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
			<li><a href = "kontakt_formular.php">Öffnungszeiten & Kontakt</a></li>
			<li><a href = "kommentaradmin.php">Admin</a></li>
			<li><a href = "showlager_A.php">Lager bearbeiten</a></li>
			<li><a href = "showorders.php">Bestellungen anzeigen</a></li>
			<li><a href = "loginFrischeV.php">Login</a></li>
			<li><a href = "kommentar.php">Kommentare</a></li>
			<li><a href = "zwischenablage_anzeigen.php">Warenkorb</a></li>
			<li>Profil</li>
			<li><a href = "logout.php">Log out</a></li>
			
			</ul>
		</nav>
		<article class = "rest">
		
				<div class = "formular">
				<?php
					session_start();
					$pdo = new PDO('mysql:host=localhost;dbname=praktikum','root','');
					if(!isset($_SESSION['username'])){
					die('Bitte zuerst <a href="profillogin.php">einloggen</a>');
					}

					$username = $_GET['username'];

					echo "Hallo ".$username;//Verschlüsselung
				

				echo"<h1>Passwort ändern</h1>
					<form id = 'person' action ='changepassword_A1.php?username=".$username."' method ='post'>"
					?>
						
						
						<label for = "password1">Neues Passwort:</label>
						<input type = "password" name = "password1" id = "password1">
						
						<label for = "password2">Passwort wiederholen:</label>
						<input type = "password" name = "password2" id = "password2">
						
						<button type = "reset">Eingabe zurücksetzen</button>
						 <button type = "submit">Absenden</button>
					</form> 
				</div>
		</article>
		<div class = "platz1"></div>
		<footer>
			<p>Der Abschluss der Seite</p>
		</footer>
	</body>
</html>