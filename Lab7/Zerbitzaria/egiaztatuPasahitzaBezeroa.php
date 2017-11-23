<?php
	//nusoap.php klasea gehitzen dugu
	require_once('nusoap/lib/nusoap.php');
	require_once('nusoap/lib/class.wsdlcache.php');
	
	$soapclient = new nusoap_client('http://localhost:1234/wsuz17/Lab6/Zerbitzaria/egiaztatuPasahitza.php?wsdl', false);
	
	//Web-Service-n inplementaturako funtzioari dei egiten diogu
	//eta itzultzen diguna inprimatzen dugu
	if (isset($_POST['pwd_pasahitza'])){
		$result = $soapclient->call('egiaztatuPasahitza', array('x'=>$_POST['pwd_pasahitza']));
		echo $result;
	}
	
?>