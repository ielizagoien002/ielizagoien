<?php
ini_set('session.cookie_lifetime', 30);
session_start();
if (!isset($_SESSION['kautotua'])){
	$_SESSION['kautotua'] = "EZ";
}
if($_SESSION['kautotua']=="EZ"){
	echo '<script>alert("Saioa hasi gabe ezin da horri hau atzitu, hasi saioa mesedez. ");window.location.href="layout.php"</script>';
	exit();
}
?>
<form id="galderenF" name="galderenF" method="POST" enctype="multipart/form-data">
	<?php
		if(isset($_SESSION['eposta'])){
			echo '<input type="hidden" id="txt_eposta" name="txt_eposta" value="' . $_SESSION['eposta'] . '" />';
		}
	?>
	<label>Testua (*)</label>
	<input type="text" id="txt_testua"name="txt_testua"/><br/>
	<label>Erantzun zuzena (*)</label>
	<input type="text" id="txt_erantzun_zuzena" name="txt_erantzun_zuzena"/><br/>
	<label>Erantzun okerra 1 (*)</label>
	<input type="text" id="txt_erantzun_okerra_1" name="txt_erantzun_okerra_1"/><br/>
	<label>Erantzun okerra 2 (*)</label>
	<input type="text" id="txt_erantzun_okerra_2" name="txt_erantzun_okerra_2"/><br/>
	<label>Erantzun okerra 3 (*)</label>
	<input type="text" id="txt_erantzun_okerra_3" name="txt_erantzun_okerra_3"/><br/>
	<label>Galderaren zailtasuna (1 eta 5 artekoa) (*) </label>
	<input type="text" id="txt_zailtasuna" name="txt_zailtasuna"/><br/>
	<label>Gai-arloa (*)</label>
	<input type="text" id="txt_gai_arloa" name="txt_gai_arloa"/><br/>
	<label>Galderarekin zerikusia duen irudia</label>
	<input type="file" id="f_irudia" name="f_irudia"/><br/>
</form>
<a href="layout.php">Itzuli</a>

	
<?php 

