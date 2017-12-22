<?php
session_start();
if (!isset($_SESSION['kautotua'])){
	$_SESSION['kautotua'] = "EZ";
}
?>
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
	$erantzuna = $connection->query($sql, MYSQLI_STORE_RESULT);
	
	
	if($erantzuna->num_rows == 0){
		echo 'Erabiltzaile edo pasahitz okerrak';
	}
	
	else{
		$errenk_kont = $erantzuna->num_rows;
		$connection->close();
		$row = $erantzuna->fetch_assoc();
		$_SESSION['eposta'] = $eposta;
		$_SESSION['kautotua'] = "BAI";
		$_SESSION['rola'] = $row['rola'];
		
		if($_SESSION['rola'] == 0) echo '<script>alert("Ikasle saioa ongi hasi da. ");window.location.href="handlingQuizes.php"</script>';
		if($_SESSION['rola'] == 1) echo '<script>alert("Irakasle saioa ongi hasi da. ");window.location.href="reviewingQuizes.php"</script>';
		 
	}
	
}
	

?>