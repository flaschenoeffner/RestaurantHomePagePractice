<?php
				session_start();
				$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
			?>
			
			<?php
			
					$username = $_SESSION['username'];
					$gericht_z = $_GET['gericht'];
					$einzelpreis = $_GET['einzelpreis'];
					$gesamtpreis = $einzelpreis;
					$menge_anfangswert=1;
					$sql1 = "SELECT * FROM zwischenablage WHERE username = '$username' AND gericht_z = '$gericht_z'";
					$einfuegen = TRUE;
					
					foreach($pdo->query($sql1)as $row){
						if($gericht_z === $row['gericht_z']){
							$einfuegen = FALSE;							
							$menge1=$row['menge_z'];
							$neueMenge = $menge1+1;
							$gesamtpreis = $einzelpreis*$neueMenge;
							$sql2="UPDATE zwischenablage SET menge_z = '$neueMenge',gesamtpreis = '$gesamtpreis',updated_at=NOW() WHERE username = '$username'AND
							gericht_z = '$gericht_z'";
							if($pdo->exec($sql2)===1){
								header("Location: essen_preise.php");
							}
							
						}
						
					}
					
					$plz;
					$lieferort;
					$lieferaddresse;
					$sql="SELECT * FROM profil WHERE username ='$username'";
					foreach($pdo->query($sql)as $row){
						$plz = $row['plz'];
						$lieferaddresse = $row['strasse'];
						$lieferort = $row['ort'];
					}

					if($einfuegen===TRUE){
					$sql = "INSERT INTO zwischenablage(username,gericht_z,menge_z,einzelpreis,gesamtpreis,plz,lieferaddresse,lieferort)
					 VALUES('$username','$gericht_z',
					'$menge_anfangswert','$einzelpreis',
					'$gesamtpreis','$plz','$lieferaddresse','$lieferort')";
					
					if($pdo->exec($sql)===1){
						header("Location: essen_preise.php");
					}
					}
			?>
			