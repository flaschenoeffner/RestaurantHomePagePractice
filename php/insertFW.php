<?php
	session_start();
	$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
	//Alles zum Profilbild
		$upload_folder='../upload/';
		$filename = pathinfo($_FILES['datei']['name'],PATHINFO_FILENAME); //
		$extension = strtolower(pathinfo($_FILES['datei']['name'],PATHINFO_EXTENSION)); //
		
		$new_path = $upload_folder.$filename.'.'.$extension;
		
		if(file_exists($new_path)){
		$repeat=1;
		do{
			$new_path = $upload_folder.$filename.'_'.$repeat.'.'.$extension;
			$repeat++;
		}while(file_exists($new_path));
		}
	
		move_uploaded_file($_FILES['datei']['tmp_name'],$new_path); //
		echo 'Bild erfolgreich hochgeladen:<a href="'.$new_path.'">'.$new_path.'</a>';
	//
	$statement = $pdo->prepare("INSERT INTO ferienwohnung(dateiname,art,
	platz,personenproFW,preis)VALUES(?,?,?,?,?)");
	$statement->bindParam(1,$dateiname);
	$statement->bindParam(2,$art);
	$statement->bindParam(3,$platz);
	$statement->bindParam(4,$personen);
	$statement->bindParam(5,$preis);
	
	$dateiname = $_FILES['datei']['name'];
	$art = $_POST["art"];
	$platz = $_POST["platz"];
	$personen = $_POST["personen"];
	$preis = $_POST["preis"];
	if($statement->execute())
		  header("Location: ferienwohnungen.php");  
	?>
