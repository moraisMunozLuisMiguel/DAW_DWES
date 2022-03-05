<?php
header("Content-Type: application/json");
include_once("../class/class_producto.php"); //incluimos clase cliente


$_POST=json_decode(file_get_contents('php://input'),true); //decodificar el json


switch($_SERVER['REQUEST_METHOD']){
    case 'POST':
        if (isset($_POST['product_name'])){

            $user= new Producto(null,$_POST['product_name']);
            $user->guardarProducto();
     }
     //seleccionar el id del cliente

     break;
         break;
    case 'GET':
        Producto::obtenerProductos();
        break;

    case 'PUT':
       
        break;

    case 'DELETE':
        if (isset($_GET['id'])){
            Producto::eliminarProducto($_GET['id']);
           
        }
        break;

    }
?>