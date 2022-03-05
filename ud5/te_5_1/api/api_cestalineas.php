<?php
header("Content-Type: application/json");
include_once("../class/class_cestalineas.php"); 


$_POST=json_decode(file_get_contents('php://input'),true); 


switch($_SERVER['REQUEST_METHOD']){
    case 'POST':
         break;
    case 'GET':
		if (isset($_GET['idCesta'])){
			CestaLineas::mostrarCestaLineas($_GET['idCesta']);
        }
        break;
    case 'PUT':
        break;
    case 'DELETE':
        break;
    }
?>