<?php
// Iniciamos sesion para capturar las variables
session_start();
$idioma = array("Español", "Inglés");
$perfil = array("Sí", "No");
$zona = array("GMT -2", "GMT -1", "GMT", "GMT +1", "GMT +2");
// Comprobamos si se han recibido los datos del formulario
if (isset($_POST['enviar'])) {
   // Se cargan en la sesion los datos recibidos del formulario por post
   $_SESSION['preferencias']['idioma'] = $_POST['idioma_'];
   $_SESSION['preferencias']['perfil'] = $_POST['perfil_'];
   $_SESSION['preferencias']['zona'] = $_POST['zona_'];
   $texto = "INFORMACIÓN GUARDADA EN LA SESIÓN";
   /* Se cargan las variables que usaremos en el formulario con los datos almacenados en la sesion */
   $idioma_ = $_SESSION['preferencias']['idioma'];
   $perfil_ = $_SESSION['preferencias']['perfil'];
   $zona_ = $_SESSION['preferencias']['zona'];
}
// Si se reciben datos de la sesión, se almacenan en sus correspondientes variables
if (isset($_SESSION['preferencias'])) {
   $idioma_ = $_SESSION['preferencias']['idioma'];
   $perfil_ = $_SESSION['preferencias']['perfil'];
   $zona_ = $_SESSION['preferencias']['zona'];
   /* Si no se han enviado datos de la sesión, se inicializan los valores de los 
   combos y los datos de sesión */
} else {
   //$idioma_ = $_SESSION['preferencias']['idioma'] = $idioma[0];
   //$perfil_ = $_SESSION['preferencias']['perfil'] = $perfil[0];
   //$zona_ = $_SESSION['preferencias']['zona'] = $zona[0];
   $idioma_ = $_SESSION['preferencias']['idioma'] = "";
   $perfil_ = $_SESSION['preferencias']['perfil'] = "";
   $zona_ = $_SESSION['preferencias']['zona'] = "";
}
?>
<!DOCTYPE HTML>
<html>

<head>
   <meta charset="UTF-8">
   <title>Preferencias</title>
   <link rel="stylesheet" type="text/css" href="./css/preferencias.css" />
</head>

<body>
   <form id='datos' action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>
      <?php
      echo "<fieldset>";
      echo "   <legend>Preferencias</legend>";
      // Lugar para el mensaje que pondremos cuando tengamos guardada la sesion
      echo "   <span class='mensaje'>";
      /* Comprobamos si se ha cargado el texto avisándonos que los datos están almacenados en la sesion */
      if (isset($texto)) echo $texto;
      echo "   </span>";
      echo "   <div class='campo'>";
      echo "       <label class='etiqueta'>Idioma:</label>";
      echo "           <select name='idioma_'>";
      foreach ($idioma as $i => $value) {
         echo "           <option value='" . $idioma[$i] . "' ";
         /* Comprobamos (si hemos recibido valores por post) si coincide el valor
         presentado con el valor recibido, en cuyo caso lo seleccionamos */
         if ($idioma[$i] == $idioma_) echo "selected";
         echo ">" . $idioma[$i] . "</option>";
      }
      echo "           </select>
                    </div>";
      echo "       <div class='campo'>";
      echo "           <label class='etiqueta'>Perfil p&uacute;blico:</label>";
      echo "           <select name='perfil_'>";
      foreach ($perfil as $i => $value) {
         echo "<option value='" . $perfil[$i] . "' ";
         /* Comprobamos si coincide el valor presentado con el valor recibido,
         si se han recibido datos por post, y entonces lo seleccionamos */
         if ($perfil[$i] == $perfil_) echo "selected";
         echo ">" . $perfil[$i] . "</option>";
      }
      echo "           </select>
                    </div>";
      echo "       <div class='campo'>";
      echo "           <label class='etiqueta'>Zona horaria:</label>";
      echo "           <select name='zona_'>";
      foreach ($zona as $i => $value) {
         echo "<option value='" . $zona[$i] . "' ";
         /* Comprobamos si el valor recibido por post es igual al valor presentado
         en cuyo caso lo seleccionamos */
         if ($zona[$i] == $zona_) echo "selected";
         echo ">" . $zona[$i] . "</option>";
      }
      echo "           </select>
                    </div>";
      echo "       <input type='submit' value='Establecer preferencias' name='enviar' />";
      echo "       <div class='campo'>
                        <a href='mostrarPreferencias.php'>Mostrar preferencias</a>
                    </div>
                </fieldset";
      echo "</form>";
      ?>
</body>

</html>