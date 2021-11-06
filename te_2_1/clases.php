<?php

class Producto
{
   public $idProducto;
   public $nombre;
   public $unidad;
   public $descripcion;
   public $pvpUnidad;

   public function __construct($idProducto, $nombre, $descripcion, $pvpUnidad)
   {
      $this->idProducto = $idProducto;
      $this->nombre = $nombre;
      $this->unidad = "UD";
      $this->descripcion = $descripcion;
      $this->pvpUnidad = $pvpUnidad;
   }
   //Funciones get y set de los atributos de la clase.
   public function getIDProducto()
   {
      return $this->idProducto;
   }
   public function setIDProducto($idProducto)
   {
      $this->idProducto = $idProducto;
   }
   public function getNombre()
   {
      return $this->nombre;
   }
   public function setNombre($nombre)
   {
      $this->nombre = $nombre;
   }
   public function getUnidad()
   {
      return $this->unidad;
   }
   public function setUnidad($unidad)
   {
      $this->unidad = $unidad;
   }
   public function getDescripcion()
   {
      return $this->descripcion;
   }
   public function setDescripcion($descripcion)
   {
      $this->descripcion = $descripcion;
   }
   public function getPvpUnidad()
   {
      return $this->pvpUnidad;
   }
   public function setPvpUnidad($pvpUnidad)
   {
      $this->pvpUnidad = $pvpUnidad;
   }
}

class SW extends Producto
{
   private $descuento;
   private $version;
   private $precioConDescuento;

   //El constructor de la Clase Producto
   public function __construct($idProducto, $nombre, $descripcion, $pvpUnidad, $version)
   {
      parent::__construct($idProducto, $nombre, $descripcion, $pvpUnidad, $version); //El constructor Padre
      $this->descuento = 5;
      $this->version = $version;
      $this->precioConDescuento =
         $pvpUnidad - (($pvpUnidad / 100) * 5);
   }

   //Funciones get y set de los atributos de la clase.
   function getDescuento()
   {
      return $this->descuento;
   }
   function setDescuento($descuento)
   {
      $this->descuento = $descuento;
   }
   function getVersion()
   {
      return $this->version;
   }
   function setVersion($version)
   {
      $this->version = $version;
   }
   function getPrecioConDescuento()
   {
      return $this->precioConDescuento;
   }

   function setPrecioConDescuento($pvpUnidad, $descuento)
   {
      $this->precioConDescuento =
         $pvpUnidad - (($pvpUnidad / 100) * $descuento);
   }
}
class HW extends Producto
{
   private $descuento;
   private $proveedor;
   private $precioConDescuento;

   //El constructor de la Clase Producto
   public function __construct($idProducto, $nombre, $descripcion, $pvpUnidad, $proveedor)
   {

      parent::__construct($idProducto, $nombre, $descripcion, $pvpUnidad, $proveedor); //El constructor Padre
      $this->descuento = 10;
      $this->proveedor = $proveedor;
      $this->precioConDescuento =
         $pvpUnidad - (($pvpUnidad / 100) * 10);
   }

   //Funciones get y set de los atributos de la clase.
   function getDescuento()
   {
      return $this->descuento;
   }
   function setDescuento($descuento)
   {
      $this->descuento = $descuento;
   }
   function getProveedor()
   {
      return $this->proveedor;
   }
   function setProveedor($proveedor)
   {
      $this->proveedor = $proveedor;
   }
   function getPrecioConDescuento()
   {
      return $this->precioConDescuento;
   }
   function setPrecioConDescuento($precioConDescuento)
   {
      $this->precioConDescuento = $precioConDescuento;
   }
}
