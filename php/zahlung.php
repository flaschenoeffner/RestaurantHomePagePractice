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
			session_start();
			$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
			$username= $_SESSION['username'];
			$plz = $_POST['plz'];
			$lieferort = $_POST['lieferort'];
			$lieferaddresse = $_POST['lieferaddresse'];
			
			
			
				$sql="UPDATE zwischenablage SET plz = '$plz', lieferort='$lieferort', lieferaddresse = '$lieferaddresse',
				updated_at = NOW() WHERE username = '$username'";
				if($pdo->exec($sql)>=1)
				{
		?>


					<div class = "formular">
						<h1>Zahlungsartwählen</h1>
						<form action = "confirm.php">
						
						<input type = "checkbox" name = "paypal" action = "?paypal=1">Paypal<br>

						<input type = "checkbox" name = "kreditkarte" action = "?kreditkarte=1">Kreditkarte<br>
						
						<input type = "checkbox" name = "klarna" action = "?klarna=1">Klarna<br>
						
						<input type = "checkbox" name = "frischeVfamilycard" action = "?frischeVfamilycard=1">Frische Vögel-Familienkarte<br>
						<button type = "reset">Eingabe zurücksetzen</button>
						 <a href = "confirm.php"><button type = "submit">Absenden</button></a>
						</form> 
					</div>
		<?php
				}
		?>
		</article>
		<div class = "platz1"></div>
		<footer>
			<p>Der Abschluss der Seite</p>
		</footer>
	</body>
</html>

