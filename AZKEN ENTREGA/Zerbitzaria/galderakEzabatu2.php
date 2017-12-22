<?php
include 'konfigurazioa.php';
	$connection = new mysqli($servername, $username, $password, $dbname);
	
	
	if ($connection->connect_error)
		{
			
			die('Ez da datu basera ondo konektatu:'.$connection->connect_error);
			//exit();
		} 
	$galzenbaki=$_POST['zenbakia'];
	
	$galdera= $connection->query("DELETE FROM galderak WHERE GalderaZenbakia='".$galzenbaki."'");
	header("Location:galderaEzabatu.php");		
	mysqli_close($connection);
	?>