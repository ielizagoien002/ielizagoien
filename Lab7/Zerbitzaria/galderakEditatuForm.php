<?php
ini_set('session.cookie_lifetime', 30);
session_start();
if (!isset($_SESSION['kautotua'])){
	$_SESSION['kautotua'] = "EZ";
}
if($_SESSION['kautotua']=="EZ"){
	echo '<script>alert("Saioa hasi gabe ezin da horri hau atzitu, hasi saioa mesedez. ");window.location.href="layout.php"</script>';
	exit();
}

if(isset($_POST['txt_eposta_bete']){
	echo '<form id="galderenF" name="galderenF" method="POST" enctype="multipart/form-data">
	<input type="text" id="txt_eposta" name="txt_eposta" value="' . $_POST['txt_eposta_bete'] . '" disabled="true"/>;
	<label>Testua (*)</label>
	<input type="text" id="txt_testua"name="txt_testua" value="' . $_POST['txt_testua'] . '"/><br/>
	<label>Erantzun zuzena (*)</label>
	<input type="text" id="txt_erantzun_zuzena" name="txt_erantzun_zuzena" value="' . $_POST['txt_erantzun_zuzena'] . '"/><br/>
	<label>Erantzun okerra 1 (*)</label>
	<input type="text" id="txt_erantzun_okerra_1" name="txt_erantzun_okerra_1" value="' . $_POST['txt_erantzun_okerra_1'] . '"/><br/>
	<label>Erantzun okerra 2 (*)</label>
	<input type="text" id="txt_erantzun_okerra_2" name="txt_erantzun_okerra_2" value="' . $_POST['txt_erantzun_okerra_2'] . '"/><br/>
	<label>Erantzun okerra 3 (*)</label>
	<input type="text" id="txt_erantzun_okerra_3" name="txt_erantzun_okerra_3" value="' . $_POST['txt_erantzun_okerra_3'] . '"/><br/>
	<label>Galderaren zailtasuna (1 eta 5 artekoa) (*) </label>
	<input type="text" id="txt_zailtasuna" name="txt_zailtasuna" value="' . $_POST['txt_zailtasuna'] . '"/><br/>
	<label>Gai-arloa (*)</label>
	<input type="text" id="txt_gai_arloa" name="txt_gai_arloa" value="' . $_POST['txt_gai_arloa'] . '"/><br/>
</form>
<a href="reviewingQuizes.php">Itzuli</a>';
}



?>	
