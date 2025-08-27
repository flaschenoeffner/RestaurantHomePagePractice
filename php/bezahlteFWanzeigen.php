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
			$show= TRUE;

				$sql1= "SELECT * FROM mieter WHERE username ='$username' AND bezahlt = 1";
				foreach($pdo->query($sql1)as $row){
					$gesamtpreis=str_replace('.',',',$row['gesamtpreis']);
					if($show){
					echo"<table>
						<tr>
						<th>Personen</th>
						<th>Anzahl der Wohnungen</th>
						<th>Ferienwohnung</th>
						<th>Datum</th>
						<th>Nächte</th>
						<th>Gesamtpreis</th>
						</tr>";
					}
					$show=FALSE;
					echo"<tr>
					<td>".$row['personen']."</td>
					<td>".$row['menge']."</td>
					<td>".$row['ferienwohnung']."</td>
					<td>".$row['anfangdatum']." bis ".$row['enddatum']."</td>
					<td>".$row['nacht']."</td>
					<td>".$gesamtpreis."</td>
					</tr>";
				}
				echo "</table>";
				
		?>
		</article>
		<div class = "platz1"></div>
		<footer>
			<p>Der Abschluss der Seite</p>
		</footer>
	</body>
</html>
