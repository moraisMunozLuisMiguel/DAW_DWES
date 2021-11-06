<?php
// Abrir/reactivar la sesión.
session_start();
// Guardar información en la sesión.
$_SESSION['nombre' ] = 'LUIS MIGUEL';
$_SESSION['informacion'] =  // es una tabla ...
      array('nombre' =>'LUIS MIGUEL','apellidos'=>'MORAIS MUÑOZ' );
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
    <title>Sesión - Página 1</title>
  </head>
  <body>
    <div><a href="sesion_pagina2.php">Página 2</a></div>
  </body>
</html>