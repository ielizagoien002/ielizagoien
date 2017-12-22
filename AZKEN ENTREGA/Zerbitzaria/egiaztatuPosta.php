<?php
	//nusoap.php klasea gehitzen dugu
	require_once('nusoap/lib/nusoap.php');
	require_once('nusoap/lib/class.wsdlcache.php');
	
	$soapclient = new nusoap_client('http://ehusw.es/rosa/webZerbitzuak/egiaztatuMatrikula.php?wsdl', false);
	
	//Web-Service-n inplementaturako funtzioari dei egiten diogu
	//eta itzultzen diguna inprimatzen dugu
	if (isset($_POST['txt_eposta'])){
		$result = $soapclient->call('egiaztatuE', array('x'=>$_POST['txt_eposta']));
		echo $result;
	}
	
?>