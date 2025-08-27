<?php
	session_start();
	$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
	$statement = $pdo->prepare("INSERT INTO profil(username,vorname,nachname,strasse,plz,ort,telefon,dateiname) VALUES(:username,:vorname,:nachname,:strasse,:plz,:ort,:telefon,:datei)");
	
	$statement->bindParam(':username',$username);
	$statement->bindParam(':vorname',$vorname);
	$statement->bindParam(':nachname',$nachname);
	$statement->bindParam(':strasse',$strasse);
	$statement->bindParam(':plz',$plz);
	$statement->bindParam(':ort',$ort);
	$statement->bindParam(':telefon',$telefon);
	$statement->bindParam(':datei',$datei);
	
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
	//echo 'Bild erfolgreich hochgeladen: <a href="'.$new_path.'">'.$new_path.'</a>';
	
	$username = $_SESSION['username'];
	$vorname = $_POST['vorname'];
	$nachname = $_POST['nachname'];
	$strasse = $_POST['strasse'];
	$plz = $_POST['plz'];
	$ort = $_POST['ort'];
	$telefon = $_POST['telefon'];
	$datei = $_FILES['datei']['name']; //
	
	if($statement->execute()){
		header("Location: profil.php"); 
	}
	?>
