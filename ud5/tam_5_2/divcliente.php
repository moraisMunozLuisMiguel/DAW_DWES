<?php

include_once 'lib/nusoap.php';
$cliente= new nusoap_client("http://localhost/DAW_DWES/ud5/tam_5_2/divserver.php",false);

$parametros= array("num1"=>"3","num2"=>"2");
$respuesta= $cliente->call("division",$parametros);

if (is_null($respuesta)){
    print("Parametro 2 igual a 0 -> K/0");
}
else{
print("La division es =".$respuesta);
}