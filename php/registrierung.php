<?php
	session_start();
	$pdo = new PDO('mysql:host=localhost;dbname=praktikum','root','');
?>

<?php
$showFormular = true;

if(isset($_GET['reg'])){
	$error = false;
	$username = $_POST['username'];
	$email = $_POST['email'];
	$passwort = $_POST['passwort'];
	$passwort2 = $_POST['passwort2'];
	
	if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
		echo "Bitte eine gültge E-Mail-Addresse eingeben<br>";
		$error=true;
	}
	
	if(strlen($passwort) == 0){
		echo "Bitte eine gültige E-Mail-Addresse eingeben<br>";
		$error = true;
	}
	
	if($passwort != $passwort2){
		echo "Die Passwörter müssen übereinstimmen<br>";
		$error = true;
	}
	
	if(!$error){
		$statement = $pdo->prepare("SELECT * FROM login WHERE email = :email");
		$result = $statement->execute(array('email'=>$email));
		$user = $statement->fetch();
		
		if($user !== false){
			echo "Diese E-Mail-Addresse ist bereits vergeben<br>";
			$error = true;
		}
	}
	
	if(!$error){
		$statement = $pdo->prepare("SELECT * FROM login WHERE username = :username");
		$result = $statement-> execute(array('username' => $username));
		$user = $statement->fetch();
		
		if($user!=false){
			echo "Dieser Username ist schon vorhanden<br>";
			$error = true;
		}
	}
	
	if(!$error){
		$passwort_hash = password_hash($passwort,PASSWORD_DEFAULT);
		$statement = $pdo->prepare("INSERT INTO login(username,email,passwort)VALUES(:username,:email,:passwort)");
		$result = $statement->execute(array('email'=>$email,'username'=>$username,'passwort'=>$passwort_hash));
		
		if($result){
			echo 'Du wurdest erfolgreich registriert. <a href= "login.php"> Zum Login</a>';
			$showFormular = false;
		}
		else{
			echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
		}
	}
}

if($showFormular){
	
?>

<form action = "?reg=1" method = "post">
	Username:<br>
	<input type = "text" size = "40" maxlength="250" name="username"><br><br>
	
	Email:<br>
	<input type = "email" size = "40" maxlength="250" name="email"><br><br>
	
	Dein Passwort:<br>
	<input type = "password" size = "40" maxlength="250" name="passwort"><br><br>
	
	Passwort wiederholen:<br>
	<input type = "password" size = "40" maxlength="250" name="passwort2"><br><br>
	
	<input type = "submit" value = "abschicken">
</form>

<?php
}
?>

















