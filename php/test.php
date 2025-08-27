<?php	
		$pdo = new PDO('mysql:host=localhost;dbname=praktikum;charset=utf8','root','');
			$sql = "SELECT * FROM books ORDER BY nachname";
	foreach ($pdo->query($sql) as $row){
		echo $row['vorname']. " " .$row['nachname']. "<br>";
		echo "Titel des Buches: ".$row['titel']. "<br>";
		echo "Beschreibung: ".$row['beschreibung']. "<br><br>";
	}
?>