if($_SESSION['kautotua'] == "BAI"){
	if(isset($_POST['txt_eposta'])){
		include 'konfigurazioa.php';
		$connection = new mysqli($servername, $username, $password, $dbname);

		if ($connection->connect_error) {
			die('Ezin izan da datubasea aurkitu: ['  . $connection->connect_error . ']');
		}


		$eposta = $_POST['txt_eposta'];
		$testua = $_POST['txt_testua'];
		$erantzunZuzena = $_POST['txt_erantzun_zuzena'];
		$erantzun_okerra_1 = $_POST['txt_erantzun_okerra_1'];
		$erantzun_okerra_2 = $_POST['txt_erantzun_okerra_2'];
		$erantzun_okerra_3 = $_POST['txt_erantzun_okerra_3'];
		$zailtasuna = $_POST['txt_zailtasuna'];
		$gai_arloa = $_POST['txt_gai_arloa'];
		/* Irudia aukeratu bada, temporala aldagaiean gorde datu basera igotzeko */
		/*
		if("" != trim($_FILES['f_irudia']['name'])){
			$irudia = addslashes(file_get_contents($_FILES['f_irudia']['tmp_name']));
		}
		*/
		/* Bestela balio nulua sartu datubasean (defektuzkoa) */
		//else{
			$irudia = NULL;
		//}
		$err_eposta = $err_zailtasuna = $err_beharrezkoak = $err = "";

		/* Eposta egiaztatu*/
		
		$eposta_regEx = '/[a-z]{2,100}\d{3}@(ikasle\.)?ehu\.e(s|us)$/';
		if(!preg_match($eposta_regEx, $eposta)){
			$err_eposta = 'Epostaren formatua ez da zuzena. ';
		}

		/* Zailtasuna egiaztatu */
		$zailtasuna_regEx = '/[1-5]/';
		if(1 != preg_match($zailtasuna_regEx, $zailtasuna)){
			$err_zailtasuna = 'Zailtasunaren balioa ez da zuzena. ';
		}
		/* Beharrezko zelaiak bete direla ziurtatu */
		if("" == trim($testua) || "" == trim($erantzunZuzena) || "" == trim($erantzun_okerra_1) || "" == trim($erantzun_okerra_2) || "" == trim($erantzun_okerra_3) || "" == trim($gai_arloa)){
			$err_beharrezkoak = "Ez da informazio guztia sartu. Mesedez begiratu arretaz eta ondo bete. ";
		}

		/* Irudia ez bada gehitu, NULL balioa sartu datubasan */
		if("" == trim($irudia)){
			$irudia = NULL;
		}
		/* Baldin erroreren bat badago balidazioekin, mezu bat erakutsi */
		if($err_eposta != "" || $err_zailtasuna != "" || $err_beharrezkoak != ""){
			$err = $err_eposta . $err_zailtasuna . $err_beharrezkoak;
			echo '<a>' . $err . ' </a>';
		}
		/* Bestela datu basean sartu */
		if(trim($err) == ""){
			/* Querya prestatu */
			$sql = "INSERT INTO questions (eposta, testua, erantzun_zuzena, erantzun_okerra_1, erantzun_okerra_2, erantzun_okerra_3, galderaren_zailtasuna, gai_arloa, irudia) 
			VALUES ('$eposta', '$testua', '$erantzunZuzena', '$erantzun_okerra_1', '$erantzun_okerra_2', '$erantzun_okerra_3', '$zailtasuna', '$gai_arloa', '{$irudia}')";
			$id = 0;
			if ($connection->query($sql) === TRUE) {
				$sql="SELECT id FROM questions ORDER BY id DESC LIMIT 0, 1";
				$erantzuna = $connection->query($sql);
				$row = $erantzuna->fetch_assoc();
				$id = $row['id'];
				$connection->query($sql);
				echo  'Galdera gorde da!\n';
			} else{
				echo 'Error: ' . $sql . '<br/>' . $connection->error;
				echo '<p>Errorea egon da. Saiatu berriro galdera sartzen. <a href = "handlingQuizes.php">Klikatu hemen.</a></p>';
				
			}
			
			try{
			$galderakXML = simplexml_load_file("../xml/questions.xml");

			$assessmentItem = $galderakXML->addChild('assessmentItem');
			$assessmentItem->addAttribute('complexity', $zailtasuna);
			$assessmentItem->addAttribute('subject', $gai_arloa);
			$assessmentItem->addAttribute('email', $eposta);
			$assessmentItem->addAttribute('id', $id);

			$itemBody = $assessmentItem->addChild('itemBody');
			$p = $itemBody -> addChild('p',$testua);

			$correctResponse = $assessmentItem->addChild('correctResponse');
			$value = $correctResponse -> addChild('value',$erantzunZuzena);

			$incorrectResponses = $assessmentItem->addChild('incorrectResponses');
			$value1 = $incorrectResponses -> addChild('value',$erantzun_okerra_1);
			$value2 = $incorrectResponses -> addChild('value',$erantzun_okerra_2);
			$value3 = $incorrectResponses -> addChild('value',$erantzun_okerra_3);

			echo $galderakXML -> asXML("../xml/questions.xml");
			echo '<script language="javascript" type="text/javascript"> alert("Txertaketa ondo egin da"); </script>';

			}catch(Exception $e){
				echo '<script language="javascript" type="text/javascript"> alert("Errorea gertatu da"); </script>';
			}
		}
		else{
			echo '<script>alert("' . $err . '");</script>';
		}
		$connection->close();
		 
		 echo '<a href = "layout.php" >Hasierara itzuli</a>';
		 
		 
	}
}


else{
	echo '<script>alert("Ezin da galderarik gehitu saioa hasi gabe");window.location.href="layout.php";</script>';
}
?> 