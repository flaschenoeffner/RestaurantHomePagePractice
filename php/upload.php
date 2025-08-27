<?php
	//if(isset($_GET['upload'])){
		$pdo = new PDO('mysql:host=localhost;dbname=praktikum','root','');
		$upload_folder='../upload/';
		$filename = pathinfo($_FILES['datei']['name'],PATHINFO_FILENAME);
		$extension = strtolower(pathinfo($_FILES['datei']['name'],PATHINFO_EXTENSION));
		
		$new_path = $upload_folder.$filename.'.'.$extension;
		
		if(file_exists($new_path)){
			$id=1;
			do{
				$new_path = $upload_folder.$filename.'_'.$id.'.'.$extension;
				$id++;
			}
			while(file_exists($new_path));
		}
	//}
	move_uploaded_file($_FILES['datei']['tmp_name'],$new_path);
	echo 'Bild erfolgreich hochgeladen: <a href="'.$new_path.'">'.$new_path.'</a>';
	
	$dateiname = $_FILES['datei']['name'];
	$username = $_POST['username'];
	
	$statement = $pdo->prepare("INSERT INTO bilder (username,dateiname) VALUES(:username,:dateiname)");
	$statement->bindParam(':username',$username);
	$statement->bindParam(':dateiname',$dateiname);
	
	if($statement->execute()){
		echo "<br>Neues Bild wurde angelegt";
	}
?>