<!DOCTYPE html>
<html lang="es-ES">

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <link rel="stylesheet" href=".\css\biblioteca_get.css">
   <title>Biblioteca</title>
   <?php
   /* 
   Las funciones que chequean la dirección de correo, la fecha y el DNI están separadas del formulario */
   include_once('funciones.inc_get.php');
   ?>
</head>

<body>
   <?php
   $nombre = "";
   if (!empty($_GET["datos_intro"]) && is_array($_GET["datos_intro"])) {
      /* 
      Declaración de $x como un contador y del array datos_check  que guarda los datos chequeados  del array, la fecha y el DNI
      */
      $x = 1;
      $datos_check = array();
      /* 
      Recorremos el array datos_intro mostrando los datos introducidos y por medio del 
      contador x y el switch selecionamos la clave y el valor obtenidos por el método GET  para poder chequear  los campos email, fecha y DNI e ingresarlos en el array datos_check
      */
      foreach ($_GET["datos_intro"] as $clave => $datos) {
         /* He comentado las opciones que no necesitamos chequear */
         switch ($x) {
               /* case 1:
               if (empty($datos)) {
                  echo "El campo Nombre no puede estar vacío <br/>";
                  } else {
                  print "El  Nombre introducido es: "  . $datos . "<br />";
                  $nombre = $datos;
               }
               break;
               case 2:
               if (empty($datos)) {
                echo "El campo Apellidos no puede estar vacío <br/>";
                } else {
               print "Los Apellidos introducidos son: "  . $datos . "<br />";
                }
               break;
               case 3:
                if (empty($datos)) {
                echo "El campo Libro no puede estar vacío <br/>";
               } else {
               print "El Libro introducido es: "  . $datos . "<br />";
                }
               break; */
            case 4:
               if (empty($datos)) {
                  echo "El campo Email no puede estar vacío <br/>";
               } else {
                  if (comprobar_email($datos)) {
                     print "Mail correcto <br/>";
                     array_push($datos_check, $datos);
                  } else {
                     print "Mail incorrecto <br/>";
                     array_push($datos_check, "El email $datos  NO es correcto");
                  }
               }
               break;
            case 5:
               if (empty($datos)) {
                  echo "El campo Fecha Alquiler no puede estar vacío <br/>";
               } else {
                  $date = new DateTime($datos);
                  $datos = $date->format('d-m-Y');
                  $fecha_a = fechaAlquiler($datos, "10 days");
                  print "La fecha de vuelta: " .  $fecha_a . "<br />";
                  array_push($datos_check, $fecha_a);
               }
               break;
            case 6:
               $num = substr($datos, 0, -1);
               $cadena = substr($datos, 0, 1);
               if (empty($datos)) {
                  echo "El campo DNI no puede estar vacío <br/>";
               }
               /* 
               Por medio de una expresión regular evito que se produzca una excepción al introducir una letra en los primeros 8 caracteres 
               */ elseif (preg_match("/[a-zA-z]/", $cadena) == 1) {
                  echo "DNI  $datos no valido <br/>";
                  array_push($datos_check, "DNI $datos no valido");
                  break;
               }
               /* 
               Evito una excepción al introducir un DNI con menos de 8 numeros
               */ elseif (strlen($num) < 8) {
                  echo "DNI  $datos no valido <br/>";
                  array_push($datos_check, "DNI $datos no valido");
               } else {

                  if (validar_dni("$datos")) {
                     array_push($datos_check, validar_dni("$datos"));
                  }
                  array_push($datos_check, "DNI $datos no valido");
               }
         }
         $x++;
      }
      /*  Para comprobar que los datos chequeados se han guardado en el array datos_check se puede descomentar la función  var_dump() para mostrar la estructura, tipo y valor del array
      var_dump($datos_check);
      */
   }

   ?>

   <!-- Formulario con el método GET  utilizando el array datos_intro -->
   <form action="biblioteca_get.php" method="get">
      <br /><br />Nombre: <br />
      <!--<input type="text" name="datos_intro['NOMBRE']" /><br /><br /><br> -->
      <input type="text" name="datos_intro['NOMBRE']" value="<?php echo $nombre; ?>" /><br /><br /><br>


      Apellidos: <br />
      <input type=" text" name="datos_intro['APELLIDOS']" /><br /><br /><br />
      Libro: <br />
      <input type="text" name="datos_intro['LIBRO']" /><br /><br /><br />
      Email: <br>
      <input type="text" name="datos_intro['EMAIL']" /><br /></br><br />
      Fecha Alquiler: <br>
      <input type="date" name="datos_intro['FECHA ALQUILER']" /><br /><br /><br />
      DNI: <br>
      <input type="text" name="datos_intro['DNI']" /><br /><br /><br><br />
      <input type="submit" name="enviar" value="Enviar" /><br /><br />
   </form>

</body>

</html>