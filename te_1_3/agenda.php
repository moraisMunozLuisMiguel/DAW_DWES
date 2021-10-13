<!DOCTYPE HTML>
<html>

<head>
   <meta charset="UTF-8">
   <title>Agenda Actividades</title>
   <?php
   /* 
   La función que compruenba que la actividad existe está separada del  formulario
   */
   include('funciones.inc.php');
   ?>
   <link rel="stylesheet" href=".\css\agenda.css">
</head>

<body>
   <div id="uno">Agenda</div>
   <div id="dos">
      <?php

      // Si el array agenda contiene  datos
      if (!empty($_POST['agenda'])) {
         /* Array con los datos introducidos separados por coma 
         explode pasa la cadena a array  */
         $array = explode(",", $_POST['agenda']);
         // $pos número de elementos almacenados el array
         $pos = count($array);
      } else {
         // Si el array agenda está vacío, reiniciamos las variables globales
         $array = array();
         $pos = 0;
      }

      // Si el campo actividad NO está vacío,
      if (!empty($_POST['actividad'])) {
         $actividad = $_POST['actividad'];
         // Si la actividad existe, almacenamos su índice 
         $si = existe($array, $actividad);
         // Si el campo hora NO está vacío
         if (!empty($_POST['hora'])) {
            $hora = $_POST['hora'];
            /* 
            Si el nombre que se introdujo ya existe en la agenda y se indica una nueva hora, se sustituirá la hora de inicio anterior. Si el índice es 0 (primer registro) hay que cambiar la hora 
            */
            if ($si || $si === 0) {
               $array[$si + 1] = $hora;
            } else {
               /* Si el nombre de actividad que se introdujo no existe (es nueva) en la agenda, y el campo hora está completado, se añadirá a la agenda, se almacena en la últimas posiciones del array 
               */
               $array[$pos] = $actividad;
               $array[$pos + 1] = $hora;
            }
         } else {
            // Si la actividad existe sin hora, se inicializa a NULL
            $hora = NULL;
            $si = existe($array, $actividad);
            // Comprobamos si existe o si el índice es 0 (el primer registro)
            if ($si || $si === 0) {
               /*Si el nombre de la actividad que se introdujo ya existe en la agenda y no se indica la hora de inicio, se eliminará de la agenda la entrada correspondiente a esa actividad, se elimina el registro y se reorganiza el array 
               */
               unset($array[$si]);
               unset($array[$si + 1]);
               $array = array_values($array);
            }
         }
      } else {
         // Si el campo actividad está vacío, se mostrará una advertencia
         echo "<p>NO HA INTRODUCIDO ACTIVIDAD</p>";
      }



      // Si hay datos, se muestran
      if (count($array) > 1) {
         // Mostramos una fila de la tabla por cada dato a presentar
         for ($i = 0; $i < count($array); $i += 2) {
            if ($array[$i] !== NULL && $array[$i + 1] !== NULL)
               echo  "<ul><li>" . $array[$i] . ": " . $array[$i + 1] . "</li></ul>";
         }
      }
      ?>
   </div>

   <div id="uno">Nueva Actividad</div>
   <div id="dos">

      <!-- Creamos un formulario para enviar sus datos por POST a la misma página -->
      <form name="formulario" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

         <p class="azul">Actividad:
            <input type="text" name="actividad" type="text" /><br />
         </p>
         <p class="azul">Hora:
            <input type="time" name="hora" type="text" /><br />
         </p>
         <!-- Creamos un campo oculto para enviar los datos  -->
         <!-- implode separa cada elemento del array  -->
         <input name="agenda" type="hidden" value="<?php if (isset($array)) echo implode(",", $array) ?>" />
         <input type="submit" name="nuevaActividad" value="Añadir Actividad" /><br /><br />

      </form>
      <?php
      /*  Para comprobar que los datos se han guardado en el array agenda se puede descomentar la función  var_dump() para mostrar la estructura, tipo y valor del array
       var_dump($array);
      */
      ?>

   </div>
</body>

</html>