<!DOCTYPE html>
<html lang="es-ES">

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <link rel="stylesheet" href=".\css\biblioteca.css">
   <title>Biblioteca</title>
   <?php
   /* 
   Las funciones que chequean la dirección de correo, la fecha y el DNI están separadas del formulario 
   */
   include_once('funciones.inc.php');
   ?>
</head>

<body>

   <?php
   $nombre = $apellidos = $libro = $email = $fecha = $dni = $emailCheck = $fecha_a = $dni_check = "";
   if ($_SERVER["REQUEST_METHOD"] == "GET") {
      // Array el que se guardan los valores chequeados
      $datos_check = array();
      if (!empty($_GET["nombre"])) {
         $nombre = $_GET["nombre"];
      }
      if (!empty($_GET["apellidos"])) {
         $apellidos = $_GET["apellidos"];
      }
      if (!empty($_GET["libro"])) {
         $libro = $_GET["libro"];
      }
      if (!empty($_GET["email"])) {
         $email = $_GET["email"];
         if (comprobar_email($_GET["email"])) {
            $emailCheck = "Mail correcto";
         } else {
            $emailCheck = "Mail incorrecto";
         }
         array_push($datos_check, $emailCheck);
      }
      if (!empty($_GET["fecha"])) {
         $fecha = $_GET["fecha"];
         $date = new DateTime($fecha);
         $fecha_a = $date->format('d-m-Y');
         $fecha_a = fechaAlquiler($fecha_a, "10 days");
         array_push($datos_check, $fecha_a);
      }
      if (!empty($_GET["dni"])) {
         $dni = $_GET["dni"];
         /* 
         Antes de ejecutar la función validar_dni compruebo que el dato introducido no empieze por una letra y que  este formado por 8 números
         */
         if (preg_match("/[a-zA-z]/", substr($dni, 0, 1)) == 1) {
            $dni_check = "DNI  $dni no valido <br/>";
         } elseif (strlen(substr($dni, 0, -1)) < 8) {
            $dni_check =  "DNI  $dni no valido <br/>";
         } else {
            $dni_check = validar_dni($dni);
         }
      }
      array_push($datos_check, $dni_check);
   }
   ?>
   <div id="uno">
      <?php
      echo $emailCheck;
      echo "<br/>";
      echo $fecha_a;
      echo "<br/>";
      echo $dni_check;
      echo "<br/><br/>";
      ?>
   </div>
   <h1>TAREA EVALUATIVA UD1 - BIBLIOTECA</h1>
   <?php

   /*  Para comprobar que los datos chequeados se han guardado en el array datos_check se puede descomentar la función  var_dump() para mostrar la estructura, tipo y valor del array
   var_dump($datos_check);
      */

   ?>
   <div id="dos">
      <!-- Formulario con el método GET -->
      <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
         Nombre: <br />
         <input type="text" name="nombre" value="<?php echo $nombre; ?>"><br /><br />
         Apellidos: <br />
         <input type=" text" name="apellidos" value="<?php echo $apellidos; ?>"><br /><br />
         Libro: <br />
         <input type="text" name="libro" value="<?php echo $libro; ?>"><br /><br />
         Email: <br>
         <input type="text" name="email" value="<?php echo $email; ?>"><br /><br />
         Fecha Alquiler: <br>
         <input type="date" name="fecha" value="<?php echo $fecha; ?>"><br /><br />
         DNI: <br>
         <input type="text" name="dni" value="<?php echo $dni; ?>"><br /><br />
         <input type="submit" name="enviar" value="Enviar" /><br /><br />
      </form>
   </div>
</body>

</html>