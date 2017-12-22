<?php
session_start();
if (!isset($_SESSION['kautotua'])){
	$_SESSION['kautotua'] = "EZ";
}

if($_SESSION['kautotua'] != "BAI" || $_SESSION['rola'] !=1){
	echo 'Irakasle bezala saioa hasi gabe ezin da horri hau atzitu, hasi saioa irakasle bezala mesedez. ';
	exit();
}


if($_SESSION['kautotua'] == "BAI" && $_SESSION['rola'] == 1 && isset($_POST['txt_eposta'])){
	include 'konfigurazioa.php';
		$connection = new mysqli($servername, $username, $password, $dbname);

		if ($connection->connect_error) {
			die('Ezin izan da datubasea aurkitu: ['  . $connection->connect_error . ']');
			echo "EZ";
		}


		$eposta = $_POST['txt_eposta'];
		$testua = $_POST['txt_testua'];
		$erantzun_zuzena = $_POST['txt_erantzun_zuzena'];
		$erantzun_okerra_1 = $_POST['txt_erantzun_okerra_1'];
		$erantzun_okerra_2 = $_POST['txt_erantzun_okerra_2'];
		$erantzun_okerra_3 = $_POST['txt_erantzun_okerra_3'];
		$zailtasuna = $_POST['txt_zailtasuna'];
		$gai_arloa = $_POST['txt_gaia'];
		$id = $_POST['txt_identifikatzailea'];
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
		$zailtasuna_regEx = '[1-5]';
		if($zailtasuna < 1 || $zailtasuna > 5){
			$err_zailtasuna = 'Zailtasunaren balioa ez da zuzena. ';
		}
		/* Beharrezko zelaiak bete direla ziurtatu */
		if("" == trim($testua) || "" == trim($erantzun_zuzena) || "" == trim($erantzun_okerra_1) || "" == trim($erantzun_okerra_2) || "" == trim($erantzun_okerra_3) || "" == trim($gai_arloa)){
			$err_beharrezkoak = "Ez da informazio guztia sartu. Mesedez begiratu arretaz eta ondo bete. ";
		}

		/* Irudia ez bada gehitu, NULL balioa sartu datubasan */
		if("" == trim($irudia)){
			$irudia = NULL;
		}
		/* Baldin erroreren bat badago balidazioekin, mezu bat erakutsi */
		if($err_eposta != "" || $err_zailtasuna != "" || $err_beharrezkoak != ""){
			$err = $err_eposta . $err_zailtasuna . $err_beharrezkoak;
		}
		/* Bestela datu basean sartu */
		if(trim($err) == ""){
			/* Querya prestatu */
			$sql = "UPDATE questions SET 
						testua = '$testua', 
						erantzun_zuzena = '$erantzun_zuzena',
						erantzun_okerra_1 = '$erantzun_okerra_1',
						erantzun_okerra_2 = '$erantzun_okerra_2',
						erantzun_okerra_3 = '$erantzun_okerra_3',
						galderaren_zailtasuna = '$zailtasuna',
						gai_arloa = '$gai_arloa'
					WHERE id = '$id';";

			if ($connection->query($sql) === TRUE) {
				//echo  'Aldaketak gorde dira!\n';
			} else{
				//echo 'Error: ' . $sql . '<br/>' . $connection->error;
				//echo '<p>Errorea egon da. Saiatu berriro galdera aldatzen. <a href = "reviewingQuizes.php">Klikatu hemen.</a></p>';
				echo "Errorea datu basearekin konektatzean. ";
				
			}
			
			try{
			$xml = simplexml_load_file('../xml/questions.xml') or die("Error: Cannot create object");
				foreach ($xml->xpath('/assessmentItems/assessmentItem') as $assessmentItem) :
					if($_POST['txt_identifikatzailea'] == $assessmentItem['id']){
						$assessmentItem->itemBody->p = $_POST['txt_testua'];
						$assessmentItem->correctResponse->value = $_POST['txt_erantzun_zuzena'];
						$assessmentItem->incorrectResponses->value[0] = $_POST['txt_erantzun_okerra_1'];
						$assessmentItem->incorrectResponses->value[1] = $_POST['txt_erantzun_okerra_2'];
						$assessmentItem->incorrectResponses->value[2] = $_POST['txt_erantzun_okerra_3'];
						$assessmentItem['complexity'] = $_POST['txt_zailtasuna'];
						$assessmentItem['subject'] = $_POST['txt_gaia'];
					}
				endforeach; 

				$xml -> asXML("../xml/questions.xml");
				echo "BAI";
				
			}catch(Exception $e){
				//echo '<script language="javascript" type="text/javascript"> alert("Errorea gertatu da galdera aldaketa gordetzean. "); </script>';
				echo 'Errorea xml fitxategia atzitzean. ';
			}
		}
		
		
		else{
			echo  $err;
		}
		$connection->close();
		 
}

if(!isset($_POST['txt_eposta'])){
	echo '<script type="text/javascript" src="../Js/ajax.js"></script>
			<table style="margin:auto;" name="taulaGalderakEditatu" id="taulaGalderakEditatu">
				<tr>
					<th>Galderaren egilea</th>
					<th>Enuntziatua</th>
					<th>Erantzun zuzena</th>
					<th>Erantzun okerra 1</th>
					<th>Erantzun okerra 2</th>
					<th>Erantzun okerra 3</th>
					<th>Zailtasuna</th>
					<th>Gaia</th>
				</tr>
		';
				$xml = simplexml_load_file('../xml/questions.xml') or die("Error: Cannot create object");
				$kont = 1;
				foreach ($xml->xpath('/assessmentItems/assessmentItem') as $assessmentItem) :
					echo   '<tr id="' . $kont . '">
								<td><input id="txt_eposta" type="text" value="' . $assessmentItem['email'] . '" disabled="true" /></td>
								<td><input id="txt_testua" type="text" value="' . $assessmentItem->itemBody->p . '" disabled="true" class="editable"/></td>
								<td><input id="txt_erantzun_zuzena" type="text" value="' . $assessmentItem->correctResponse->value . '" disabled="true" class="editable" /></td>
								<td><input id="txt_erantzun_okerra_1" type="text" value="' . $assessmentItem->incorrectResponses->value[0] . '" disabled="true" class="editable" /></td>
								<td><input id="txt_erantzun_okerra_2" type="text" value="' . $assessmentItem->incorrectResponses->value[1] . '" disabled="true" class="editable" /></td>
								<td><input id="txt_erantzun_okerra_3" type="text" value="' . $assessmentItem->incorrectResponses->value[2] . '" disabled="true" class="editable" /></td>
								<td><input id="txt_zailtasuna" type="text" value="' . $assessmentItem['complexity'] . '" disabled="true" class="editable" /></td>
								<td><input id="txt_gaia" type="text" value="' . $assessmentItem['subject'] . '" disabled="true" class="editable" /></td>
								<td><input id="txt_identifikatzailea" type="text" value="' . $assessmentItem['id'] . '" style="display:none" /></td>
								<td><input type="button" value="Galdera editatu" class="btnGalderaEditatu" /></td>
								<td><input type="button" value="Galdera gorde" class="btnGalderaGorde" style="display:none"/></td>
							</tr>';
					$kont++;
				endforeach; 
				
				echo "</table>";
			}	
?>
		