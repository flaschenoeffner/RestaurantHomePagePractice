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
			<li>Bilder</li>
			<li><a href = "essen_preise.php">Gerichte & Preise</a></li>
			<li><a href = "kontakt_formular.php">Öffnungszeiten & Kontakt</a></li>
			<li><a href = "loginFrischeV.php">Login</a></li>
			<li><a href = "kommentar.php">Kommentare</a></li>
			<li><a href = "ferienwohnungen.php">Ferienwohnung</a></li>
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
			<h1>Vögel</h1>
			<p style="text-align:center">Bilder von verschiedenen Vögel</p>
			<figure class = "gesamt">
			
				<figure class = "einzel">
					<a href = "../img/hühnerfleisch.jpg"><img src = "../img/Hühner_kleiner.jpg" alt ="Hühner"></a>
					<figcaption>Hühner</figcaption>
				</figure>
					
				<figure class = "einzel">
					<a href = "../img/putenfleisch.jpg"><img src = "../img/Pute_kleiner.jpg" alt ="Pute"></a>
					<figcaption>Pute</figcaption>
				</figure>
				
				<figure class = "einzel">
					<a href = "../img/taubenfleisch.jpg"><img src = "../img/Tauben_kleiner.jpeg" alt ="Tauben"></a>
					<figcaption>Tauben</figcaption>
				</figure>
				
				<figure class = "einzel">
					<a href = "../img/entenfleisch.jpg"><img src = "../img/Enten_kleiner.jpeg" alt ="Enten"></a>
					<figcaption>Enten</figcaption>
				</figure>
				
				<figure class = "einzel">
					<a href = "../img/gansfleisch.jpg"><img src = "../img/Gänse_kleiner.jpg" alt ="Gänse"></a>
					<figcaption>Gänse</figcaption>
				</figure>
				
			</figure>
		</article>
		<footer>
			<p>Der Abschluss der Seite</p>
		</footer>
	</body>
</html>