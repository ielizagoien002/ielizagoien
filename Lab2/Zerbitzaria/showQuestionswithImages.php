<?php 

include 'konfigurazioa.php';


$connection = new mysqli($servername, $username, $password, $dbname);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Taula jaso
$SQL_QUIZ = "SELECT * FROM questions";

// Array batean sartu emaitza
$emaitza = $connection->query($SQL_QUIZ);

// Taula egin
echo '<table border=1><tr><th> ID </th><th> E-Maila </th><th> Galdera </th><th> Erantzun Zuzena </th><th> 
Erantzun Okerra 1 </th><th> Erantzun Okerra 2 </th><th> Erantzun Okerra 3 </th><th> Zailtasuna </th><th> Gai arloa </th><th>Irudia</th></tr>';

if ($emaitza->num_rows > 0) {
	while ($row = $emaitza->fetch_assoc()) {
		echo '<tr><td>'.$row['id'].'</td> <td>'. $row['eposta'].'</td><td>'.$row['testua'].'</td>
		<td>'.$row['erantzun_zuzena'].'</td><td>'.$row['erantzun_okerra_1'].'</td><td>'.$row['erantzun_okerra_2'].'</td>
		<td>'.$row['erantzun_okerra_3'].'</td><td>'.$row['galderaren_zailtasuna'].'</td><td>'.$row['gai_arloa'].'</td><td><img src="data:image/jpeg;base64,'.base64_encode($row['irudia']).'" height="150" alt="Image" /></td></tr>';
	}
} else {
	echo "Errorea";	
}

$connection->close();

 
?> 