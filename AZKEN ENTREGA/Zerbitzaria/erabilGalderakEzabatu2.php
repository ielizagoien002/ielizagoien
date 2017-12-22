<?php
include 'konfigurazioa.php';
		$connection = new mysqli($servername, $username, $password, $dbname);

	
	if ($connection->connect_error)
		{
			
			die('Ez da datu basera ondo konektatu:'.$connection->connect_error);
			//exit();
		} 
	$emaila=$_POST['emaila'];
	//echo($emaila);
	$ezabatu= $connection->query("DELETE FROM galderak WHERE Eposta='".$emaila."'");
	header("Location:erabilGalderakEzabatu.php");		
	mysqli_close($connection);
	?>