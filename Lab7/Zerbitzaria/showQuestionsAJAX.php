
		<table style="margin:auto;">
			<tr>
				<th>Enuntziatua</th>
				<th>Zailtasuna</th>
				<th>Gaia</th>
			</tr>
			<?php 
				$xml = simplexml_load_file('../xml/questions.xml') or die("Error: Cannot create object");
				foreach ($xml->xpath('/assessmentItems/assessmentItem') as $assessmentItem) :
					
					echo   '<tr>
								<td>' . $assessmentItem->itemBody->p . '</td>
								<td>' . $assessmentItem['complexity'] . '</td>
								<td>' . $assessmentItem['subject'] . '</td>
							</tr>';
							
				endforeach; 
			?>
  
		</table>
		
		
		<?php 
			/*
			if(isset($_GET['erabiltzailea'])){
				echo '<a href="layout.php?erabiltzailea=' . $_GET['erabiltzailea'] . '">Hasierara itzuli</a>';
			}
			else{
				echo '<a href="layout.php">Hasierara itzuli</a>';
			}
			*/
		?>
