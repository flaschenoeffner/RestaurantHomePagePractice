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
			
			<li><a href = "loginFrischeV.php">Login</a></li>
			<li><a href="kommentare.php">Kommentare</a></li>
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

					$username = $_SESSION['username'];

					echo "Hallo ".$username;//Verschlüsselung
				?>

					<h1>Dein Profil</h1>
					<form id = "person" action = "update.php" method ="post" enctype="multipart/form-data">
						<!--<label for = "username">Name</label>
						<input type = "text" name = "username" id = "username" maxlength = "40">-->
						
						<label for = "vorname">Vorname:</label>
						<input type = "text" name = "vorname" id = "vorname">
						
						<label for = "nachname">Nachname:</label>
						<input type = "text" name = "nachname" id = "nachname">
						
						<label for = "strasse">Straße:</label>
						<input type = "text" name = "strasse" id = "strasse">
						
						<label for = "plz">PLZ:</label>
						<input type = "number" name = "plz" id = "plz">
						
						<label for = "ort">Ort:</label>
						<input type = "text" name = "ort" id = "ort">
						
						<label for = "telefon">Telefon:</label>
						<input type = "number" name = "telefon" id = "telefon">
						
						<label for = "datei">Profilbild:</label>
						<input type = "file" name = "datei" id = "datei">
						
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