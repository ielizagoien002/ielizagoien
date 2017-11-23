<?php
	include 'konfigurazioa.php';
	$connection = new mysqli($servername, $username, $password, $dbname);
	
	if ($connection->connect_error)
		{
			die('Ez da datu basera ondo konektatu:'.$connection->connect_error);
		} 
		$pos=$_POST['txt_eposta_berria'];
		$galzen=$_POST['galdeZenbaki'];
		$galBerria=$_POST['txt_testua_berria'];
		$erantzunBerria=$_POST['txt_erantzun_berria'];
		$zailtasunBerria=$_POST['txt_zailtasuna_berria'];
		$gaiBerria=$_POST['txt_gai_arloa_berria'];
		
			echo $galzen;
		$sql ="DELETE from questions WHERE GalderaZenbakia='".$galzen."'"; 
		if (!$connection -> query($sql)){
					die("<p>Errorea gertatu da: ".$connection -> error ."</p>");
				}else{
					$sqli="INSERT INTO guestions (GalderaZenbakia,eposta,testua,erantzun_zuzena,galderaren_zailtasuna,gai_arloa,irudia)VALUES('$galzen','$pos','$galBerria','$erantzunBerria','$zailtasunBerria','$gaiBerria')";
					if (!$connection -> query($sqli))
					die("<p>Errorea gertatu da: ".$connection -> error ."</p>");
					else
						echo'Galdera zuzen aldatu da.';
						header ("Location:reviewingQuizes.php");
				}
	
		
	mysqli_close($connection);
?>