<?php

/*ini_set("display_errors", 'off');
ini_set("error_reporting",E_ALL);  */

class BaseDatos{
   private $conexion;
   private $user;
   private $host;
   private $pass;
   private $db;

   public function __construct(){
      $this->user = "root";
      $this->host = "localhost";
      $this->pass = "root";
	  $this->db = "ud04";
   }
   
   public function conectar(){
      $this->conexion = new mysqli($this->host, $this->user, $this->pass, $this->db);
      if ($this->conexion->connect_errno) {
         printf("Connect failed: %s\n", $mysqli->connect_error);
         exit();
      } else {
         return $this->conexion;
      }
   }

   public function seleccionar($query){
      $resultado = $this->conexion->query($query);
      if (!$resultado) {
         echo 'Hubo un error en la conexión con la base de datos.';
         exit;
      }
      return $resultado;
   }
   
   public function insertar($query){
      $resultado = $this->conexion->query($query);
      if (!$resultado) {
         echo "Los datos no pudieron ser enviados a la base de datos. <br>";
      }
   }

	public function insertar_cesta_lineas($query){
      $resultado = $this->conexion->query($query);
      if (!$resultado) {
         echo "Los datos no pudieron ser enviados a la base de datos y no se pudo 
		 insertar en la tabla cesta_lineas. <br>";
      }
   }
   
   public function eliminar($query){
      $resultado = $this->conexion->query($query);
      if (!$resultado) {
         echo "Los datos no pudieron ser enviados a la base de datos. <br>";
      }
   }
   
   public function eliminarProducto($query){
      $resultado = $this->conexion->query($query);
      if (!$resultado) {
         echo "Los datos no pudieron ser enviados a la base de datos y no se pudo 
		 eliminar la cesta. <br>";
      }
   }
   
   public function eliminarProductoProducto($query){
      $resultado = $this->conexion->query($query);
      if (!$resultado) {
         echo "Los datos no pudieron ser enviados a la base de datos y no se pudo 
		 eliminar la cesta. <br>";
      }
   }
   
   public function eliminarProductoPrincipal($query){
      $resultado = $this->conexion->query($query);
      if (!$resultado) {
         echo "Los datos no pudieron ser enviados a la base de datos y no se pudo 
		 eliminar la cesta. <br>";
      }
   }
   
   public function comprar($query){
      $resultado = $this->conexion->query($query);
      if (!$resultado) {
         echo "Los datos no pudieron ser enviados a la base de datos y no se pudo 
		 comprar. <br>";
      }
   }
   
   public function actualizarProducto($query){
      $resultado = $this->conexion->query($query);
      if (!$resultado) {
         echo "Los datos no pudieron ser enviados a la base de datos y no se pudo 
		 actualizar la cesta. <br>";
      }
   }
   
}
