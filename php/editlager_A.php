<?php

					$pdo = new PDO('mysql:host=localhost;dbname=praktikum','root','');
					$id = $_POST['id'];
					$gericht = $_POST['gericht'];
					$preis = $_POST['preis'];
					
					$sql1 = "SELECT menge FROM lager WHERE id = '$id'";
					foreach($pdo->query($sql1)as $row){
						$altemenge= $row['menge'];
					}
					
					$add = $_POST['menge'];
					$menge = $add + $altemenge;
					
					$sql = "UPDATE lager SET gericht = '$gericht', preis = '$preis',
					menge = '$menge', updated_at = NOW() WHERE id = '$id'";
					if($pdo->exec($sql)==1)
						header("Location: showlager_A.php");
				?>
