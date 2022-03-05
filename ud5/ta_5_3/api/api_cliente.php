<?php
header("Content-Type: application/json");
include_once("../class/class_cliente.php"); //incluimos clase cliente


$_POST=json_decode(file_get_contents('php://input'),true); //decodificar el json


switch($_SERVER['REQUEST_METHOD']){
    case 'POST':

        if (isset($_POST['customer_name'])
            &&isset($_POST['customer_email'])&&isset($_POST['customer_contact'])
            &&isset($_POST['customer_address'])&&isset($_POST['country'])){

                $user= new Cliente(NULL,$_POST['customer_name'],$_POST['customer_email'],$_POST['customer_contact']
                        ,$_POST['customer_address'],$_POST['country']);
                $user->guardarCliente();
         }
         //seleccionar el id del cliente

         echo "Final";
         break;
    case 'GET':
        if (isset($_GET['id'])){

            Cliente::obtenerCliente($_GET['id']);
        }
        else{
            //todos
            Cliente::obtenerClientes();//ESTATICO
        }
        break;

    case 'PATCH':
        if (isset($_GET['id'])&&(isset($_GET['nombre']))){
            Cliente::modificarNombreCliente($_GET['id'],$_GET['nombre']);
           
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])){
            Cliente::eliminarUsuario($_GET['id']);
           
        }
        break;

    }
?>