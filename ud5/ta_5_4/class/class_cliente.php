<?php
include("conexion.php");
$bd = new BaseDatos();
$conexion = $bd->conectar();
class Cliente
{

   private $customer_id;
   private $customer_name;
   private $customer_email;
   private $customer_contact;
   private $customer_address;
   private $country;
   private $product_id;

   public function __construct($customer_name, $customer_email, $customer_contact, $customer_address, $country, $product_id)
   {

      $this->customer_name = $customer_name;
      $this->customer_email = $customer_email;
      $this->customer_contact = $customer_contact;
      $this->customer_address = $customer_address;
      $this->country = $country;
      $this->product_id = $product_id;
   }


   public function guardarCliente()
   {

      global $bd;
      $sql = "INSERT INTO customers (customer_id,customer_name,customer_email,customer_contact,customer_address,country,product_id) 
        VALUES ('$this->customer_id','$this->customer_name','$this->customer_email',
        '$this->customer_contact','$this->customer_address','$this->country','$this->product_id')";

      $bd->insertar($sql);
   }

   public static function obtenerCliente($id)
   {

      global $bd;
      $data = [];
      /*$sql = "SELECT c.*,d.product_name FROM customers c inner join products d on c.product_id=d.product_id where customer_id='" . $id . "'";*/
      $resultado = $bd->seleccionar($sql);
      $clientes = mysqli_fetch_assoc($resultado);
      echo json_encode($clientes);
   }

   public static function obtenerClientes()
   {

      global $bd;
      $data = [];
      /*$sql="SELECT c.*,d.product_name FROM customers c inner join products d on c.product_id=d.product_id";*/
      $sql = "SELECT * FROM customers";


      $resultado = $bd->seleccionar($sql);

      while ($clientes = mysqli_fetch_assoc($resultado)) {
         $data[] = $clientes;
      }
      $var = json_encode($data);
      //echo "FIN";
      echo $var;
   }


   public static function eliminarUsuario($id)
   {
      global $bd;
      $sql = "DELETE FROM customers where customer_id='" . $id . "'";
      $resultado = $bd->eliminar($sql);
   }

   public static function modificarNombreCliente($id, $nombre)
   {
      global $bd;
      $sql = "UPDATE customers SET customer_name='$nombre' where customer_id='" . $id . "'";
      $resultado = $bd->update($sql);
   }



   public function getId()
   {
      return $this->customer_id;
   }
   public function setID($id)
   {
      $this->customer_id = $customer_id;
   }

   public function getName()
   {
      return $this->customer_name;
   }
   public function setName($n)
   {
      $this->customer_name = $n;
   }

   public function getEmail()
   {
      return $this->customer_email;
   }

   public function setEmail($email)
   {
      $this->customer_email = $email;
   }

   public function getContact()
   {
      return $this->customer_contact;
   }

   public function setContact($contact)
   {
      $this->customer_contact = $contact;
   }
   public function getAdress()
   {
      return $this->customer_address;
   }
   public function setAdress($adress)
   {
      $this->customer_address = $adress;
   }
   public function getCountry()
   {
      return $this->country;
   }
   public function setCountry($country)
   {
      $this->country = $country;
   }
}
