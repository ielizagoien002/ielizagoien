<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Quizzes</title>
    <link rel='stylesheet' type='text/css' href='../stylesPWS/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='../stylesPWS/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='../stylesPWS/smartphone.css' />
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
	<script type="text/javascript" src="Js/js.js"></script>

  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
    <?php 
	
		if(isset($_GET['erabiltzailea'])){
		$erab = $_GET['erabiltzailea'];
		
			echo '	<span class="right" style="display:none;"><a href="signUp.php">Erregistratu</a></span>
					<span class="right" style="display:none;"><a href="logIn.php">Saioa hasi</a></span>
					<span class="right" ><a name="lbl_user">Kaixo ' . $erab .  '</a></span>
					<span class="right" ><a href="logOut.php">Saioa itxi</a></span>
				 ';
		}
		else{
			
			echo '	<span class="right"><a href="signUp.php">Erregistratu</a></span>
					<span class="right"><a href="logIn.php">Saioa hasi</a></span>
					<span class="right" style="display:none;"><a name="lbl_user"></a></span>
					<span class="right" style="display:none;"><a>Saioa itxi</a></span>
				 ';
			
			
		}
		
	?>
	<h2>Quiz: crazy questions</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<?php 
		
			if(isset($_GET['erabiltzailea'])){
				$erab = $_GET['erabiltzailea'];
				
				echo '	<span><a href="layout.php?erabiltzailea=' . $erab . '">Home</a></span>
						<span><a href="addQuestionwithImage.php?erabiltzailea=' . $erab . '">Galdera gehitu</a></span>
						<span><a href="showQuestionswithImages.php?erabiltzailea=' . $erab . '">Galderak ikusi</a></span>
						<span><a href="showXMLQuestions.php?erabiltzailea=' . $erab . '">Galderak ikusi XML</a></span>
						<span><a>Quizzes</a></span>
						<span><a href="credits.php?erabiltzailea=' . $erab . '">Credits</a></span>';
			}
			
			else{
				echo '	<span><a href="layout.php">Home</a></span>
						<span><a>Quizzes</a></span>
						<span><a href="credits.php">Credits</a></span>
				';
			}
		?>
	</nav>
    <section class="main" id="s1">
    
	
	<div>
	<?php
		if(isset($_GET['erabiltzailea'])){
			echo '<form id="galderenF" action="addQuestionwithImage.php?erabiltzailea=' . $_GET['erabiltzailea'] . '" name="galderenF" method="POST" enctype="multipart/form-data">';
		}
		
		else echo '<form id="galderenF" action="addQuestionwithImage.php" name="galderenF" method="POST" enctype="multipart/form-data">';

	?>
	<form id="galderenF" action="addQuestionwithImage.php" name="galderenF" method="POST" enctype="multipart/form-data">
			<label>Eposta (*)</label>
			<?php 
				if(isset($_GET['erabiltzailea'])){
					echo '<input type="text" id="txt_eposta" name="txt_eposta" value="' . $_GET['erabiltzailea'] . '"/><br/>';
				}
				else{
					echo '<input type="text" id="txt_eposta" name="txt_eposta"/><br/>';
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
			
			<input type="submit" id="btn_bidali" value="Bidali"/>
	</form>
	<?php 
		if(isset($_GET['erabiltzailea'])){
			echo '<a href="layout.php?erabiltzailea=' . $_GET['erabiltzailea'] . '">';
		}
		
		else echo '<a href="layout.php">Itzuli</a>';
	?>
	
	
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>


<?php 

if(isset($_GET['erabiltzailea'])){
	
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
		if("" != trim($_FILES['f_irudia']['name'])){
			$irudia = addslashes(file_get_contents($_FILES['f_irudia']['tmp_name']));
		}
		/* Bestela balio nulua sartu datubasean (defektuzkoa) */
		else{
			$irudia = NULL;
		}
		$err_eposta = $err_zailtasuna = $err_beharrezkoak = "";

		/* Eposta egiaztatu*/

		$eposta_regEx = '/[a-z]{2,100}\d{3}@ikasle\.ehu\.e(s|us)$/';
		if(!preg_match($eposta_regEx, $eposta)){
			$err_eposta = 'Epostaren formatua ez da zuzena. ';
		}

		/* Zailtasuna egiaztatu */
		$zailtasuna_regEx = '/[1-5]$/';
		if(!preg_match($zailtasuna_regEx, $zailtasuna)){
			$err_zailtasuna = 'Zailtasunaren balioa ez da zuzena. ';
		}
		/* Beharrezko zelaiak bete direla ziurtatu */
		if("" == trim($testua) || "" == trim($erantzunZuzena) || "" == trim($erantzun_okerra_1) || "" == trim($erantzun_okerra_2) || "" == trim($erantzun_okerra_3) || "" == trim($gai_arloa)){
			$err_beharrezkoak = 'Ez da informazio guztia sartu. Mesedez begiratu arretaz eta ondo bete. ';
		}

		/* Irudia ez bada gehitu, NULL balioa sartu datubasan */
		if("" == trim($irudia)){
			$irudia = NULL;
		}
		/* Baldin erroreren bat badago balidazioekin, mezu bat erakutsi */
		if($err_eposta != "" || $err_zailtasuna != "" || $err_beharrezkoak != ""){
			echo '<a>' . $err_eposta . $err_zailtasuna . $err_beharrezkoak . ' </a>';
			exit;
		}
		/* Bestela datu basean sartu */
		else{
			/* Querya prestatu */
			$sql = "INSERT INTO questions (eposta, testua, erantzun_zuzena, erantzun_okerra_1, erantzun_okerra_2, erantzun_okerra_3, galderaren_zailtasuna, gai_arloa, irudia) 
			VALUES ('$eposta', '$testua', '$erantzunZuzena', '$erantzun_okerra_1', '$erantzun_okerra_2', '$erantzun_okerra_3', '$zailtasuna', '$gai_arloa', '{$irudia}')";

			if ($connection->query($sql) === TRUE) {
				echo  'Galdera gorde da!\n';
				echo  '<a href = "addQuestionwithImage.php?erabiltzailea=' . $eposta . '" >Beste galdera bat sartu.</a>\n';
				echo  '<a href = "showQuestionswithImages.php?erabiltzailea=' . $eposta . '" >Ikusi ze galdera dauden.</a>\n';
				
			} else{
				echo 'Error: ' . $sql . '<br/>' . $connection->error;
				echo '<p>Errorea egon da. Saiatu berriro galdera sartzen. <a href = "addQuestionwithImage.php?erabiltzailea=' . $eposta . '">Klikatu hemen.</a></p>';
				
			}
			
			/*XMLan gorde*/
			try{
				$galderakXML = simplexml_load_file("../xml/questions.xml");

				$assessmentItem = $galderakXML->addChild('assessmentItem');
				$assessmentItem->addAttribute('complexity', $zailtasuna);
				$assessmentItem->addAttribute('subject', $gai_arloa);

				$itemBody = $assessmentItem->addChild('itemBody');
				$p = $itemBody -> addChild('p',$testua);

				$correctResponse = $assessmentItem->addChild('correctResponse');
				$value = $correctResponse -> addChild('value',$erantzunZuzena);

				$incorrectResponses = $assessmentItem->addChild('incorrectResponses');
				$value1 = $incorrectResponses -> addChild('value',$erantzun_okerra_1);
				$value2 = $incorrectResponses -> addChild('value',$erantzun_okerra_2);
				$value3 = $incorrectResponses -> addChild('value',$erantzun_okerra_3);

				echo $galderakXML -> asXML("../xml/questions.xml");
				echo '<script language="javascript" type="text/javascript"> alert("XML txertaketa ondo egin da"); </script>';

			}catch(Exception $e){
				echo '<script language="javascript" type="text/javascript"> alert("Errorea XML txertaketan gertatu da"); </script>';
			}
		}
		$connection->close();
		
		
		 
		 echo '<a href = "layout.php?erabiltzailea=' . $eposta . '" >Hasierara itzuli</a>';
		 
		
	}
}


else{
	echo '<script>alert("Ezin da galderarik gehitu saioa hasi gabe");window.location.href="layout.php";</script>';
}
?> 