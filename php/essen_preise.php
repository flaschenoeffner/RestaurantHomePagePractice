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
			<li>Gerichte & Preise</li>
			<li><a href = "kontakt_formular.php">Öffnungszeiten & Kontakt</a></li>
			<li><a href = "loginFrischeV.php">Login</a></li>
			<li><a href = "kommentar.php">Kommentare</a></li>
			<?php
					$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
					session_start();
					if(isset($_SESSION['username'])){
					
					$username = $_SESSION['username'];
					$sql3 = "SELECT * FROM login";
					
						foreach($pdo->query($sql3) as $row){
							if($row['username']===$username&&$row['recht']=='admin'){
								?>
			<li><a href = "kommentaradmin.php">Admin</a></li>
			<?php
							}
					}
			?>
			<?php

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
			<h1>Gerichte</h1>
		<table>
		<tr>
			<th>Gericht</th>
			<th>Bewertung</th>
			<th>Preise</th>
			</tr>
		<?php
			//$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
			$sql = "SELECT * FROM lager ORDER BY created_at DESC";
			foreach($pdo->query($sql) as $row){
				//$preis= strval($row['preis']);
				$preis = str_replace('.', ',', $row['preis']);
				//$bewertung = strval($row['bewertung']);
				$bewertung = str_replace('.',',',$row['bewertung']);
				
			echo "
				<tr>
				<td>".$row['gericht']."</td>
				<td>".$bewertung."/5 Sterne</td>
				<td>".$preis."€</td>";
			if(isset($_SESSION['username'])){
				echo "<td><a href='insert_into_zwischenablage.php?gericht=".$row['gericht']."&einzelpreis=".$row['preis']."'>in den Warenkorb</a></td>";
			}
			echo"</tr>";
			}
			?>
		</table>
		<br>
			<a href= "zwischenablage_anzeigen.php">Warenkorb ansehen</a>
		</article>
		<div class = "platz1"></div>
		<footer>
			<p>Der Abschluss der Seite</p>
		</footer>
	</body>
</html>