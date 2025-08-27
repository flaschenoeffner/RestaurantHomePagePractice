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
			<li>Arten & Herkunft</li>
			<li><a href = "bilder.php">Bilder</a></li>
			<li><a href = "essen_preise.php">Gerichte & Preise</a></li>
			<li><a href = "kontakt_formular.php">Öffnungszeiten & Kontakt</a></li>
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
		<h1>Vogelarten zum Essen</h1>
		<table>
			<tr>
				<th>Art</th>
				<th>Ort</th>
				<th>Geschmack</th>
			</tr>
			<tr>
				<td>Huhn</td>
				<td>Frische Vögel Bremen, Bayern, Türingen</td>
				<td>salzig/ süß</td>
			</tr>
			<tr>
				<td>Pute</td>
				<td>Frische Vögel Berlin</td>
				<td>salzig/ süß/ sauer</td>
			</tr>
			<tr>
				<td>Taube</td>
				<td>Frische Vögel Baden-Württemberg, Hamburg, Niedersachsen</td>
				<td>salzig/ süß/ bitter</td>
			</tr>
			<tr>
				<td>Ente</td>
				<td>Frische Vögel Saarland, Mecklenburg-Vorpommern</td>
				<td>süß/ bitter</td>
			</tr>
			<tr>
				<td>Gans</td>
				<td>Frische Vögel Thüringen</td>
				<td>sauer</td>
			</tr>
		</table>
		</article>
		<div class = "platz1"></div>
		<footer>
			<p>Der Abschluss der Seite</p>
		</footer>
	</body>
</html>