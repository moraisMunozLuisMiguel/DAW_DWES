<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 2 : Características del Lenguaje PHP -->
<!-- Solución a la tarea -->
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<link href="css/style.css" rel="stylesheet" type="text/css">  
<title>Agenda actividades</title>
</head>
<body>
    <?php
    if (isset($_POST['agenda'])){ //comprobamos que el array agenda este definida y no sea null
        $agenda = $_POST['agenda'];}
    else{
        $agenda = array(); // Creamos $agenda como un array vacío
    }

    if (isset($_POST['envio'])){
        $nueva_actividad = $_POST['actividad'];
        $nueva_hora = $_POST['hora'];
        if (empty($nueva_actividad))
            echo "<p style='color:red'>Debe introducir una actividad!!</p><br />";
        elseif (empty($nueva_hora))
            unset($agenda[$nueva_actividad]);
        else
            $agenda[$nueva_actividad] = $nueva_hora;
    }
    ?>
    <!-- Mostramos los contactos de la agenda -->

	<h2>Agenda</h2>

	<div class="form2">
    <?php
	 
		if (count($agenda) == 0)
			echo "<p>No hay actividades.</p>";
		else {
			echo "<ul>";
			foreach( $agenda as $actividad => $hora )
			echo "<li>".$actividad.': '.$hora."</li>";
			echo "</ul>";
		}
	
    ?>
   </div>
    <!-- Creamos el formulario de introducción de un nuevo contacto -->
    <h2>Nueva actividad</h2>
    <div class="form1">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" >
            <!-- Metemos los contactos ya existentes ocultos en el formulario -->
            <!-- Para ello, creamos un elemento hidden que cada vez que enviamos el formulario envia también un array de la agenda  -->
            <?php
            foreach( $agenda as $id => $task ) {
                echo '<input type="hidden" name="agenda['.$id.']" ';
                echo 'value="'.$task.'"/>';
            }
            ?>
            <label>Actividad:</label><input type="text" name="actividad"/><br />
            <label>Hora:</label><input type="time" name="hora" step="1" /><br />
            <input type="submit" name="envio" value="Añadir actividad"/><br />
        </form>
    </div>
    <br />
</body>
</html>