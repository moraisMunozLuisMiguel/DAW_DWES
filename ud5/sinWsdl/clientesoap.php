<?php
ini_set('soap.wsdl_cache_enabled',0);
ini_set('soap.wsdl_cache_ttl',0);
$client = new SoapClient(null, array(
      'location' => "http://localhost/DAW_DWES/ud5/sinWsdl/serviciosoap.php", 
      'uri'      => "http://localhost/DAW_DWES/ud5/sinWsdl/serviciosoap.php",
      'trace'    => 1 ));
try {
	echo $return = $client->__soapCall("funcion1", ["DWES","Param2"] );
} catch ( SOAPFault $e ) {
	echo $e->getMessage().PHP_EOL;
}


