<?php
				session_start();
				$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
			?>
			
			<?php
			$zahlungsart = "";
			if(isset($_GET['paypal']))
				$zahlungsart = "paypal";
			if(isset($_GET['kreditkarte']))
				$zahlungsart = "kreditkarte";
			if(isset($_GET['frischeVfamilycard']))
				$zahlungsart = "frischeVfamilycard";
			if(isset($_GET['klarna']))
				$zahlungsart = "klarna";
			/*if(isset($_GET['abholzahlungsart']))
				$zahlungsart = "0";*/
			
			$username = $_SESSION['username'];
			$sql3 = "SELECT MAX(bestellnummer) AS bestellnummer FROM warenkorb";
			foreach($pdo->query($sql3) as $row){
				$bestellnummer=$row['bestellnummer'];
			}
			$bestellnummer+=1;
			
			$sql = "SELECT * FROM zwischenablage WHERE username = '$username'";
			foreach($pdo->query($sql) as $row){
				$bestellung = $row['gericht_z'];
				$bestellung_menge = $row['menge_z'];
				$gesamtpreis = $row['gesamtpreis'];
				$plz = $row['plz'];
				$lieferort = $row['lieferort'];
				$lieferaddresse = $row['lieferaddresse'];
				$sql1 = "INSERT INTO warenkorb(username,bestellung,bestellnummer,bestellung_menge,gesamtpreis,zahlungsart,plz,lieferort,lieferaddresse)
				VALUES('$username','$bestellung','$bestellnummer','$bestellung_menge','$gesamtpreis','$zahlungsart','$plz','$lieferort','$lieferaddresse')";
				
				if($pdo->exec($sql1)===1){
				echo "";
				
					$sql4 = "SELECT menge FROM lager WHERE gericht = '$bestellung'";
					foreach($pdo->query($sql4)as $row){
						$altemenge= $row['menge'];
					}
					
					$change = $bestellung_menge;
					$menge = $altemenge-$change;
					
					$sql = "UPDATE lager SET menge = '$menge', updated_at = NOW() WHERE gericht = '$bestellung'";
					if($pdo->exec($sql)==1)
					echo "";
				
				}
			}
			
			$sql2 = "DELETE FROM zwischenablage WHERE username = '$username'";
			$affected = $pdo->exec($sql2);
			
			?>
			
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
			<li><a href="essen_preise.php">Gerichte & Preise</a></li>
			<li><a href = "kontakt_formular.php">Öffnungszeiten & Kontakt</a></li>
			<li><a href = "loginFrischeV.php">Login</a></li>
			<li><a href = "kommentar.php">Kommentare</a></li>
			
			<?php
					if(isset($_SESSION['username'])){
					?>
			<li>Warenkorb</li>
			<li><a href = "profil.php">Profil</a></li>
			<li><a href = "logout.php">Log out</a></li>
			<?php
					}
				?>
			</ul>
		</nav>
		<article class= "rest">
			<?php
				echo"Bestellung erfolgreich abgeschlossen";
				?>
				
		</article>
		<div class = "platz1"></div>
		<footer>
			<p>Der Abschluss der Seite</p>
		</footer>
	</body>
</html>
			