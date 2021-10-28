<!DOCTYPE html>
<!--
		No podrá haber nombres repetidos en la agenda.
		En la parte superior de la página web se mostrará el contenido de la agenda.
		En la parte inferior debe figurar un sencillo formulario con dos cuadros de texto,
		uno para el nombre y otro para el número de teléfono.
		Cada vez que se envíe el formulario se comprobará:
		Si el nombre está vacío, se mostrará una advertencia.
		Si el nombre que se introdujo no existe en la agenda, y el número de teléfono no está vacío, se añadirá a la agenda.
		Si el nombre que se introdujo ya existe en la agenda y se indica un número de teléfono, se sustituirá el número de teléfono anterior.
		Si el nombre que se introdujo ya existe en la agenda y no se indica número de teléfono,
		se eliminará de la agenda la entrada correspondiente a ese nombre.
-->
<html>

<head>
   <meta http-equiv="content-type" content="text/html; charset=UTF-8">
   <title>Agenda Teléfonos</title>
   <?php
   /* 
   Las funciones están separadas del  formulario
   */
   include('funciones.inc_agenda.php');
   ?>
   <link rel="stylesheet" href=".\css\agenda_telefonos.css">

</head>
<!-- Comenzamos poniendo el foco del cursor en la pregunta de nombre -->

<body onload='document.forms.formulario.nombre.focus()'>
   <?php
   // Comprobamos que se han recibido los datos 'anteriores' por POST
   if (!empty($_POST['personas'])) {
      // Se crea un array con todos los datos antiguos indicándole que están separados por coma
      $array = explode(",", $_POST['personas']);
      // almacenamos en 'pos' el número de elementos almacenados
      $pos = count($array);
   } else {
      // Si no hay datos antiguos, sólo reiniciamos las variables globales
      $array = array();
      $pos = 0;
   }
   if (!empty($_POST['nombre'])) {
      // Hemos introducido un nuevo nombre y lo pasamos a minúsculas
      $nom = strtolower($_POST['nombre']);
      // Si el nombre existe ya, almacenamos su índice 
      $si = existe($array, $nom);
      if (!empty($_POST['telefono'])) {
         // Hay nombre y teléfono
         $tel = $_POST['telefono'];
         // Comprobamos si existe o si el índice es 0 (el primer registro)
         // Hacemos una comprobación estricta ya que si $i tiene el valor FALSE
         // ese valor es igual a 0, pero estrictamente 0 no es igual que FALSE
         if ($si || $si === 0) {
            // Si el nombre existe quiere decir que tenemos que cambiar su teléfono.
            // Cambiamos el valor para el índice del array siguiente al encontrado
            // ya que en $i es donde se encuentra el nombre y en $i+1 es donde está el tlf.
            $array[$si + 1] = $tel;
            // Avisamos que el tlf. se ha cambiado
            echo "<div class='altoDch1'><p>TELÉFONO CAMBIADO</p></div>";
         } else {
            // Si es un nombre nuevo y le hemos puesto tlf. los almacenamos en la últimas
            // posiciones del array
            $array[$pos] = $nom;
            $array[$pos + 1] = $tel;
            // Avisamos que hemos añadido el nombre y el tlf.
            echo "<div class='altoDch1'><p>DATOS AÑADIDOS</p></div>";
         }
      } else {
         // Hay nombre pero no teléfono, por lo que se inicializa a NULL
         $tel = NULL;
         // Comprobamos si el nombre existe ya
         $si = existe($array, $nom);
         // Comprobamos si existe o si el índice es 0 (el primer registro)
         // Hacemos una comprobación estricta ya que si $i tiene el valor FALSE
         // ese valor es igual a 0, pero estrictamente 0 no es igual que FALSE
         if ($si || $si === 0) {
            // Si existe el nombre y no se ha introducido el tlf quiere decir
            // que se ha de eliminar dicho registro
            unset($array[$si]);
            unset($array[$si + 1]);
            // Una vez eliminado esos índices se reorganiza el array
            $array = array_values($array);
            // Se informa de la eliminación realizada
            echo "<div class='altoDch1'><p>DATO ELIMINADO</p></div>";
         } else {
            // Si el nombre NO existe y no hemos tecleado el tlf., se avisa de ello
            echo "<div class='altoDch2'><p>FALTA EL TELÉFONO</p></div>";
         }
      }
   } else {
      // NO hemos introducido ningún nombre
      $nom = NULL;
      if (!empty($_POST['telefono'])) {
         // NO hay nombre pero SÍ teléfono
         echo "<div class='altoDch2'><p>FALTA EL NOMBRE</p></div>";
      } else {
         // NO hay nombre NI teléfono
         echo "<div class='altoDch2'><p>NO HA INTRODUCIDO DATOS</p></div>";
      }
   }
   // Si hay datos que mostrar, lo hacemos
   if (count($array) > 1) {
      echo "<h1>List&iacute;n telef&oacute;nico:</h1>";
      echo "<table><tr align='center'><th>Nombre</th><th>Tel&eacute;fono</th></tr>";
      // Mostramos una fila de la tabla por cada dato a presentar
      for ($i = 0; $i < count($array); $i += 2) {
         if ($array[$i] !== NULL && $array[$i + 1] !== NULL)
            echo "<tr><td>" . $array[$i] . "</td><td>" . $array[$i + 1] . "</td></tr>";
      }
      echo "</table>";
   }
   // Función para comprobar si un nombre existe en el array
   //existe($miArray, $miNom);

   ?>
   <!-- Creamos una capa en la parte inferior derecha para que no estorben las preguntas -->
   <div class="bajoDch">
      <!-- Creamos un formulario para enviar sus datos por POST a la misma página -->
      <form name="formulario" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
         <table style="border: 0px;">
            <tr style="background-color: #8080ff;">Introduzca los datos a a&ntilde;adir al list&iacute;n
               <!-- Solicitamos el nombre de la persona -->
               <td>
                  <fieldset>
                     <legend>Nombre</legend>
                     <input name="nombre" type="text" />
                  </fieldset>
               </td>
               <!-- Solicitamos el número de teléfono -->
               <td>
                  <fieldset>
                     <legend>Tel&eacute;fono</legend>
                     <input name="telefono" type="text" />
                  </fieldset>
               </td>
            </tr>
         </table>
         <!-- Creamos un campo oculto para enviar los datos ya recogidos con anterioridad -->
         <input name="personas" type="hidden" value="<?php if (isset($array)) echo implode(",", $array) ?>" style="text-align:right;" />
         <!-- Enviamos los datos del formulario -->
         <input type="submit" value="Aplicar cambios" />
      </form>
   </div>
</body>

</html>