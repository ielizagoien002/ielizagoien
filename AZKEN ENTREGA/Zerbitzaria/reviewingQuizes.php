<!DOCTYPE html>
<?php
ini_set('session.cookie_lifetime', 30);
session_start();
if (!isset($_SESSION['kautotua'])){
	$_SESSION['kautotua'] = "EZ";
	exit();
}

if($_SESSION['kautotua'] == "EZ"){
	echo '<script>alert("Saioa hasi gabe ezin da horri hau atzitu, hasi saioa mesedez. ");window.location.href="layout.php"</script>';
	exit();
}

if($_SESSION['rola'] == 0){
	echo '<script>alert("Irakasleentzako gunea. Ez dago atzigarri ikasleentzako. ");window.location.href="layout.php"</script>';
	exit();
}


?>
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
	
		if($_SESSION['kautotua'] == "BAI"){
		$erab = $_SESSION['eposta'];
		if($_SESSION['rola']==0) $rola = "Ikaslea";
		if($_SESSION['rola']==1) $rola = "Irakaslea";
			echo '	<span class="right" style="display:none;"><a href="signUp.php">Erregistratu</a></span>
					<span class="right" style="display:none;"><a href="logIn.php">Saioa hasi</a></span>
					<span class="right" ><a name="lbl_user">Kaixo ' . $erab .  '</a></span>
					<span class="right" ><a name="lbl_rol">Rola:  ' . $rola .  '</a></span>
					<span class="right" ><a href="logOut.php">Saioa itxi</a></span>
				 ';
		}
		else{
			$erab = session_id();
			echo '	<span class="right"><a href="signUp.php">Erregistratu</a></span>
					<span class="right"><a href="logIn.php">Saioa hasi</a></span>
					<span class="right" ><a name="lbl_user">Session id: ' . $erab .  '</a></span>
					<span class="right" style="display:none;"><a>Saioa itxi</a></span>
				 ';	
		}
		
	?>
	<h2>Quiz: crazy questions</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href="layout.php">Home</a></span>
		<span><a href="handlingQuizes.php">Galderak kudeatu</a></span>
		<span><a href="reviewingQuizes.php">Aldaketak kudeatu</a></span>
		<span><a href="credits.php">Credits</a></span>
	</nav>
    <section class="main" id="s1">
		<input type="button" value="Galderak editatu" id="btnGalderakEditatu" name="btnGalderakEditatu" />
		<div id="emaitza" style="overflow-y:scroll; overflow-x:scroll; height:200px"></div>
		
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>


