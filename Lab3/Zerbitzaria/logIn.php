<!DOCTYPE html>
<html>
	<head>
	</head>
	
	<body>
	
		<h2>Erabiltzaile identifikazioa </h2>
		
		<form method="POST" action="logIn.php" id="loginF">
			<fieldset>
				<legend>Identifikazio panela: </legend>
				
				<label>Eposta</label>
				<input type="text" id="txt_eposta" name="txt_eposta" /><br/><br/>
				<label>Pasahitza</label>
				<input type="password" id="pwd_pasahitza" name="pwd_pasahitza" /><br/><br/>
				<input type ="submit" id="btn_saioa_hasi" name="btn_saioa_hasi" value="Saioa hasi" />
			</fieldset>
		</form>
	
		<a href="layout.php">Itzuli hasierara</a>
	
	</body>
</html>

<?php

if(isset($_POST['txt_eposta'])){
	
	include 'konfigurazioa.php';
	
	$connection = new mysqli($servername, $username, $password, $dbname);

	if ($connection->connect_error) {
		die('Ezin izan da datubasea aurkitu: ['  . $connection->connect_error . ']');
	}
	$eposta = $_POST['txt_eposta'];
	$pasahitza = $_POST['pwd_pasahitza'];
	
	$sql = "SELECT * FROM users WHERE eposta = '$eposta' and pasahitza = '$pasahitza' ";
	$erantzuna = $connection->query($sql);
	
	if(!($erantzuna)){
		echo 'Arazoa queryan';
	}
	
	else{
		$errenk_kont = $erantzuna->num_rows;
		$connection->close();
		if($errenk_kont == 1){
			$errenk_kont = 0;
			$_GET['erabiltzailea'] = $eposta;
			//header('Location: layout.php?erabiltzailea=' . $_GET['erabiltzailea']); ZERBITZARIAN ARAZOAK EMAN DITU. 
			echo '<script>alert("Saioa ongi hasi da. ");window.location.href="layout.php?erabiltzailea=' . $_GET['erabiltzailea'] . '";</script>';
		} 
	}
	
}
	

?>