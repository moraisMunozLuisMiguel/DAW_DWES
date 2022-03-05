<?php

include_once 'lib/nusoap.php'; //incluyendo al proyecto a la libreria nusoap.

//crear objeto de servicio
$servicio= new soap_server();
$nombreespacio="urn:miserviciowsdl";
$servicio->configureWSDL("Creando servicio",$nombreespacio); //configurar servicio
$servicio->schemaTargetNamespace=$nombreespacio; //almacen el espacionombre de destino



$servicio->register("Multiplicar",array('tipoproducto' => 'xsd:string',"tp2"=>'xsd:string'),array('return' => 'xsd:string'));

function Multiplicar($param1,$param2){
    $multi=$param1*$param2;
    $resultado= "El resultado de ".$param1." multiplicado por ".$param2." es = " . $multi;
    return $resultado;

}

$servicio->service(file_get_contents("php://input"));