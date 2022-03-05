<?php
class Servicio
{
 public function funcion1()
 {
 
 $resultado= "Mi parametro de entrada es: " . func_get_args()[0]." ".func_get_args()[1]  ;
 return $resultado;

 }
}
try {
 $server = new SoapServer(
 null,
 [
 'uri'=> 'http://localhost/DAW_DWES/ud5/sinWsdl/serviciosoap.php',
 ]
 );
 $server->setClass('Servicio');
 $server->handle();
} catch (SOAPFault $f) {
 print $f->faultstring;
}