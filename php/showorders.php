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
			<li>Bestellungen anzeigen</li>
			<li><a href = "loginFrischeV.php">Login</a></li>
			<li><a href = "kommentar.php">Kommentare</a></li>
			<li><a href = "zwischenablage_anzeigen.php">Warenkorb</a></li>
			<li><a href = "profil.php">Profil</a></li>
			<li><a href = "logout.php">Log out</a></li>
			</ul>
		</nav>
		<article class = "rest">
			<?php
				session_start();
				$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
				if(!isset($_SESSION['username'])){
				die('Du nicht eingeloggt, bitte zuerst <a href="loginFrischeV.php">einloggen</a>');
				}
				$username = $_SESSION['username'];
				$sql3 = "SELECT * FROM login";
					
				foreach($pdo->query($sql3) as $row){
					if($row['username']===$username&&$row['recht']!=='admin')
					die('Du bist kein admin');
					}
					
			?>

			<!--<h1>Bestellungen</h1>
			<table>
			<tr>
			<th>Gericht</th>
			<th>Bewertung</th>
			<th>Preise</th>
			<th>Menge</th>
			<th>ID</th>
			</tr>-->
			
			
		<?php
			$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
			
			//$sql = "SELECT * FROM warenkorb WHERE bestellnummer = '$bestellnummer'";
			$sql3 = "SELECT MIN(bestellnummer) AS bestellnummerMin FROM warenkorb";
			$sql4 = "SELECT MAX(bestellnummer) AS bestellnummerMax FROM warenkorb";
			
			foreach($pdo->query($sql3) as $row){
				$bestellnummerMin=$row['bestellnummerMin'];
				}
			foreach($pdo->query($sql4) as $row){
				$bestellnummerMax=$row['bestellnummerMax'];
				}
				
			for($bestellnummer=$bestellnummerMin; $bestellnummer<= $bestellnummerMax;$bestellnummer++){
				$betrag=0;
				$sql = "SELECT * FROM warenkorb WHERE bestellnummer = '$bestellnummer'";
				$sql5 = "SELECT gesamtpreis FROM warenkorb WHERE bestellnummer = '$bestellnummer'";
				echo "<table>
					<tr>
					<th>username</th>
					<th>bestellung</th>
					<th>menge</th>
					<th>gesamtpreis</th>
					</tr>";
				foreach($pdo->query($sql) as $row){
				
					echo "
					<tr>
					<td>".$row['username']."</td>
					<td>".$row['bestellung']."</td>
					<td>".$row['bestellung_menge']."</td>
					<td>".$row['gesamtpreis']."€</td>
					</tr>
					
					";
				}
				echo "</table>";
				
				foreach($pdo->query($sql5) as $row1){
					$betrag = $betrag + $row1['gesamtpreis'];
				}
				echo "<strong>Betrag: ".$betrag."€</strong>
				<a href = 'delete_orders.php?bestellnummer=".$bestellnummer."'>geliefert</a><br><br>";
			}
			?>
		<!--</table>-->
			
			
		</article>
		<div class = "platz1"></div>
		<footer>
			<p>Der Abschluss der Seite</p>
		</footer>
	</body>
</html>