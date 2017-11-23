<!DOCTYPE html>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="../Js/ajax.js"></script>

  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
    <?php 
	
		if(isset($_GET['erabiltzailea'])){
		echo '<a style="display:none" id="erabiltzailea">' . $_GET['erabiltzailea'] . '</a>';
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
						<span><a href="handlingQuizes.php?erabiltzailea=' . $erab . '">Galderak kudeatu</a></span>
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
		<input type="button" value="Nire galderak ikusi" id="btnNireGalderakErakutsi" />
		<input type="button" value="Galderak gehitu" id="btnGalderakGehitu" />
		<div id="emaitza" style="overflow-y:scroll; height:200px"></div>
		<input type="button" value="Bidali" id="btnGalderaIgo" style="display:none;margin:auto;" />
		<div id="emaitza2"></div>
		
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>


