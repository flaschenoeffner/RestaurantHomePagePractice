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
			<li>Lager bearbeiten</li>
			<li><a href = "showorders.php">Bestellungen anzeigen</a></li>
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

			<h1>Gerichte</h1>
			<table>
			<tr>
			<th>Gericht</th>
			<th>Bewertung</th>
			<th>Preise</th>
			<th>Menge</th>
			<th>ID</th>
			</tr>
			
			
		<?php
			$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
			$sql = "SELECT * FROM lager ORDER BY created_at DESC";
			foreach($pdo->query($sql) as $row){
			echo "
				
				<tr>
				<td>".$row['gericht']."</td>
				<td>".$row['bewertung']."/5 Sterne</td>
				<td>".$row['preis']."€</td>
				<td>".$row['menge']."</td>
				<td>".$row['id']."</td>
				</tr>
				
					";
			}
			?>
		</table>
			<br>
			
			<a href ="insertlager_A.php">Neues Gericht hinzufügen</a>
			<br><br>
			<h3> Tabelle bearbeiten</h3>
				
			<div class = "formular">
			<form action = "editlager_A.php" method = "post">
			
			<label for "id">ID:</label>
			<input type = "number" size = "40" maxlength="50" name="id"><br><br>
			
			<label for "gericht">Neuer Name:</label>
			<input type = "text" size = "40" maxlength="50" name="gericht"><br><br>
	
			<label for "preis">Neuer Preis:</label>
			<input type = "text" size = "40" maxlength="250" name="preis"><br><br>
	
			<label for "menge">Menge hinzufügen:</label>
			<input type = "number" size = "40" maxlength="250" name="menge"><br><br>
			
			<input type = "submit" value = "bestätigen">
			</form>
			</div>
			
		</article>
		<div class = "platz1"></div>
		<footer>
			<p>Der Abschluss der Seite</p>
		</footer>
	</body>
</html>