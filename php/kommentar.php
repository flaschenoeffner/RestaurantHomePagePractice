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
			<li>Kommentare</li>
			<?php 
				session_start();
					if(isset($_SESSION['username'])){
						$username = $_SESSION['username'];
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
					/*session_start();
					if(!isset($_SESSION['username'])){
					die('Bitte zuerst <a href="loginFrischeV.php">einloggen</a>');
					}

					$username = $_SESSION['username'];

					echo "Hallo ".$username;*/
				?>

				<?php 
					if(isset($_SESSION['username'])){
						$username = $_SESSION['username'];
						echo "Hallo ".$username;
						?>
					<div class = "formular">
					<h1>Kommentar veröffentlichen</h1>
					<form id = "person" action = "kommentar1.php" method ="post">
						<!--<label for = "username">Name</label>
						<input type = "text" name = "username" id = "username" maxlength = "40">-->
						
						<label for = "comment">Kommentar</label>
						<textarea name = "comment" id = "comment"></textarea>
						
						<button type = "reset">Eingabe zurücksetzen</button>
						 <button type = "submit">Absenden</button>
					</form> 
					</div>
					<?php
					}
					?>
				
				
				<br>
				<div class = "formular1">
					<?php
						$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
						$sql = "SELECT * FROM chat LEFT JOIN profil ON chat.username = profil.username ORDER BY chat.created_at DESC";
						foreach($pdo->query($sql) as $row){
							//echo "<img src=../upload/".$row['dateiname']." class ='profilepic'>";
							echo "<div class = 'comment'><img src=../upload/".$row['dateiname']." class ='profilepic'><strong>".$row['username'].
							"</strong><br><p>".$row['kommentar']." - - (".$row['created_at'].")</p></div><br>";
						}
					?>
				</div>
				<a href= "kommentaradmin.php" style= "font-size:50%;">Kommentare bearbeiten wenn Sie admin sind</a>
		</article>
		<div class = "platz1"></div>
		<footer>
			<p>Der Abschluss der Seite</p>
		</footer>
	</body>
</html>