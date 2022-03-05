<?php

header("Content-Type: application/json");
include_once("../class/class_producto.php"); 

$_POST=json_decode(file_get_contents('php://input'),true); 

switch($_SERVER['REQUEST_METHOD']){
    case 'POST':
        if (isset($_POST['productoNombre'])){
            $user= new Producto(null,$_POST['productoNombre'],$_POST['idTipoProducto'],
			$_POST['unidad'],$_POST['descripcion'],$_POST['pvpUnidad'],
			$_POST['descuento']);
            $user->guardarProducto();
     }
     break;
    case 'GET':
		if (isset($_GET['idProducto'])){
			Producto::obtenerProductos($_GET['idProducto']);
        }
        else{
            Producto::obtenerProductos();
        }
        break;
    case 'PUT':
		if(isset($_GET['idProducto']) && (isset($_GET['pvpUnidad']))){
			Producto::actualizarPrecioProducto($_GET['idProducto'],$_GET['pvpUnidad']);
		}
		break;
    case 'DELETE':
        if (isset($_GET['idProducto'])){
            Producto::eliminarProducto($_GET['idProducto']);
        }
        break;
    }
?>