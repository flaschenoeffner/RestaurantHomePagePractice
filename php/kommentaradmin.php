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

				<div class = "formular1">
					<?php
						//$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
						$sql = "SELECT * FROM chat LEFT JOIN profil ON chat.username = profil.username ORDER BY chat.created_at DESC";
						foreach($pdo->query($sql) as $row){
							//echo "<img src=../upload/".$row['dateiname']." class ='profilepic'>";
							echo "<div class = 'comment'><img src=../upload/".$row['dateiname']." class ='profilepic'><strong>".$row['username'].
							"</strong><br><p>".$row['kommentar']." - - (".$row['created_at'].")<br><a href = 'delete.php?idchat=".$row['idchat']."'>
							delete comment</a></p></div>";
							
						}
					?>
				</div>
				<br>
				<div class = "formular1">
					<?php
					$sql2 ="SELECT * FROM profil";
					foreach($pdo->query($sql2) as $row){
						echo "<div class = 'comment'><img src=../upload/".$row['dateiname']." class = 'profilepic'><strong>".$row['username']."
						</strong><p><a href = 'profilupdate_A.php?username=".$row['username']."'>Profil ändern</a>
						<a href = 'deleteprofile_A.php?username=".$row['username']."'>Profil löschen</a>
						<a href = 'changepassword_A.php?username=".$row['username']."'>Passwort ändern</a></p></div>";
					}
					?>
				</div>
				
		</article>
		<div class = "platz1"></div>
		<footer>
			<p>Der Abschluss der Seite</p>
		</footer>
	</body>
</html>