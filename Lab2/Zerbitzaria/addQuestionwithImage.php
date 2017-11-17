<?php 

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
$irudia = addslashes(file_get_contents($_FILES['f_irudia']['tmp_name']));


$sql = "INSERT INTO questions (eposta, testua, erantzun_zuzena, erantzun_okerra_1, erantzun_okerra_2, erantzun_okerra_3, galderaren_zailtasuna, gai_arloa, irudia) 
VALUES ('$eposta', '$testua', '$erantzunZuzena', '$erantzun_okerra_1', '$erantzun_okerra_2', '$erantzun_okerra_3', '$zailtasuna', '$gai_arloa', '{$irudia}')";

if ($connection->query($sql) === TRUE) {
    echo  'Galdera gorde da!\n';
	echo  '<a href = "../addQuestion.html" >Beste galdera bat sartu.</a>\n';
	echo  '<a href = "showQuestionswithImages.php" >Ikusi ze galdera dauden.</a>\n';
	
} else{
    echo 'Error: ' . $sql . '<br/>' . $connection->error;
	echo '<a href = "addQuestion.html">Errorea egon da. Saiatu berriro galdera sartzen. Klikatu hemen.</a>';
	
}

$connection->close();

 
?> 