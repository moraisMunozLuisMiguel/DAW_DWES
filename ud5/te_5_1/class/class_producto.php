<?php

include("../conexion.php");
$bd = new BaseDatos();
$conexion= $bd->conectar();

class Producto{
    private $idProducto;
    private $productoNombre;
	private $idTipoProducto;
    private $unidad;
	private $descripcion;
    private $pvpUnidad;
	private $descuento;
    
    public function __construct($idProducto,$productoNombre,$idTipoProducto,$unidad,
	$descripcion,$pvpUnidad,$descuento){
        $this->idProducto=$idProducto;
        $this->productoNombre=$productoNombre;
		$this->idTipoProducto=$idTipoProducto;
		$this->unidad=$unidad;
        $this->descripcion=$descripcion;
		$this->pvpUnidad=$pvpUnidad;
        $this->descuento=$descuento;
    }

    public function guardarProducto(){
        global $bd;
        $sql = "INSERT INTO producto (idProducto,productoNombre,idTipoProducto,unidad,
		descripcion,pvpUnidad,descuento) VALUES ('$this->idProducto','$this->productoNombre',
		'$this->idTipoProducto','$this->unidad','$this->descripcion','$this->pvpUnidad',
		'$this->descuento')";
        $bd->insertar($sql);
    }

    public static function obtenerProducto($id){
        global $bd;
        $data=[];
        $sql="SELECT * FROM producto where idProducto='".$id."'";
        $resultado=$bd->seleccionar($sql);
        $prod = mysqli_fetch_assoc($resultado);
        echo json_encode($prod);
    }
	
    public static function obtenerProductos(){
        global $bd;
        $data=[];
        $sql="SELECT * FROM producto";
        $resultado=$bd->seleccionar($sql);
        while ($prod = mysqli_fetch_assoc($resultado)) {
             $data[]=$prod;
        }
        $var= json_encode($data);
        echo $var;
    }
	
    public static function eliminarProducto($idProducto){
        global $bd;
        $sql="DELETE FROM producto where idProducto='".$idProducto."'";
        $resultado=$bd->eliminar($sql);
    }
	
	public static function actualizarPrecioProducto($idProducto,$pvpUnidad){
        global $bd;
		$sql="UPDATE producto SET pvpUnidad='$pvpUnidad' where idProducto='".$idProducto."'";
        $resultado=$bd->update($sql);
    }
	
    public function getId() {
        return $this->idProducto;
    }
	
    public function setID($id) {
       $this->idProducto=$idProducto;
    }

    public function getName() {
        return $this->productoNombre;
    }
	
    public function setName($n) {
        $this->productoNombre=$n;
    }
	
	public function getPvpUnidad() {
        return $this->pvpUnidad;
    }
	
    public function setPvpUnidad($n) {
        $this->pvpUnidad=$n;
    }

}