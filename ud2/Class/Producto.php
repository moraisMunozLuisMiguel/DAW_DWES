<!-- Las instancias de la clase Producto representan los productos que se venden en la tienda (Familias). Almacenan la siguiente información de cada producto: códigoProd, nombreProd, nombre_corto_prod. Cada valor se almacenará en un atributo de tipo protected, para limitar el acceso a su contenido y permitir su herencia. Para cambiar sus valores y acceder a ellos, se creará un método de tipo get y set para cada uno.
Las instancias de la clase SubProducto (herencia de Producto) representan los SubProductos que se venden en la tienda. Almacenan la siguiente información de cada producto: código, nombre, PVP. Cada valor se almacenará en un atributo de tipo protected. Para cambiar sus valores y acceder a ellos, se creará un método de tipo get y set para cada uno. -->

<?php
class Producto
{
   protected $codigoProd;
   protected $nombreProd;
   protected $nombre_corto_prod;

   public function getcodigo()
   {
      return $this->codigoProd;
   }

   public function getnombre()
   {
      return $this->nombreProd;
   }

   public function getnombrecorto()
   {
      return $this->nombre_corto_prod;
   }

   // Setters
   function setCodigo($codigoProd)
   {
      $this->codigoProd = $codigoProd;
   }

   function setNombreProd($nombreProd)
   {
      $this->nombreProd = $nombreProd;
   }

   function setNombreCortoProd($nombre_corto_prod)
   {
      $this->nombre_corto_prod = $nombre_corto_prod;
   }

   // Método para mostrar el código del producto 
   public function muestra()
   {
      print "El producto es: " . $this->codigoProd . "" . "<br/>";
   }

   public function __construct($row)
   {
      $this->codigoProd = $row['codigo'];
      $this->nombreProd = $row['nombre'];
      $this->nombre_corto_prod = $row['nombre_corto'];
   }
}

class SubProducto extends Producto
{
   protected $codigo;
   protected $nombre;
   protected $PVP;

   // Getters
   public function getcodigo()
   {
      return $this->codigo;
   }

   public function getnombre()
   {
      return $this->nombre;
   }

   public function getPVP()
   {
      return $this->PVP;
   }

   // Setter
   function setCodigo($codigo)
   {
      $this->codigo = $codigo;
   }

   function setNombre($nombre)
   {
      $this->nombre = $nombre;
   }

   function setPVP($PVP)
   {
      $this->PVP = $PVP;
   }

   // Método para mostrar el precio del subproducto
   public function muestraSubProducto()
   {
      print "El SubProducto es: " . $this->codigo . " y el precio es: " . $this->PVP . ""  . "<br/>";
   }

   public function __construct($producto, $codigo, $nombre, $PVP)
   {
      parent::__construct($producto); //El constructor Padre
      $this->codigo = $codigo;
      $this->nombre = $nombre;
      $this->PVP = $PVP;
   }
}
