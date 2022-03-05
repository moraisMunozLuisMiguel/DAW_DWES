<?php

include_once 'lib/nusoap.php'; //incluyendo al proyecto a la libreria nusoap.

//crear objeto de servicio
$servicio= new soap_server();
$nombreespacio="urn:sumaservidor";
$servicio->configureWSDL("servidordivision",$nombreespacio); //configurar servicio
$servicio->schemaTargetNamespace=$nombreespacio; //almacen el espacionombre de destino


$servicio->register("division",array('num1' => 'xsd:integer','num2' => 'xsd:integer'),array('return' => 'xsd:integer'));

function division($param1,$param2){
    if ($param2!=0){
        $resultado=$param1/$param2;
    }
    else{
        $resultado=null;
    }
    return $resultado;

}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
//$servicio->service($HTTP_RAW_POST_DATA);
$servicio->service(file_get_contents("php://input"));
