<?php
ini_set('session.cookie_lifetime', 30);
session_start();
if (!isset($_SESSION['kautotua'])){
	$_SESSION['kautotua'] = "EZ";
}

if($_SESSION['kautotua'] == "EZ"){
	echo '<script>alert("Saioa hasi gabe ezin da horri hau atzitu, hasi saioa mesedez. ");window.location.href="layout.php"</script>';
	exit();
}
?>
		<table style="margin:auto;">
			<tr>
				<th>Enuntziatua</th>
				<th>Zailtasuna</th>
				<th>Gaia</th>
			</tr>
			<?php 
				$xml = simplexml_load_file('../xml/questions.xml') or die("Error: Cannot create object");
				foreach ($xml->xpath('/assessmentItems/assessmentItem') as $assessmentItem) :
					if($_SESSION['eposta'] == $assessmentItem['email']){
						echo   '<tr>
									<td>' . $assessmentItem->itemBody->p . '</td>
									<td>' . $assessmentItem['complexity'] . '</td>
									<td>' . $assessmentItem['subject'] . '</td>
								</tr>';
					}
				endforeach; 
				
			?>
  
		</table>
		
