<?php
/*Llama al fichero en el que se se crea la clase BaseDatos y sus funciones*/

include("conectar.php");
$bd = new BaseDatos();
$conexion = $bd->conectar();

session_start();
$timeout_duration=60;
if (!isset($_SESSION['logeado'])){
  header('Location: login.php');
  exit;
}
else{
  $tiempo_limite=$_SESSION['logeado'] + $timeout_duration;
  $time=time();
  if ($tiempo_limite < $time) {
    session_unset();
    header('Location: login.php');
    exit;
  }
}
function eliminar_cesta($idProducto){
   global $bd;
  $sql="UPDATE cesta_lineas SET cantidad=0 WHERE IdProducto=".$idProducto;
   $bd->eliminar($sql);
}

if (isset($_GET['eliminar_cesta'])) {
   eliminar_cesta($_GET['eliminar_cesta']);
}


function actualizar_cesta($idProducto, $cantidad){
  global $bd;
  $sql= "UPDATE cesta_lineas SET cantidad=".$cantidad." WHERE IdProducto=".$idProducto;
  $bd->actualizar_cesta($sql);
}

if (isset($_GET['actualizar_cesta'])){
  $idProducto=$_GET['actualizar_cesta'];
  $cantidad=$_GET['cantidad'];
  actualizar_cesta($idProducto,$cantidad);
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
		
		<div class="grid-item1">
			
			<H1>Producto - <?php echo $_GET['nombreTipoProducto']; ?></H1>
		</div>
	  
		<div class="grid-container2">
	  
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
							<th>Cantidad</th>
						</tr>
					</thead>
					<tbody>
						<?php
						/* Selecciona todos los registros de la tabla producto y tipo_producto que 
						coinciden con el idTipo_producto*/
						$rproducto = $bd->seleccionar('SELECT p.ProductoNombre, p.idProducto, 
						p.idTipo_producto, p.Unidad, p.Descripcion, p.pvpUnidad, p.Descuento, 
						cl.Cantidad FROM producto p, cesta_lineas cl WHERE p.idProducto=
						cl.idProducto AND cl.idCesta = 1 AND p.idTipo_producto='. $_GET['idTipo_producto']) ;
						while ($producto = $rproducto->fetch_assoc()) {
							?>
							<form action="<?= $_SERVER['PHP_SELF']; ?>" method="GET">
								<tr>
									<td> <?php echo $producto['ProductoNombre']; ?> </td>
									<td> <?php echo $producto['idTipo_producto']; ?> </td>
									<td> <?php echo $producto['Unidad']; ?> </td>
									<td> <?php echo $producto['Descripcion']; ?> </td>
									<td> <?php echo $producto['pvpUnidad']; ?> </td>
									<td> <?php echo $producto['Descuento']; ?> </td>
									<td> <input type="text" name="cantidad" value=<?php echo 
									$producto['Cantidad']; ?>> </td>
									<input type="hidden" name="idTipo_producto" value=<?php echo 
									$producto['idTipo_producto']; ?>> 
									<?php
									$rtipo_producto = $bd->seleccionar('Select tp.DescTipoProd From 
									tipo_producto tp, producto p WHERE tp.idTipo_producto=
									'. $_GET['idTipo_producto']);
									while ($tipo_producto = $rtipo_producto->fetch_assoc()) { 
										?>
										<input type="hidden" name="nombreTipoProducto" value=
										<?php echo $tipo_producto['DescTipoProd']; ?>> 
										<?php
									}
									?>
									<td> <button type="submit" name="actualizar_cesta" value=<?php echo  
									$producto['idProducto']; ?>>Modificar</button> </td>
									<td> <button type="submit" name="eliminar_cesta" value=
									<?php echo  
									$producto['idProducto']; 
									?>>Eliminar</button> </td>
								</tr>
							</form>
					</tbody>
					<?php
					}
					?>
				</table>
			</div>
	  
			<div class="grid-item">
				<table>
					<thead>
						<tr>
							<th>Nombre</th>
							<th>PVP</th>
							<th>Descuento</th>
							<th>Cantidad</th>
							<th>Importe</th>
						</tr>
					</thead>
					<tbody>
						<?php
						/* Cesta*/
						$rproducto = $bd->seleccionar('SELECT p.ProductoNombre, p.idProducto, 
						p.idTipo_producto, p.Unidad, p.Descripcion, p.pvpUnidad, p.Descuento, 
						cl.Cantidad, ((-((p.pvpUnidad/100)*p.Descuento)+p.pvpUnidad) * cl.Cantidad) 
						AS Importe FROM producto p, cesta_lineas cl WHERE p.idProducto=
						cl.idProducto');
						while ($producto = $rproducto->fetch_assoc()) {
							if (($producto['Cantidad'] > 0) AND ($producto['idTipo_producto'] = $_GET['idTipo_producto'])) {
								?>
								<form action="<?= $_SERVER['PHP_SELF']; ?>" method="GET">
									<tr>
										<td> <?php echo $producto['ProductoNombre']; ?> </td>
										<td> <?php echo $producto['pvpUnidad']; ?> </td>
										<td> <?php echo $producto['Descuento']; ?> </td>
										<td> <input type="text" name="cantidad" value=<?php echo 
										$producto['Cantidad']; ?>> </td>
										<td><?php echo $producto['Importe']; ?></td>
										<?php
										$rtipo_producto = $bd->seleccionar('Select tp.DescTipoProd From 
										tipo_producto tp, producto p WHERE tp.idTipo_producto=
										'. $_GET['idTipo_producto']);
										while ($tipo_producto = $rtipo_producto->fetch_assoc()) { 
											?>
											<input type="hidden" name="nombreTipoProducto" value=
											<?php echo $tipo_producto['DescTipoProd']; ?>> 
										<?php
										}
										?>
										<input type="hidden" name="idTipo_producto" value= 
										<?php echo $producto['idTipo_producto']; ?>> 
										<td> <button type="submit" name="eliminar_cesta" value=
										<?php echo  $producto['idProducto']; ?>>Eliminar</button> </td>
									</tr>
								</form>
					</tbody>
					<?php
					}
					}
					?>
				</table>
			</div>
		
		</div>
	
	</div>
    
</body>

</html>