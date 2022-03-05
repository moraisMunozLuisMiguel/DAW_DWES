<?php

include_once 'lib/nusoap.php';
$cliente= new nusoap_client("http://localhost/DAW_DWES/ud5/ta_5_1/servicio.php",false);

$parametros= array("parametro"=>"5","par2"=>"4");
$respuesta= $cliente->call("Multiplicar",$parametros);

print_r($respuesta);
