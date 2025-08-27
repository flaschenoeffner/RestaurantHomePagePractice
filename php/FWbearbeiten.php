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
			<li>Ferienwohnung</li>
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
			<h1>Ferienwohnungen</h1>
			<p style="text-align:center">Das beste Erlebnis beim Vögeljagen</p>
			<figure class = "gesamt">
			
			<?php
			$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
			$username = $_SESSION['username'];
			$sql= "SELECT*FROM ferienwohnung";
			$sql3 = "SELECT * FROM login";
			foreach($pdo->query($sql3) as $row){
				if($row['username']===$username&&$row['recht']!=='admin')
				die('Du bist kein admin');
			}
			
			foreach($pdo->query($sql)as $row){
				$art = str_replace('_',' ',$row['art']);
				echo"
				<div class = 'formular'>
				<form action = 'FWbearbeiten1.php?id=".$row['id']."' method='post' enctype='multipart/form-data'>
					<label for 'datei'>Datei:</label>
					<input type = 'file' name = 'datei' id = 'datei'>
					
					<label for 'art'>Art:</label>
					<input type = 'text' name = 'art' value=".$art." maxlength = '40'>
					
					<label for 'platz'>Plätze:</label>
					<input type = 'number' name = 'platz' value=".$row['platz']." maxlength = '40'>
					
					<label for 'personen'>Personen pro Wohnung:</label>
					<input type = 'number' name = 'personen' value=".$row['personenproFW']." maxlength = '40'>
					
					<label for 'preis'>Preis:</label>
					<input type = 'text' name = 'preis' value=".$row['preis']." maxlength = '40'>
					
					<button type = 'reset'>Eingabe zurücksetzen</button>
					<button type = 'submit'>Speichern</button>
				</form>
				</div>
				<br>
				";
			}

			?>
			<a href = "ferienwohnungen.php">zurück</a>

			</figure>
		</article>
		<footer>
			<p>Der Abschluss der Seite</p>
		</footer>
	</body>
</html>