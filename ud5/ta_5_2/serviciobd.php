<?php

include_once 'lib/nusoap.php'; //incluyendo al proyecto a la libreria nusoap.
include_once 'conexion.php';
//crear objeto de servicio
$servicio= new soap_server();
$nombreespacio="urn:miserviciowsdl";
$servicio->configureWSDL("ServBD",$nombreespacio); //configurar servicio
$servicio->schemaTargetNamespace=$nombreespacio; //almacen el espacionombre de destino


$servicio->register("Modulos",array(),array('return' => 'xsd:string'));
$servicio->register("ModulosCurso",array('parametro' => 'xsd:integer'),array('return' => 'xsd:string'));

function Modulos(){

    $bd= new BaseDatos();
    $conexion= $bd->conectar();

    $sql= "Select * from modulos";
    $resmod =$bd->seleccionar($sql);
   
    $arrayModulos=[];
    while ($mod=$resmod->fetch_assoc()){
        $arrayModulos[]=$mod;
    }
    return json_encode($arrayModulos);

}

function ModulosCurso($ano){

    $bd= new BaseDatos();
    $conexion= $bd->conectar();

    $sql= "Select * from modulos where Curso=".$ano;
    $resmod =$bd->seleccionar($sql);
   
    $arrayModulos=[];
    while ($mod=$resmod->fetch_assoc()){
        $arrayModulos[]=$mod;
    }
    return json_encode($arrayModulos);

}



$servicio->service(file_get_contents("php://input"));

