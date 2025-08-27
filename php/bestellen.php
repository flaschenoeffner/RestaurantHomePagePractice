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
					session_start();
					$username = $_SESSION['username'];
					$pdo = new PDO('mysql:host=localhost;dbname=praktikum','root','');
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
			<div class = "container">
			
			<div class = "lieferAbholForm1">
			<h4><a href = "?liefern=1">Liefern</a></h4>
			</div>
			
			<div class = "lieferAbholForm2">
			<h4><a href = "?abholen=1">Abholen</a></h4>
			</div>
			</div>
			<?php
			if(isset($_GET['liefern'])){
				?>
			<div class = "lieferAbholForm">
					<h1>Liefern</h1>
					<form action = "zahlung.php" method ="post">
					<?php
					
					$statement = $pdo->prepare("SELECT * FROM profil WHERE username = :username");
					$result = $statement->execute(array('username'=>$username));
					$user= $statement->fetch();
					if($user !== false){
						
					$plz;
					$lieferort;
					$lieferaddresse;
					$sql="SELECT * FROM profil WHERE username ='$username'";
					foreach($pdo->query($sql)as $row){
						$plz = $row['plz'];
						$lieferaddresse = $row['strasse'];
						$lieferort = $row['ort'];
					}
					/*$sql = "INSERT INTO zwischenablage(plz,lieferort,lieferaddresse)VALUES('$plz','$lieferort','$lieferaddresse')";
					if($pdo->exec($sql)===1)*/
					echo"
						<label for = 'plz'>Postleitzahl</label>
						<input type = 'number' name = 'plz' id = 'plz' maxlength = '40' value = ".$plz.">
						
						<label for = 'lieferort'>Lieferort</label>
						<input type = 'text' name = 'lieferort' id = 'lieferort' maxlength = '40' value =".$lieferort.">
						
						<label for = 'lieferaddresse'>Lieferaddresse</label>
						<input type = 'text' name = 'lieferaddresse' id = 'lieferaddresse' maxlength = '40' value = ".$lieferaddresse.">
					";
					}
					else{
						echo"
						<label for = 'plz'>Postleitzahl</label>
						<input type = 'number' name = 'plz' id = 'plz' maxlength = '40'>
						
						<label for = 'lieferort'>Lieferort</label>
						<input type = 'text' name = 'lieferort' id = 'lieferort' maxlength = '40'>
						
						<label for = 'lieferaddresse'>Lieferaddresse</label>
						<input type = 'text' name = 'lieferaddresse' id = 'lieferaddresse' maxlength = '40'>
					";
					}
					?>
						<!---<label for = "nachricht">Nachricht</label>
						<textarea name = "nachricht" id = "nachricht"></textarea>-->
						
						<label for = "produkt">Produkte</label>
						<table>
							<tr>
							<th>Gericht</th>
							<th>Menge</th>
							<th>Einzelpreis</th>
							<th>Gesamtpreis</th>
							</tr>
						<?php
							$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
							$username = $_SESSION['username'];
							$betrag = 0;
							$sql = "SELECT * FROM zwischenablage WHERE username = '$username'";
							foreach($pdo->query($sql) as $row){
								$einzelpreis = str_replace('.', ',', $row['einzelpreis']);
								$gesamtpreis = str_replace('.', ',', $row['gesamtpreis']);
								echo "
								<tr>
								<td>".$row['gericht_z']."</td>
								<td>".$row['menge_z']."</td>
								<td>".$einzelpreis."€</td>
								<td>".$gesamtpreis."€</td>
								</tr>
								";
							}
							$sql5 = "SELECT gesamtpreis FROM zwischenablage WHERE username = '$username'";
							foreach($pdo->query($sql5) as $row1){
								$betrag = $betrag + $row1['gesamtpreis'];
								$betrag= sprintf('%.2f', $betrag);
							}
							
                
							?>
							
						</table>
						<label>
						<?php
							$betrag = str_replace('.',',',$betrag);
							echo "Zwischenbetrag: ".$betrag."€";
						?>
						</label><br>
						<label>Lieferkosten: 2€</label><br>
					
						
						
						<button type = "reset">Eingabe zurücksetzen</button>
						 <button type = "submit">bezahlen</button>
					</form> 
			</div>
			<?php
			}
			?>
			
			<?php
			if(isset($_GET['abholen'])){
				?>
			<div class = "lieferAbholForm">
					<h1>Abholen</h1>
					<form id = "person" action = "confirm.php?abholzahlungsart=1" method ="post">
						
						
						<label for = "produkt">Produkte</label>
						<table>
							<tr>
							<th>Gericht</th>
							<th>Menge</th>
							<th>Einzelpreis</th>
							<th>Gesamtpreis</th>
							</tr>
						<?php
							$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
							$username = $_SESSION['username'];
							$betrag = 0;
							$sql = "SELECT * FROM zwischenablage WHERE username = '$username'";
							foreach($pdo->query($sql) as $row){
								$einzelpreis = str_replace('.', ',', $row['einzelpreis']);
								$gesamtpreis = str_replace('.', ',', $row['gesamtpreis']);
								echo "
								<tr>
								<td>".$row['gericht_z']."</td>
								<td>".$row['menge_z']."</td>
								<td>".$einzelpreis."€</td>
								<td>".$gesamtpreis."€</td>
								</tr>
								";
							}
							$sql5 = "SELECT gesamtpreis FROM zwischenablage WHERE username = '$username'";
							foreach($pdo->query($sql5) as $row1){
								$betrag = $betrag + $row1['gesamtpreis'];
								$betrag= sprintf('%.2f', $betrag);
								$betrag = str_replace('.',',',$betrag);
							}
							
							?>
						</table>
						<label>
						<?php
							echo "Zwischenbetrag: ".$betrag."€";
						?>
						</label>
						<br><br>
						
						<button type = "reset">Eingabe zurücksetzen</button>
						 <button type = "submit">bestätigen</button>
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