<?php

include("../conexion.php");
$bd = new BaseDatos();
$conexion = $bd->conectar();

class CestaLineas{
   private $idCestaLineas;
   private $idCesta;
   private $idProducto;
   private $cantidad;
   
   public function __construct($idCestaLineas, $idCesta, $idProducto, $cantidad){
      $this->idCestaLineas = $idCestaLineas;
      $this->idCesta = $idCesta;
      $this->idProducto = $idProducto;
      $this->cantidad = $cantidad;
   }

   public static function mostrarCestaLineas($idCesta){
      global $bd;
      $data = [];
	  $sql="SELECT c.idCesta, cl.idProducto, cl.cantidad FROM cestalineas cl 
	  inner join cesta c on c.idCesta=cl.idCesta WHERE c.comprado = 1 AND 
	  c.idCesta='" . $idCesta . "'";
      $resultado = $bd->seleccionar($sql);
	  while ($cesli = mysqli_fetch_assoc($resultado)){
		  $data[]=$cesli;
	  }
	  $var= json_encode($data);
      echo $var;
   }

public function getIdCesta()
   {
      return $this->idCesta;
   }
   
   public function setIdCesta($idCesta)
   {
      $this->idCesta = $idCesta;
   }
}
