<?php
/*Llama al fichero en el que se se crea la clase BaseDatos y sus funciones conectar,  
seleccionar, insertar, eliminar*/
include("conectar.php");
$bd = new BaseDatos();
$conexion = $bd->conectar();

function eliminar($idProducto){
   global $bd;
   $sql = "DELETE FROM producto WHERE IdProducto=" . $idProducto;
   $bd->eliminar($sql);
}

function insertar($valores){
   global $bd;
   $sql = "INSERT INTO producto (ProductoNombre,idTipo_producto,Unidad,
  Descripcion,pvpUnidad,Descuento) VALUES ('$valores[0]',$valores[1],'$valores[2]',
  '$valores[3]',$valores[4],$valores[5])";
   $bd->insertar($sql);
}

if (isset($_POST['eliminar'])) {
   eliminar($_POST['eliminar']);
}

if (isset($_POST['enviar'])) {
   $ProductoNombre = $_POST['ProductoNombre'];
   $idTipo_producto = $_POST['idTipo_producto'];
   $Unidad = $_POST['Unidad'];
   $Descripcion = $_POST['Descripcion'];
   $pvpUnidad = $_POST['pvpUnidad'];
   $Descuento = $_POST['Descuento'];
   $arr = array(
   $ProductoNombre, $idTipo_producto, $Unidad, $Descripcion,
   $pvpUnidad, $Descuento
   );
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
		
		<div class="grid-item1">PRODUCTO</div>
		
		<div class="grid-item">
			<table>
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Tipo</th>
						<th>Unidad</th>
						<th>Descripcion</th>
						<th>PVP</th>
						<th>Descuento</th>
					</tr>
				</thead>
				<tbody>
					<?php
					// Selecciona todos los registros de la tabla producto
					$rproducto = $bd->seleccionar('Select * From producto');
					while ($producto = $rproducto->fetch_assoc()) {
					?>
					<form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
						<tr>
							<td> <?php echo $producto['ProductoNombre']; ?> </td>
							<td> <?php echo $producto['idTipo_producto']; ?> </td>
							<td> <?php echo $producto['Unidad']; ?> </td>
							<td> <?php echo $producto['Descripcion']; ?> </td>
							<td> <?php echo $producto['pvpUnidad']; ?> </td>
							<td> <?php echo $producto['Descuento']; ?> </td>
							<td> <button type="submit" name="eliminar" value=
							<?php echo  $producto['idProducto']; ?>>Eliminar</button> </td>
						</tr>
					</form>
				</tbody>
				<?php
				}
				?>
			</table>
		</div>
		
		<div class="grid-item">
			<form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
				<ul>
					<li>
						<label>Producto</label>
					</li>
					<li>
						<label for="ProductoNombre">Nombre</label>
						<input type="text" name="ProductoNombre">
					</li>
					<li>
						<label for="idTipo_producto">idTipo_producto</label>
						<select name="idTipo_producto">
								<?php
								// Selecciona todos los registros de la tabla tipo_producto
								$rtipo_producto = $bd->seleccionar('Select * From tipo_producto');
								while ($tipo_producto = $rtipo_producto->fetch_assoc()) {
									?>
									<option><?php echo $tipo_producto['idTipo_producto']; ?></option>
									<?php
								}
								?>
						</select>
					</li>
					<li>
						<label for="Unidad">Unidad</label>
						<input type="text" name="Unidad">
					</li>
					<li>
						<label for="Descripcion">Descripcion</label>
						<input type="text" name="Descripcion">
					</li>
					<li>
						<label for="pvpUnidad">pvp</label>
						<input type="text" name="pvpUnidad">
					</li>
					<li>
						<label for="Descuento">Descuento</label>
						<input type="text" name="Descuento">
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