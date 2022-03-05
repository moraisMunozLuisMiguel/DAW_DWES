<?php

require_once "lib/nusoap.php"; 
require_once "conexion.php";

$servicio = new soap_server();
$nombreEspacio = "urn:miserviciowsdl";
$servicio -> configureWSDL("Productos con stock menor a 4",$nombreEspacio);
$servicio -> schemaTargetNamespace = $nombreEspacio; 
$servicio -> register("cargarDatosStock",array('parametro' => 'xsd:integer'),array('return' => 'xsd:string'));

function cargarDatosStock($stockCant){
    $bd = new BaseDatos();
    $conexion = $bd->conectar();
	$sql= 'SELECT prod.productoNombre AS Producto, 
	prov.stock AS Cantidad, DATE_FORMAT(CURDATE() + prov.diasPedido, 
	"%d %M %Y") AS fechaLlegada FROM producto prod, proveedor prov 
	WHERE prod.idProducto = prov.idProducto AND prov.stock < ' .$stockCant;
	$resStock = $bd -> seleccionar($sql);
    $arrayStock=[];
    while ($stock=$resStock->fetch_assoc()){
        $arrayStock[]=$stock;
    }
    return json_encode($arrayStock);
}

$servicio -> service(file_get_contents("php://input"));
