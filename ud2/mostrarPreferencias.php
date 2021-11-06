<?php
// Comenzamos la sesión para tratar las variables de sesión usadas
session_start();
// Si se ha pulsado el botón de borrar
if (isset($_POST['borrar'])) {
   // Preparamos el mensaje que nos avisará que los datos de sesión han sido eliminados
   $texto = "INFORMACIÓN DE SESIÓN ELIMINADA";
   // Eliminamos los valores de las variables utilizadas
   $idioma = $perfil = $zona = null;
   // Eliminamos las variables de sesion
   unset($_SESSION['preferencias']);
   // Comprobamos si se han recibido los datos de sesión 
} else if (isset($_SESSION['preferencias'])) {
   // Inicializamos las variables con los valores de sesión
   $idioma = $_SESSION['preferencias']['idioma'];
   $perfil = $_SESSION['preferencias']['perfil'];
   $zona = $_SESSION['preferencias']['zona'];
}
?>
<!DOCTYPE HTML>
<html>

<head>
   <meta charset="UTF-8">
   <title>Mostrar Preferencias</title>
   <link rel="stylesheet" type="text/css" href="./css/preferencias.css" />
</head>

<body>
   <!-- Si pulsamos el botón del formulario nos reenviará aquí -->
   <form id='datos' action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>
      <?php
      echo "<fieldset>";
      echo "   <legend>Preferencias</legend>";
      // Imprimimos el mensaje de datos borrados en el caso que hayamos pulsado su botón
      echo "   <span class='mensaje'>";
      if (isset($texto)) echo $texto;
      echo "   </span>";
      echo "   <div class='campo'>
                    <label class='etiqueta'>Idioma:</label>
                    <br /><label class='texto'>" . $idioma . "</label>
                </div>";
      echo "   <div class='campo'>
                    <label class='etiqueta'>Perfil p&uacute;blico:</label>
                    <br /><label class='texto'>" . $perfil . "</label>
                </div>";
      echo "   <div class='campo'>
                    <label class='etiqueta'>Zona horaria:</label>
                    <br /><label class='texto'>" . $zona . "</label>
                </div>";
      echo "   <input type='submit' value='Borrar preferencias' name='borrar' />";
      echo "   <div class='campo'>
                    <a href='preferencias.php'>Establecer preferencias</a>
                </div>";
      echo "</fieldset";
      ?>
   </form>
</body>

</html>