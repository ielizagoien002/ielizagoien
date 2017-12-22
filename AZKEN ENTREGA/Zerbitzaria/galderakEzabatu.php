<?php
	session_start();
	include 'konfigurazioa.php';
	$connection = new mysqli($servername, $username, $password, $dbname);
	
	
	if($_SESSION['logeatua'] != 'BAI' || $_SESSION['rola']!='IRAKASLE'){
		header("Location:Location.html");
		exit();
	}
	$erabiltzailea=$_SESSION['username'];
	$e=$connection->query("SELECT * FROM erabiltzaile WHERE Emaila='$erabiltzailea'");
	$row=mysqli_fetch_array($e,MYSQLI_ASSOC);
	$ize=$row['Izena'];
	$argaz=base64_encode($row['Argazkia']);
	
mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Galdera Ezabatu</title>
    <link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='stylesPWS/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='stylesPWS/smartphone.css' />
		   </head>
  
  <body>
   <div id='page-wrap'>
	<header class='main' id='h1'>

      <span class="right"><a href="logOut.php"> <img src="irudiak/logout.jpg" height="75" width="75"> </a> </span>
	  	  <table align="right">
		<tr>
				<td><?php echo $ize?></td>
				<td><img src=data:image/jpeg;base64,<?php echo $argaz?> width="50" height="50"/></td>
			</tr>
	</table>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Home</a></span>
		<span><a href='reviewingQuizes.php'>Galderak ikusi</a></span>
		<span><a href='galderaEzabatu.php'>Galderak ezabatu</a></span>
		<span><a href='erabilGalderakEzabatu.php'>Erabiltzaile baten galderak ezabatu</a></span>
		<span><a href='ShowUsersWithImage.php'>Erabiltzaileak bistaratu</a></span>
		<span><a href='credits.php'>Credits</a></span>
	</nav>
    <section class="main" id="s1">
    
	
	<div align="center" style="overflow:auto;height:500px">
	<?php
	
	include 'konfigurazioa.php';
	$connection = new mysqli($servername, $username, $password, $dbname);
	

	
	if ($connection->connect_error)
		{
			
			die('Ez da datu basera ondo konektatu:'.$connection->connect_error);
			//exit();
		} 
		
	
	$emaila=$_SESSION['username'];
	
		$galde= $connection->query("SELECT * FROM galderak");
		echo'<p>Datu basean sartuta dauden galderen kopurua:</p>';
		echo $galde->num_rows;
		echo'<p>Orriaren behealdean aukeratu ezabatu nahi duzun galdera</p>';
		echo'</br>';
	
			echo'<table border=2 align="center">
				<tr>
					<th>GalderaZenbakia</th>
					<th>Egilea</th>
					<th>Galdera</th>
					<th>Erantzuna</th>
					<th>Konplexutasuna</th>
					<th>Gaia</th>
					
				</tr>';

			while($rowgal = $galde -> fetch_row())
	


	{
		echo "<tr>
				<td>".$rowgal[0]."</td>
				<td>".$rowgal[1]."</td>
				<td>".$rowgal[2]."</td>
				<td>".$rowgal[3]."</td>
				<td>".$rowgal[4]."</td>
				<td>".$rowgal[5]."</td>
			</tr>";
	}
		echo'</table>';
		echo'Ezabatu nahi duzun galderaren zenbakia idatzi hemen';
		echo'<form id="galaukera" method="post" action="galderaEzabatu2.php">';
		
		echo'<input type="text" id="zenbakia" name="zenbakia">';
		echo'<input type="submit" id="galderaEzabatu" value="Galdera ezabatu">';
		echo'</form>';
	
	
	echo'</br></br>';
	
	
mysqli_close($connection);
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