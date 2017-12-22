<?php
//nusoap.php klasea gehitzen dugu
require_once('nusoap/lib/nusoap.php');
require_once('nusoap/lib/class.wsdlcache.php');

//soap_server motako objektua sortzen dugu
$ns="http://localhost:1234/wsuz17/Lab6/Zerbitzaria/egiaztatuPasahitza.php?wsdl";  //name of the service

$server = new soap_server;
$server->configureWSDL('egiaztatuPasahitza',$ns);
$server->wsdl->schemaTargetNamespace=$ns;

//inplementatu nahi dugun funtzioa erregistratzen dugu
$server->register('egiaztatuPasahitza',array('x'=>'xsd:string'),array('z'=>'xsd:string'),$ns);

//funtzioa inplementatzen dugu

function egiaztatuPasahitza($x){
	$fitxa=fopen("toppasswords.txt","r");
	$baliogabea = false;
	if ($fitxa==NULL){
		echo'Errorea fitxategia irakurtzerakoan';
	}
	else {
		while (!feof($fitxa) & !$baliogabea){
			if(trim(fgets($fitxa))==$x){
					$baliogabea= true; 
				}
		}
	    fclose ($fitxa);
		if($baliogabea){
			return "BALIOGABEA";
		} 
		else{
			return "BALIOZKOA";
		} 
    }
}

//nusoap klaseko sevice metodoari dei egiten diogu
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';

/* PHP 7 */
@$server->service(file_get_contents("php://input"));
/* PHP 5 */
//$server->service($HTTP_RAW_POST_DATA);
?>