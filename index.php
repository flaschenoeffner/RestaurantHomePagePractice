<! DOCTYPE html>
<html lang= "de">
<head>
	<meta charset = "UTF-8">
	<title>Restaurant Frische Vögel</title>
	<link rel = "stylesheet" href="css/style.css">
</head>

<body>
	<header>
		<p>Vögel sind laut</p>
	</header>
	<nav>
		<ul>
			<li>Start</li>
			<li><a href = "php/arten.php">Arten & Herkunft </a></li>
			<li><a href = "php/bilder.php">Bilder</a></li>
			<li><a href = "php/essen_preise.php">Gerichte & Preise</a></li>
			<li><a href = "php/kontakt_formular.php">Öffnungszeiten & Kontakt</a></li>
			<li><a href = "php/loginFrischeV.php">Login</a></li>
			<li><a href = "php/kommentar.php">Kommentare</a></li>
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
	<article class = "start">
		<h1>Willkommen!</h1>
		<p>Auf dieser Webseite finden Sie unsere Spzialitäten!</p>
		<p>Gönnen Sie sich das beste Vogelessen-Erlebnis zu den günstigsten Preisen!</p>
	</article>
	<footer>
		<p>Abschluss der Webseite</p>
	</footer>
</body>
</html>