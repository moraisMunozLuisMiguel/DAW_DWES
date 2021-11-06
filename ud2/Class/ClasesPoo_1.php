<?php
class Persona
{
   private $nombre;
   private $apellidos;
   private $fechaNacimiento;

   function __construct($nombre, $apellidos, $fechaNacimiento)
   {
      $this->nombre = $nombre;
      $this->apellidos = $apellidos;
      $this->fechaNacimiento = $fechaNacimiento;
   }

   // Getters
   public function getNombre()
   {
      return $this->nombre;
   }
   public function getApellidos()
   {
      return $this->apellidos;
   }
   public function getFechaNacimiento()
   {
      return $this->fechaNacimiento;
   }

   // Setters
   public function setNombre($nombre)
   {
      $this->nombre = $nombre;
   }
   public function setApellidos($apellidos)
   {
      $this->apellidos = $apellidos;
   }
   public function setFechaNacimiento($fechaNacimiento)
   {
      $this->fechaNacimiento = $fechaNacimiento;
   }

   function nombrecompleto($nombre, $apellidos)
   {
      return "{$nombre} {$apellidos}";
   }

   function edad($fecha)
   {
      // Calculo de la edad
      $hoy = new Datetime();
      //convertir string input del html en fecha
      $date1 = date_create($fecha);
      $interval = $date1->diff($hoy);
      return $interval->format('%y años');
   }
}

class Profesor extends Persona
{
   public $ID;

   public function __construct($ID, $nombre, $apellidos, $fechanacimiento)
   {
      $this->ID = $ID;
      parent::__construct($nombre, $apellidos, $fechanacimiento);
   }

   // Getter
   public function getID()
   {
      return $this->ID;
   }

   // Setter
   public function setID($ID)
   {
      $this->ID = $ID;
   }

   public function printID($nombre, $apellidos)
   {
      $n = $this->nombrecompleto($nombre, $apellidos);
      echo "$n es profesor y su ID de profesor es: $this->ID";
   }
}

class Alumno extends Persona
{
   public $notamedia;

   public function __construct($notamedia, $nombre, $apellidos, $fechanacimiento)
   {
      $this->notamedia = $notamedia;
      parent::__construct($nombre, $apellidos, $fechanacimiento);
   }

   // Getter
   public function getNotamedia()
   {
      return $this->notamedia;
   }

   // Setter
   public function setNotamedia($notamedia)
   {
      $this->notamedia = $notamedia;
   }

   public function printNotamedia($nombre, $apellidos)
   {
      $nombre = $this->nombrecompleto($nombre, $apellidos);
      echo "$nombre es alumno y su nota media es: $this->notamedia";
   }
}
