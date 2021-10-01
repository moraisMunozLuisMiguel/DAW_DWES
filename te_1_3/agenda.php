<!DOCTYPE HTML>
<html>

<head>
   <meta charset="UTF-8">
   <title>Agenda Actividades</title>
   <?php
   /* 
   La función que compruenba que la actividad existe está separada del  formulario
   */
   include('funciones.inc');
   ?>
   <link rel="stylesheet" href=".\css\agenda.css">
</head>

<body>
   <div id="uno">Agenda</div>
   <div id="dos">
      <?php

      if (!empty($_POST['agenda'])) {
         // Array con todos los datos antiguos indicándole que están separados por coma 
         $array = explode(",", $_POST['agenda']);
         // $pos número de elementos almacenados
         $pos = count($array);
      } else {
         // Si no hay datos antiguos, reiniciamos las variables globales
         $array = array();
         $pos = 0;
      }
      if (!empty($_POST['actividad'])) {
         $actividad = $_POST['actividad'];
         // Si la actividad existe, almacenamos su índice 
         $si = existe($array, $actividad);
         if (!empty($_POST['hora'])) {
            // Hay actividad y hora
            /* 
            Si el nombre de actividad está vacío, se mostrará una advertencia.
            Si el nombre de actividad que se introdujo no existe en la agenda, y el campo hora está completado, se añadirá a la agenda.
            Si el nombre que se introdujo ya existe en la agenda y se indica una nueva hora, se sustituirá la hora de inicio anterior.
            Si el nombre de la actividad que se introdujo ya existe en la agenda y no se indica la hora de inicio, se eliminará de la agenda la entrada correspondiente a esa actividad.
            */
            $hora = $_POST['hora'];
            // Comprobamos si existe o si el índice es 0 (el primer registro)
            if ($si || $si === 0) {
               // Si la actividad existe hay que cambiar su hora
               // $i es donde se encuentra la actividad y en $i+1 es donde está la hora
               $array[$si + 1] = $hora;
            } else {
               /* Si la actividad es nueva y tiene horario se almacena en la últimas posiciones del array */
               $array[$pos] = $actividad;
               $array[$pos + 1] = $hora;
            }
         } else {
            // Hay actividad sin hora, se inicializa a NULL
            $hora = NULL;
            // Comprobamos si la actividad existe 
            $si = existe($array, $actividad);
            // Comprobamos si existe o si el índice es 0 (el primer registro)
            if ($si || $si === 0) {
               // Si existe la actividad y no se ha introducido hora se elimina el registro
               unset($array[$si]);
               unset($array[$si + 1]);
               // Una vez eliminado esos índices se reorganiza el array
               $array = array_values($array);
            }
         }
      } else {
         // NO hemos introducido ninguna actividad

      }
      // Si hay datos que mostrar, lo hacemos
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
         <!-- Creamos un campo oculto para enviar los datos ya recogidos con anterioridad -->
         <input name="agenda" type="hidden" value="<?php if (isset($array)) echo implode(",", $array) ?>" /> <input type="submit" name="nuevaActividad" value="Añadir Actividad" /><br /><br />

      </form>
      <?php
      var_dump($array);
      if (!empty($_POST['agenda'])) {
         if (empty($_POST['actividad'])) {
            echo "<p>NO HA INTRODUCIDO LA ACTIVIDAD</p>";
         }
      }
      ?>


   </div>
</body>

</html>