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
			<li>Ferienwohnung</li>
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
			<h1>Ferienwohnungen</h1>
			<p style="text-align:center">Das beste Erlebnis beim Vögeljagen</p>
			<figure class = "gesamt">
			
			<?php
			$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
			$sql= "SELECT*FROM ferienwohnung";
			foreach($pdo->query($sql)as $row){
				$art = str_replace('_',' ',$row['art']);
				/*echo $row['dateiname']."
				<a href = '../upload/".$row['dateiname']."'>bild</a>*/
				echo "
				<figure class = 'einzel'>
					<a href = 'wohnungMieten.php?art=".$row['art']."'><img src='../upload/".$row['dateiname']."' alt =".$row['art']."></a>
					
					<figcaption>".$art."</figcaption>
				</figure>
				";
			}
			$username = $_SESSION['username'];
			$sql3 = "SELECT * FROM login";
			
			echo "<br>";
			
			foreach($pdo->query($sql3) as $row){
				if($row['username']===$username&&$row['recht']==='admin'){
					echo "<a href='FWbearbeiten.php'><p style = 'text-align:center;'>bearbeiten</p></a>";
					echo "<a href='FWhinzufugen.php'><p style = 'text-align:center;'>Neue Angebote hinzufügen</p></a>";
				}
			}
			echo "<a href='bezahlteFWanzeigen.php'><p style = 'text-align:center;'>Meine Ferienwohnung anzeigen</p></a>";
			?>
			</figure>
		</article>
		<footer>
			<p>Der Abschluss der Seite</p>
		</footer>
	</body>
</html>