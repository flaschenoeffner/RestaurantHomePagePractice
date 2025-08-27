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
			<li>Warenkorb</li>
			<li><a href = "profil.php">Profil</a></li>
			<li><a href = "logout.php">Log out</a></li>
			<?php
					}
				?>
			</ul>
		</nav>
		<article class= "rest">
			<h1>Dein Warenkorb</h1>
		<table>
		<tr>
			<th>Gericht</th>
			<th>Menge</th>
			<th></th>
			<th>Einzelpreis</th>
			<th>Gesamtpreis</th>
			<th></th>
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
				
				<td><a href='count_down.php?gericht_z=".$row['gericht_z']."&menge_z=".$row['menge_z']."&einzelpreis=".$row['einzelpreis']."'> - </a>
				<a href='count_up.php?gericht_z=".$row['gericht_z']."&menge_z=".$row['menge_z']."&einzelpreis=".$row['einzelpreis']."'> + </a></td>
				
				<td>".$einzelpreis."€</td>
				<td>".$gesamtpreis."€</td>
				<td><a href = 'aus_zwischenablage_entfernen.php?gericht_z=".$row['gericht_z']."'>aus Warenkorb entfernen</a></td>
				</tr>
					";
			}
			$sql5 = "SELECT gesamtpreis FROM zwischenablage WHERE username = '$username'";
			foreach($pdo->query($sql5) as $row1){
				$betrag = $betrag + $row1['gesamtpreis'];
				$betrag= sprintf('%.2f', $betrag);
				
			}
			$betrag = str_replace('.',',',$betrag);
			echo "<strong>Betrag: ".$betrag."€</strong>"
			?>
		</table>
		<?php
			echo"<a href='bestellen.php'><button>Bestellung bestätigen</button></a><br>";
			echo"<a href='showuserorders.php'>Meine Bestellungen</a>";
			
		?>
		</article>
		<div class = "platz1"></div>
		<footer>
			<p>Der Abschluss der Seite</p>
		</footer>
	</body>
</html>