

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
		<h4>Deine Bestellungen</h4>
			<?php
				session_start();
				$username = $_SESSION['username'];
				$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
				if(!isset($_SESSION['username'])){
				die('Du nicht eingeloggt, bitte zuerst <a href="loginFrischeV.php">einloggen</a>');
				}
			?>
			
		<?php
			$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
			$betrag=0;
			
			$sql3 = "SELECT MIN(bestellnummer) AS bestellnummerMin FROM warenkorb WHERE username = '$username'";
			$sql4 = "SELECT MAX(bestellnummer) AS bestellnummerMax FROM warenkorb WHERE username = '$username'";
			
			foreach($pdo->query($sql3) as $row){
				$bestellnummerMin=$row['bestellnummerMin'];
				}
			foreach($pdo->query($sql4) as $row){
				$bestellnummerMax=$row['bestellnummerMax'];
				}
			
			
			echo "<table>
					<tr>
					<th>bestellung</th>
					<th>menge</th>
					<th>gesamtpreis</th>
					<th>plz</th>
					<th>lieferort</th>
					<th>lieferaddresse</th>
					<th>Datum</th>
					</tr>";
			for($bestellnummer=$bestellnummerMin; $bestellnummer<= $bestellnummerMax;$bestellnummer++){
				
				$sql = "SELECT * FROM warenkorb WHERE bestellnummer = '$bestellnummer' AND username = '$username'";
				$sql5 = "SELECT gesamtpreis FROM warenkorb WHERE username = '$username'";
				$show = 1;
				foreach($pdo->query($sql) as $row){
					if ($show)
						echo"<br>";
					$show =0;
					$preis = str_replace('.', ',', $row['gesamtpreis']);
					echo "
					<tr>
					<td>".$row['bestellung']."</td>
					<td>".$row['bestellung_menge']."</td>
					<td>".$preis."€</td>
					<td>".$row['plz']."</td>
					<td>".$row['lieferort']."</td>
					<td>".$row['lieferaddresse']."</td>
					<td>".$row['created_at']."</td>
					</tr>
					
					";
				}
				echo "</table><table>";
				
				
			}
			echo"</table>";
			foreach($pdo->query($sql5) as $row1){
					$betrag = $betrag + $row1['gesamtpreis'];
				}
				$betrag = str_replace('.', ',', $betrag);
				echo "Gesamtbetrag: ".$betrag."€";
			?>
			
			
		</article>
		<div class = "platz1"></div>
		<footer>
			<p>Der Abschluss der Seite</p>
		</footer>
	</body>
</html>