<?php
	include 'konfigurazioa.php';
	$connection = new mysqli($servername, $username, $password, $dbname);
	
	
	if ($connection->connect_error)
		{
			die('Ez da datu basera ondo konektatu:'.$connection->connect_error);
		} 
	$galzenbaki=$_POST['zenbakia'];
	
	$galdera= $connection->query("SELECT * FROM galderak WHERE GalderaZenbakia='".$galzenbaki."'");
				while($row = mysqli_fetch_assoc($galdera))
			{
						$posta=$row['txt_eposta'];
						$Galdera=$row['txt_testua'];
						$Erantzuna=$row['txt_erantzun_zuzena'];
						$Zailtasuna=$row['txt_zailtasuna'];
						$Gaia=$row['txt_gai_arloa'];
			}
	mysqli_close($connection);
	?>
	
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>GalderaAldatu</title>
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
  </br></br>
 <form id="galaldatu" method="post" action="galderaGorde.php">
	<textarea id="egilepost" rows="1" cols="20"  name="egilepost" style="visibility:hidden;"><?php echo $posta?></textarea>
	<textarea id="galdeZenbaki" rows="1" cols="20"  name="galdeZenbaki" style="visibility:hidden;"><?php echo $galzenbaki?></textarea></br>
 	Galdera:<textarea id="galde" rows="1" cols="150"  name="galde" ><?php echo $Galdera?></textarea></br>
	Erantzuna:<textarea id="erantzun" rows="1" cols="150"  name="erantzun" ><?php echo $Erantzuna?></textarea></br>
	<!--Zailtasuna:<textarea id="zailtasun" rows="1" cols="3"  name="zailtasun" onchange="zailtasun()" ><?php echo $Zailtasuna?></textarea></br>-->
	Zailtasuna:<input type="number" id="zailtasun" name="zailtasun" min="1" max="5" value="<?php echo $Zailtasuna?>"  ></br>
	Gaia:<textarea id="gaia" rows="1" cols="20"  name="gaia" ><?php echo $Gaia?></textarea></br></br>
	<input type="submit" value="Aldaketa Gorde "id="aldaketaGorde" >
	</form>

			<br/><br/>
			<a href="reviewingQuizes.php">Itzuli</a>
			
 </form>
		
 
  
  </body>
</html>
