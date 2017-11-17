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
		<ul id="ul_garatzailea_1" style="vertical-align:left">
			<li>Deiturak: Itsaso Elizagoien</li>
			<li>Espezialitatea: </li>
			<li>Argazkiak: </li>
		</ul></br>
		<ul id="ul_garatzailea_2">
			<li>Deiturak: Unai Zabala</li>
			<li>Espezialitatea: Konputazioa </li>
			<li>Argazkiak: </li>
		</ul>

	<img src="../Irudiak/noimage.jpg" alt="Egileen irudia" height="50"></img><br/>
	
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>