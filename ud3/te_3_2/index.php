<?php
/*Llama al fichero en el que se se crea la clase BaseDatos y sus funciones*/

include("conectar.php");
$bd = new BaseDatos();
$conexion = $bd->conectar();

function eliminar_cesta($idProducto){
   global $bd;
  $sql="UPDATE cesta_lineas SET cantidad=0 WHERE IdProducto=".$idProducto;
   $bd->eliminar($sql);
}

if (isset($_POST['eliminar_cesta'])) {
   eliminar_cesta($_POST['eliminar_cesta']);
} 

?>

<html>

<head>
   <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="./css/estilo.css" />
</head>

<body>

	<div class="grid-container">
   
		<div class="grid-item1">TIENDA BIRT</div>

		<div class="grid-item">
			<a href="fichaFamilias.php"><button type="button" class="btn">FAMILIA</button></a>
			<a href="fichaTipos.php"><button type="button" class="btn">TIPO</button></a>
			<a href="fichaProductos.php"><button type="button" class="btn">PRODUCTO</button></a>
			<a href="fichaUsuarios.php"><button type="button" class="btn">USUARIO</button></a>
		</div>
	  
		<div class="grid-container2">
	  
			<div class="grid-container2">
				<?php
				// Selecciona todos los registros de la tabla tipo_producto
				$rtipo_producto = $bd->seleccionar('Select * From tipo_producto');
				while ($tipo_producto = $rtipo_producto->fetch_assoc()) { ?>
               
					<div class="grid-item2">
						<a href="producto.php?nombreTipoProducto=
						<?php echo $tipo_producto['DescTipoProd']; ?>
						&idTipo_producto=<?php echo $tipo_producto['idTipo_producto']; ?>">
						<?php echo $tipo_producto['DescTipoProd']; ?>
						</a>
					</div>
			   
				<?php
				}
				?>
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
							if ($producto['Cantidad'] > 0) {
								?>
								<form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
									<tr>
										<td> <?php echo $producto['ProductoNombre']; ?> </td>
										<td> <?php echo $producto['pvpUnidad']; ?> </td>
										<td> <?php echo $producto['Descuento']; ?> </td>
										<td> <input type="text" name="cantidad" value=<?php echo 
										$producto['Cantidad']; ?>> </td>
										<td><?php echo $producto['Importe']; ?></td>
										<td> <button type="submit" name="eliminar_cesta" value=
										<?php echo  
										$producto['idProducto']; ?>>Eliminar</button> </td>
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