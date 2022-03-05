<?php
include("conexion.php");
$bd = new BaseDatos();
$conexion= $bd->conectar();
class Producto{

    private $product_id;
    private $product_name;


    public function __construct($product_id,$product_name){

        $this->product_id=$product_id;
        $this->product_name=$product_name;


    }


    public function guardarProducto(){

        global $bd;
        $sql = "INSERT INTO products (product_id,product_name) 
        VALUES ('$this->product_id','$this->product_name')";

        $bd->insertar($sql);
    }

    public static function obtenerProducto($id){

        global $bd;
        $data=[];
        $sql="SELECT * FROM products where product_id='".$id."'";
        $resultado=$bd->seleccionar($sql);
        $prod = mysqli_fetch_assoc($resultado);
        echo json_encode($prod);

    }

    public static function obtenerProductos(){

        global $bd;
        $data=[];
        $sql="SELECT * FROM products";
        $resultado=$bd->seleccionar($sql);

        while ($prod = mysqli_fetch_assoc($resultado)) {
             $data[]=$prod;
        }
        $var= json_encode($data);
        //echo "FIN";
        echo $var;

    }


    public static function eliminarProducto($id){
        global $bd;
        $sql="DELETE FROM products where product_id='".$id."'";
        $resultado=$bd->eliminar($sql);
    }



    public function getId() {
        return $this->product_id;
    }
    public function setID($id) {
       $this->product_id=$product_id;

    }

    public function getName() {
        return $this->product_name;
    }
    public function setName($n) {
        $this->product_name=$n;
    }

    


}