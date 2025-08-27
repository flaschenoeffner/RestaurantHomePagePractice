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
			<li>Öffnungszeiten & Kontakt</li>
			
			<li><a href = "loginFrischeV.php">Login</a></li>
			<li><a href = "kommentar.php">Kommentare</a></li>
			<?php
					session_start();
					if(isset($_SESSION['username'])){
					?>
			<li><a href = "zwischenablage_anzeigen.php">Warenkorb</a></li>
			<li><a href = "profil.php">Profil</a></li>
			<li><a href = "logout.php">Log out</a></li>
			<?php
					}
				?>
			</ul>
		</nav>
		<article class = "rest">
				<div class = "formular">
					<h1>Lieferung</h1> <br>
					<?php 
						$vorname = $_POST["vorname"];
						$nachname = $_POST["zuname"];
						$nachricht = $_POST["nachricht"];
						$addresse = $_POST["Addresse"];
						$produkt = $_POST["produkt"];
						
						echo "<h5>Hallo " .$vorname. " ".$nachname."! Ihr Produkt ".$produkt. 
							" wird an die Addresse " .$addresse. " gesendet. Die Hühner werden
							gut " .$nachricht. "!</h5>";
					?>
				</div>
				
				
				
				<ul>
					<li>Montag: 10.00 bis 13.00 Uhr</li>
					<li>Dienstag: 09.00 bis 19.00 Uhr</li>
					<li>Mittwoch: 08.00 bis 20.00 Uhr</li>
					<li>Donnerstag: 09.00 bis 16.00 Uhr</li>
					<li>Freitag: 10.00 bis 21.00 Uhr</li>
				</ul>
				<ul>
					<li>Addresse: Musterstraße 1 123456 Bremen</li>
					<li>Telefonnummer: 123183274014375843</li>
					<li>E-mail: tierschutzverein@gmail.com</li>
				</ul>
				
				
				
		</article>
		<div class = "platz1"></div>
		<footer>
			<p>Der Abschluss der Seite</p>
		</footer>
	</body>
</html>