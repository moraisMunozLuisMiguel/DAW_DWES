<?php

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
      $this->db = "ud03";
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
         echo "Los datos no pudieron ser enviados a la base de datos y no se pudo insertar. <br>";
      }
   }

   public function eliminar($query){
      $resultado = $this->conexion->query($query);
      if (!$resultado) {
         echo "Los datos no pudieron ser enviados a la base de datos y no se pudo eliminar. <br>";
      }
   }

}
