<!DOCTYPE html>
<html>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Sign up</title>
		<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
		<script type="text/javascript" src="../Js/js.js"></script>
		<script type="text/javascript" src="../Js/ajax.js"></script>
	</head>
	
	<body>
	
		<h2>Erabiltzaile erregistroa </h2>
		
		<form id="erregistratuF" method="POST" action="signUp.php" name="erregistratuF" enctype="multipart/form-data">
			<fieldset>
				<legend>Erregistro panela: </legend>
				<label>Eposta</label>
				<input type="text" id="txt_eposta" name="txt_eposta"/> &nbsp; <label name="lbl_balizkoEposta" id="lbl_balizkoEposta"></label><br/><br/>
				<label>Deitura </label>
				<input type="text" id="txt_deitura" name="txt_deitura"/><br/><br/>
				<label>Goitizena</label>
				<input type="text" id="txt_goitizena" name="txt_goitizena"/><br/><br/>
				<label>Pasahitza</label>
				<input type="password" id="pwd_pasahitza" name="pwd_pasahitza" />&nbsp;<label name="lbl_balizkoPasahitza" id="lbl_balizkoPasahitza"></label><br/><br/>
				<label>Pasahitza errepikatu</label>
				<input type="password" id="pwd_pasahitza2" name="pwd_pasahitza2" />&nbsp;<label name="lbl_balizkoPasahitza2" id="lbl_balizkoPasahitza2"></label><br/><br/>
				<label>Argazkia</label>
				<input type="file" id="f_argazkia" name="f_argazkia" /><br/><br/>
				<input type="submit" value="Erregistratu" id="btn_erregistratu" name="btn_erregistratu" disabled=true/>
			</fieldset>
		
		</form>
	
	
	
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
		$deitura = $_POST['txt_deitura'];
		$goitizena = $_POST['txt_goitizena'];
		$argazkia = NULL;
		if("" != trim($_FILES['f_argazkia']['name'])){
			$argazkia = addslashes(file_get_contents($_FILES['f_argazkia']['tmp_name']));
		}
		
		$sql = "INSERT INTO users (eposta, deitura, goitizena, pasahitza, irudia) 
				VALUES ('$eposta', '$deitura', '$goitizena', '$pasahitza','{$argazkia}')";
				
		
		if($connection->query($sql) === TRUE){
			echo '	<script type="text/javascript">
						alert("Kontua ongi erregistratu da. ");
						window.location.href = "layout.php";
					</script>';
			$connection->close();
		}
		
		else{
			echo '<a>Arazo bat izan da erregistroan, <a href="signUp.php"> saiatu berriro </a></a>';
		}
		
	}
	
	echo '<a href="layout.php">Itzuli hasierara</a>'
	

?>