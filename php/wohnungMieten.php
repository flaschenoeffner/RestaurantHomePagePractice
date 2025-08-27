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
		<article class= "rest">
		<?php
			$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
			if(!isset($_SESSION['username'])){
				die('Du nicht eingeloggt, bitte zuerst <a href="loginFrischeV.php">einloggen</a>');
			}
			
			
			$username = $_SESSION['username'];
			$ferienwohnung = $_GET['art'];
			$bezahlt = 0;
			$sql = "SELECT preis FROM ferienwohnung WHERE art = '$ferienwohnung'";
			$insert = TRUE;
			
			foreach($pdo->query($sql)as $row){
				$einzelpreis = $row['preis'];
			}
			$sql1 = "SELECT * FROM mieter WHERE username = '$username' AND bezahlt = 0";
			foreach($pdo->query($sql1)as $row){
				if($ferienwohnung===$row['ferienwohnung'])
					$insert = FALSE;
			}
			$ferienwohnung = str_replace('_',' ',$ferienwohnung);
				if($ferienwohnung=="Wohnen im Nichts"){
					echo"<h3>".$ferienwohnung."</h3>";
				}
				else
					echo"<h3>".$ferienwohnung." mieten</h3>";
		?>
		
		<div class = "formular">
		
		<?php
			
			if($insert == TRUE){
				$sql = "INSERT INTO mieter(username, ferienwohnung,einzelpreis, bezahlt) VALUES ('$username','$ferienwohnung','$einzelpreis','$bezahlt')";
				if($pdo->exec($sql)===1)
					echo "<form action = 'mieten.php?ferienwohnung=".$ferienwohnung."&einzelpreis=".$einzelpreis."' method = 'post'>";
			}
			else
				echo "<form action = 'mieten.php?ferienwohnung=".$ferienwohnung."&einzelpreis=".$einzelpreis."' method = 'post'>";
			?>
					<label for "personen">Personen:</label>
					<input type = "number" name = "personen" maxlength = "40">
				
					<label for "anfangdatum">Anfangdatum auswählen:</label>
					<input type = "date" name = "anfangdatum">
				
					<label for "enddatum">Enddatum auswählen:</label>
					<input type = "date" name = "enddatum">
				
					<button type = "reset">Zurücksetzen</button>
					<button type = "submit">Absenden</button>
					</form> 
				</div>
		<?php
			echo"<a href = 'abbrechen.php?ferienwohnung=".$ferienwohnung."'>abbrechen</a>";
		?>
		</article>
		<div class = "platz1"></div>
		<footer>
			<p>Der Abschluss der Seite</p>
		</footer>
	</body>
</html>