<?php
/*Llama al fichero en el que se se crea la clase BaseDatos y sus funciones*/

include("conectar.php");
$bd = new BaseDatos();
$conexion = $bd->conectar();

function eliminar($idFamilia){
   global $bd;
   $sql = "DELETE FROM familia WHERE IdFamilia=" . $idFamilia;
   $bd->eliminar($sql);
}

function insertar($valores){
   global $bd;
   $sql = "INSERT INTO familia (Familia) VALUES ('$valores[0]')";
   $bd->insertar($sql);
}

if (isset($_POST['eliminar'])) {
   eliminar($_POST['eliminar']);
}

if (isset($_POST['enviar'])) {
   $Familia = $_POST['Familia'];
   $arr = array($Familia);
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
	
		<div class="grid-item1">FAMILIA</div>
	
		<div class="grid-item">
			<table>
				<thead>
					<tr>
						<th>IdFamilia</th>
						<th>FAMILIA</th>
					</tr>
				</thead>
				<tbody>
               <?php
			   // Selecciona todos los registros de la tabla familia
               $rfamilia = $bd->seleccionar('Select * From familia');
               while ($familia = $rfamilia->fetch_assoc()) {
               ?>
                  <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
                     <tr>
                        <td> <?php echo $familia['idFamilia']; ?> </td>
                        <td> <?php echo $familia['Familia']; ?> </td>
                        <td> <button type="submit" name="eliminar" value=
						<?php echo  $familia['idFamilia']; ?>>Eliminar</button> </td>
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
						<label for="Familia">Familia</label>
						<input type="text" name="Familia">
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