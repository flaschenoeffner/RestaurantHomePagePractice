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
			<li>Admin</li>
			<li><a href = "showlager_A.php">Lager bearbeiten</a></li>
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
			
			<?php
				if(isset($_GET['hinzuf'])){
					$gericht = $_POST['gericht'];
					$preis = $_POST['preis'];
					$menge = $_POST['menge'];
					
					$statement = $pdo->prepare("INSERT INTO lager(gericht,preis,menge)VALUES(:gericht,:preis,:menge)");
					$result = $statement->execute(array('gericht'=>$gericht,'preis'=>$preis,'menge'=>$menge));
		
					if($result){
						echo 'Neues Gericht wird erfolgreich hinzugefügt.<a href= "showlager_A.php"> Zurück zur Übersicht</a>';
					}
					else{
						echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
					}
				}
			?>

			<div class = "formular">
			<form action = "?hinzuf=1" method = "post">
			<label for "gericht">Neues Gericht:</label>
			<input type = "text" size = "40" maxlength="50" name="gericht"><br><br>
	
			<label for "preis">Preis:</label>
			<input type = "text" size = "40" maxlength="250" name="preis"><br><br>
	
			<label for "menge">Menge:</label>
			<input type = "number" size = "40" maxlength="250" name="menge"><br><br>
			
			<input type = "submit" value = "abschicken">
			</form>
			</div>
		</article>
		<div class = "platz1"></div>
		<footer>
			<p>Der Abschluss der Seite</p>
		</footer>
	</body>
</html>