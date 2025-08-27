<!DOCTYPE html>
<html lang = "de">
<head>
	<meta charset = "utf-8">
	<title>My first PHP page </title>
</head>

<body>
	<h1>Hello World!</h1>
	<p>Your current date is:
	<?php
		echo date("d.m.Y H:i:s");
		
	?>.</p>
	<p>rechnen</p>
	<?php
		
		$zahl1 = 3;
		$ergebnis = ++$zahl1 *3;
		echo "Ergebnis:" .$ergebnis;
		$variable1 = $_GET['vorname'];
		$variable2 = $_GET['nachname'];
		echo "Hello".$variable1." ".$variable2."!";
		?>
</body>

</html>