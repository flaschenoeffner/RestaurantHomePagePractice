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
			<li><a href = "kommentar.php">Kommentare</a></li>
			<li><a href="ferienwohnungen.php">Ferienwohnung</a></li>
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
		<?php
			$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
			$username = $_SESSION['username'];
			$zahlungsart = "";
			if(isset($_GET['paypal']))
				$zahlungsart = "paypal";
			if(isset($_GET['kreditkarte']))
				$zahlungsart = "kreditkarte";
			if(isset($_GET['frischeVfamilycard']))
				$zahlungsart = "frischeVfamilycard";
			if(isset($_GET['klarna']))
				$zahlungsart = "klarna";
			//echo $zahlungsart;
			$sql1 = "UPDATE mieter SET zahlungsart = '$zahlungsart', bezahlt = 1, updated_at= NOW() WHERE username = '$username' AND bezahlt = 0";
			if ($pdo->exec($sql1)>=1){
				die('Zahlung erfolgreich');
			}
	
		?>
		</article>
		<div class = "platz1"></div>
		<footer>
			<p>Der Abschluss der Seite</p>
		</footer>
	</body>
</html>



