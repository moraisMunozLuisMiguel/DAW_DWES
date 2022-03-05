<?php

include_once 'lib/nusoap.php';
$cliente= new nusoap_client("http://localhost/DAW_DWES/ud5/ta_5_2/serviciobd.php", false);


echo "<h2> Todos los modulos</h2>";
$parametros= array();
$respuesta= $cliente->call("Modulos",$parametros);
$modulos= json_decode($respuesta);

echo "<ul>";
foreach ($modulos as $mod){
    echo "<li>".$mod->idmodulos." ".$mod->Nombre." ".$mod->Curso."</li>";
}

echo "</ul>";
echo "<br>";

//funcion modulos por curso
$parametros= array("curso"=>1);
$respuesta= $cliente->call("ModulosCurso",$parametros);
$modulos= json_decode($respuesta);

echo "<h2> Modulos Primer Curso</h2>";
echo "<ul>";
foreach ($modulos as $mod){
    echo "<li>".$mod->idmodulos." ".$mod->Nombre." ".$mod->Curso."</li>";
}

echo "</ul>";


