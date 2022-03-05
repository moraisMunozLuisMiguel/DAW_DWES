<?php
// model
class Book
{
	public $name;
	public $year;
}

// create instance and set a book name
$book      =new Book();
$book->name='libro 1';

// initialize SOAP client and call web service function
$client=new SoapClient('http://localhost/DAW_DWES/ud5/wsdl/server.php?wsdl',['trace'=>1,'cache_wsdl'=>WSDL_CACHE_NONE]);
$resp  =$client->bookYear($book);

// dump response
var_dump($resp);
var_dump($client->__getTypes());
var_dump($client->__getFunctions());
echo $resp;