<?php
					session_start();
					$pdo = new PDO('mysql:host=localhost;dbname=praktikum','root','');
					
					//Alles zum Profilbild
					$upload_folder='../upload/';
					$filename = pathinfo($_FILES['datei']['name'],PATHINFO_FILENAME); //
					$extension = strtolower(pathinfo($_FILES['datei']['name'],PATHINFO_EXTENSION)); //
		
					$new_path = $upload_folder.$filename.'.'.$extension;
		
					if(file_exists($new_path)){
					$id=1;
					do{
					$new_path = $upload_folder.$filename.'_'.$id.'.'.$extension;
					$id++;
					}
					while(file_exists($new_path));
					}
	
					move_uploaded_file($_FILES['datei']['tmp_name'],$new_path); //
					
					$username = $_SESSION['username'];
					$vorname = $_POST["vorname"];
					$nachname = $_POST["nachname"];
					$strasse = $_POST["strasse"];
					$plz = $_POST["plz"];
					$ort = $_POST["ort"];
					$telefon = $_POST["telefon"];
					$datei = $_FILES['datei']['name']; 
					
					$sql = "UPDATE profil SET vorname = '$vorname', nachname = '$nachname',
					strasse = '$strasse',plz = '$plz',ort = '$ort',telefon = '$telefon', dateiname = '$datei',
					updated_at = NOW() WHERE username = '$username'";
					if($pdo->exec($sql)==1)
						header("Location: profil.php");  
				?>
