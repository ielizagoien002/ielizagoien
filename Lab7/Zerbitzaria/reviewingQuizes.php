<?php
	include 'konfigurazioa.php';
	$connection = new mysqli($servername, $username, $password, $dbname);
	
	if ($connection->connect_error)
		{
			die('Ez da datu basera ondo konektatu:'.$connection->connect_error);
		} 
		session_start();
			if($_SESSION['logeatua'] != 'BAI'){
		header("Location:Location.html");
		exit();
	}
	$emaila=$_SESSION['username'];
	
		$galde= $connection->query("SELECT * FROM galderak");
		echo'<p>Datu basean sartuta dauden galderen kopurua:</p>';
		echo $galde->num_rows;
		echo'<p>Ikasleen galderak</p>';
	
			echo'<table border=2 align="center">
				<tr>
					<th>GalderaZenbakia</th>
					<th>Egilea</th>
					<th>Galdera</th>
					<th>Erantzuna</th>
					<th>Zailtasuna</th>
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
		echo'Aldatu nahi duzun galderaren zenbakia idatzi hemen';
		echo'<form id="galaukera" method="post" action="galderaAldatu.php">';
		
		echo'<input type="text" id="zenbakia" name="zenbakia">';
		echo'<input type="submit" id="galderaAldatu" value="Galdera aldatu">';
		echo'</form>';
	
	
	<a href="LogOut.php">Logout</a>
	echo'</br></br>';
	
	
mysqli_close($connection);
?>