<?php

					$pdo = new PDO('mysql:host=localhost;dbname=praktikum','root','');
					session_start();
					$bestellnummer = $_GET['bestellnummer'];
					
					
					$sql = "DELETE FROM warenkorb WHERE bestellnummer='$bestellnummer'";
					$affected= $pdo->exec($sql);
					header('Location:showorders.php');
				?>
