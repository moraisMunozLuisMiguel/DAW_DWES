<?php

include_once 'lib/nusoap.php'; //incluyendo al proyecto a la libreria nusoap.

//crear objeto de servicio
$servicio= new soap_server();
$nombreespacio="urn:miserviciowsdlprueba";
$servicio->configureWSDL("servidorprueba",$nombreespacio); //configurar servicio
$servicio->schemaTargetNamespace=$nombreespacio; //almacen el espacionombre de destino


$servicio->register("devolverFuncion",array('tipoproducto' => 'xsd:string'),array('return' => 'xsd:string'));

function devolverFuncion($param1){
    $resultado= "Mi parametro es:" . $param1;
    return $resultado;

}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
//$servicio->service($HTTP_RAW_POST_DATA);
$servicio->service(file_get_contents("php://input"));
