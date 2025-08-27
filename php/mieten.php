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
		$formated_DATE = date('Y-m-d');
			session_start();
			$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
			$username = $_SESSION['username'];
			$personen = $_POST['personen'];
			$anfangdatum = $_POST['anfangdatum'];
			$enddatum = $_POST['enddatum'];
			if($enddatum<=$anfangdatum){
				die('Datum ungültig');
			}
			if($anfangdatum<$formated_DATE){
				die('Datum ungültig');
			}
			$betrag = 0;
			$nacht = 0;
			for($i = $anfangdatum;$i<$enddatum;$i++){
				$nacht++;
			}
			$nacht--;
			if($nacht==0)
				$nacht =1;
			$ferienwohnung = $_GET['ferienwohnung'];
			$ferienwohnung = str_replace(' ','_',$ferienwohnung);
			$einzelpreis = $_GET['einzelpreis'];
			$sql = "SELECT personenproFW FROM ferienwohnung WHERE art = '$ferienwohnung'";
			foreach($pdo->query($sql)as $row){
				$personenproFW = $row['personenproFW'];
			}
			$menge= $personen /$personenproFW;
			$menge = ceil($menge);
			$gesamtpreis = $menge * $einzelpreis * $nacht;
			$show= TRUE;
			
			$sql = "SELECT platz FROM ferienwohnung WHERE art = '$ferienwohnung'";
			foreach($pdo->query($sql)as $row){
				$platz = $row['platz'];
			}
			$sql="SELECT * FROM mieter WHERE anfangdatum<='$anfangdatum' AND bezahlt = 1 AND ferienwohnung='$ferienwohnung'
			OR enddatum>='$enddatum' AND bezahlt = 1 AND ferienwohnung='$ferienwohnung'";
			foreach($pdo->query($sql)as $row)
			{
				$platz-=$row['menge'];
			}
			//echo $platz;
			if($menge>$platz){
				echo "Nicht genug Plätze verfügbar! Es gibt nur noch ".$platz." Räume<br><a href = 'abbrechen.php'>zurück</a>";
			}
			else{
				
			$sql = "UPDATE mieter SET personen='$personen',anfangdatum='$anfangdatum',enddatum='$enddatum',ferienwohnung='$ferienwohnung',
			einzelpreis='$einzelpreis',menge='$menge',nacht='$nacht',gesamtpreis='$gesamtpreis', updated_at = NOW() WHERE username = '$username' AND ferienwohnung='$ferienwohnung' AND bezahlt= 0";
			if($pdo->exec($sql)===1){
				
				$sql1= "SELECT * FROM mieter WHERE username ='$username' AND bezahlt = 0 AND personen != 0";
				foreach($pdo->query($sql1)as $row){
					$gesamtpreis = str_replace('.',',',$row['gesamtpreis']);
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
					<td>".$gesamtpreis."€</td>
					</tr>";
					
					$betrag+=$row['gesamtpreis'];
				}
				
				$betrag= sprintf('%.2f', $betrag);
				$betrag = str_replace('.',',',$betrag);	
				echo "</table>";
				echo"<a href = 'ferienwohnungen.php'><h6 style ='text-align:center'>Weitere Angebote aussuchen</a> oder zahlen:</h6><br><p style ='text-align:center'>Betrag: ".$betrag."€</p>";
		?>
					<div class = "formular">
						<h1>Zahlungsartwählen</h1>
						<form action = "mietezahlen.php">
						
						<input type = "checkbox" name = "paypal" action = "?paypal=1">Paypal<br>

						<input type = "checkbox" name = "kreditkarte" action = "?kreditkarte=1">Kreditkarte<br>
						
						<input type = "checkbox" name = "klarna" action = "?klarna=1">Klarna<br>
						
						<input type = "checkbox" name = "frischeVfamilycard" action = "?frischeVfamilycard=1">Frische Vögel-Familienkarte<br>
						<button type = "reset">Eingabe zurücksetzen</button>
						 <a href = "mietezahlen.php"><button type = "submit">zahlen</button></a>
						</form> 
					</div>
		<?php
				}
			}
			
		?>
		</article>
		<div class = "platz1"></div>
		<footer>
			<p>Der Abschluss der Seite</p>
		</footer>
	</body>
</html>
