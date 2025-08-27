<?php

					$pdo = new PDO('mysql:host=localhost;dbname=praktikum','root','');
					session_start();
					$username = $_SESSION['username'];
					$gericht_z = $_GET['gericht_z'];
					
					$sql = "DELETE FROM zwischenablage WHERE username='$username' AND gericht_z='$gericht_z'";
					$affected= $pdo->exec($sql);
					header('Location:zwischenablage_anzeigen.php');
				?>
