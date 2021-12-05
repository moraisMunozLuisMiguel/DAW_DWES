<?php
/*Llama al fichero en el que se se crea la clase BaseDatos y sus funciones conectar,  
seleccionar, insertar, eliminar*/
include("conectar.php");
$bd = new BaseDatos();
$conexion = $bd->conectar();

function eliminar($idUsuario){
   global $bd;
   $sql = "DELETE FROM usuario WHERE idUsuario=" . $idUsuario;
   $bd->eliminar($sql);
}

function insertar($valores){
   global $bd;
   $sql = "INSERT INTO usuario (Nombre,Apellidos) VALUES ('$valores[0]','$valores[1]')";
   $bd->insertar($sql);
}

if (isset($_POST['eliminar'])) {
   eliminar($_POST['eliminar']);
}

if (isset($_POST['enviar'])) {
   $Nombre = $_POST['Nombre'];
   $Apellidos = $_POST['Apellidos'];
   $arr = array($Nombre, $Apellidos);
   insertar($arr);
}

?>

<html>

<head>
   <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="./css/estilo.css" />
</head>

<body>

   <div class="grid-container">
   
		<div class="grid-container2">
			<a href="index.php">INDEX</a>
		</div>
		
      <div class="grid-item1">USUARIO</div>
      
	  <div class="grid-item">
         <table>
            <thead>
               <tr>
                  <th>idUsuario</th>
                  <th>Nombre</th>
                  <th>Apellidos</th>
               </tr>
            </thead>
            <tbody>
               <?php
			   // Selecciona todos los registros de la tabla usuario
               $rusuario = $bd->seleccionar('Select * From usuario');
               while ($usuario = $rusuario->fetch_assoc()) {
               ?>
                  <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
                     <tr>
                        <td> <?php echo $usuario['idUsuario']; ?> </td>
                        <td> <?php echo $usuario['Nombre']; ?> </td>
                        <td> <?php echo $usuario['Apellidos']; ?> </td>
                        <td> <button type="submit" name="eliminar" value=
						<?php echo  $usuario['idUsuario']; ?>>Eliminar</button> </td>
                     </tr>
            </tbody>
            </form>
         <?php
               }
         ?>
         </table>
      </div>
	  
      <div class="grid-item">
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
				<ul>
				<li>
						<label for="Nombre">Nombre</label>
						<input type="text" name="Nombre">
					</li>
					<li>
						<label for="Apellidos">Apellidos</label>
						<input type="text" name="Apellidos">
					</li>
					<li>
						<input type="submit" name="enviar" value="Enviar">
					</li>
					</ul>
            </form>
      </div>
	  
   </div>
   
</body>

</html>