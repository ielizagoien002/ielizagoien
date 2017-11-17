<?php
//nusoap.php klasea gehitzen dugu
require_once('nusoap/lib/nusoap.php');
require_once('nusoap/lib/class.wsdlcache.php');

//soap_server motako objektua sortzen dugu
$ns="https://uzabala012ws.000webhostapp.com/";  //name of the service

$server = new soap_server;
$server->configureWSDL('egiaztatuPasahitza',$ns);
$server->wsdl->schemaTargetNamespace=$ns;

//inplementatu nahi dugun funtzioa erregistratzen dugu
$server->register('egiaztatuPasahitza',array('x'=>'xsd:string'),array('z'=>'xsd:string'),$ns);

//funtzioa inplementatzen dugu

function egiaztatuPasahitza($x)
{
  $fitxa=fopen("toppasswords.txt","r");
if ($fitxa==NULL){
echo'Errorea fitxategia irakurtzerakoan';
}else {
		while (!feof($fitxa))
		{
                        
			if(trim(fgets($fitxa))==$x)
				{
					return "BALIOGABEA"; 
                    break;     
				}

		}
	        return "BALIOZKOA";
	         fclose ($fitxa);
               }
}
//nusoap klaseko sevice metodoari dei egiten diogu

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>