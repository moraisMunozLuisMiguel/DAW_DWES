<?php

include("conexion.php");
$bd = new BaseDatos();
$conexion = $bd->conectar();

session_start();
$timeout_duration=3600;

if (isset($_POST['comprar'])){
    $cant=$_COOKIE['comprar'];
    setcookie("comprar", $cant+1);
}

if (!isset($_SESSION['logeado'])){
  header('Location: login.php');
  exit;
}else{
  $tiempo_limite=$_SESSION['logeado'] + $timeout_duration;
  $time=time();
  if ($tiempo_limite < $time) {
    session_unset();
    header('Location: login.php');
    exit;
  }
}



function eliminarProductoPrincipal($idProducto){
   global $bd;
	$query="Select * From usuario where UserName like '".$_SESSION['UserName']."'"; 
	$resuser = $bd->seleccionar($query);
	$res=$resuser->fetch_assoc();
	$id=$res['idUsuario'];
	$sql="UPDATE cesta_lineas SET cantidad=0 WHERE 
		idCesta =" .$id." AND IdProducto=".$idProducto;
   $bd->eliminarProductoPrincipal($sql);
}

if (isset($_POST['eliminarProductoPrincipal'])) {
   eliminarProductoPrincipal($_POST['eliminarProductoPrincipal']);
} 

function comprar($idCesta){
	global $bd;
	$sql="UPDATE cesta_lineas SET cantidad=0 WHERE 
	IdCesta=".$idCesta;
   $bd->comprar($sql);
}

if (isset($_POST['comprar'])) {
  comprar($_POST['comprar']);
} 

?>

<html>
	<head>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="./css/estilo.css" />
	</head>
	<body>
		<div class="grid-container">
			
			<div class="grid-item1">
				TIENDA BIRT <br/>
				<?php
				$query="Select * From usuario where UserName like '".$_SESSION['UserName']."'"; 
			$resuser = $bd->seleccionar($query);
			$res=$resuser->fetch_assoc();
			$id=$res['idUsuario'];
				$adm=$res['Administrador'];
				if($adm==1){
					?>
				VENTAS realizadas:  <?php echo $_COOKIE['comprar']; ?><br/>
				<?php
				}
				?>
			</div>
			
			<div class="grid-item1">
			USUARIO:  <?php echo $_SESSION['UserName']; ?><br/>
			<?php
			echo 'Total de Logins realizados: ' . $_COOKIE[$_SESSION['UserName']] . '<br/>';
			$query="Select * From usuario where UserName like '".$_SESSION['UserName']."'"; 
			$resuser = $bd->seleccionar($query);
			$res=$resuser->fetch_assoc();
			$id=$res['idUsuario'];
			$adm=$res['Administrador'];
			?>
			<a href="logout.php">Cerrar sesión</a>
			
			</div>
			<?php
			if($adm==1){
			?>
				<div class="grid-item">
					<a href="fichaFamilias.php"><button type="button" class="btn">FAMILIA</button></a>
					<a href="fichaTipos.php"><button type="button" class="btn">TIPO</button></a>
					<a href="fichaProductos.php"><button type="button" class="btn">PRODUCTO</button></a>
					<a href="fichaUsuarios.php"><button type="button" class="btn">USUARIO</button></a>
				</div>
			<?php
			}else{
			?>
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
								$query="Select * From usuario where UserName like '".$_SESSION['UserName']."'"; 
								$resuser = $bd->seleccionar($query);
								$res=$resuser->fetch_assoc();
								$id=$res['idUsuario'];
								$rproducto = $bd->seleccionar('SELECT p.ProductoNombre, p.idProducto, 
								p.idTipo_producto, p.Unidad, p.Descripcion, p.pvpUnidad, p.Descuento,
								cl.idCesta, cl.Cantidad, ((-((p.pvpUnidad/100)*p.Descuento)+p.pvpUnidad) * cl.Cantidad) 
								AS Importe FROM producto p, cesta_lineas cl WHERE p.idProducto=cl.idProducto
								AND cl.idCesta='.$id);
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
													<td> <button type="submit" name="eliminarProductoPrincipal" value=
													<?php echo  
													$producto['idProducto']; ?>>Eliminar</button> </td>
												</tr>
											</form>
											<?php
										}
									}
									?>
								</tbody>	
							</table>
							<table>
							<?php
							/* Compra*/
							$rproducto = $bd->seleccionar('SELECT p.ProductoNombre, p.idProducto, 
							p.idTipo_producto, p.Unidad, p.Descripcion, cl.idCesta, p.pvpUnidad, p.Descuento, 
							cl.Cantidad, ((-((p.pvpUnidad/100)*p.Descuento)+p.pvpUnidad) * cl.Cantidad) 
							AS Importe FROM producto p, cesta_lineas cl WHERE p.idProducto=
							cl.idProducto AND cl.idCesta='.$id);
							while ($producto = $rproducto->fetch_assoc()) {
								if ($producto['Cantidad'] > 0) {
								?>
									<form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
										<tr>
											<td> <button type="submit" name="comprar" value=
											<?php echo  $producto['idCesta']; ?>>Comprar</button> </td>
										</tr>
									</form>
										</table>
										<?php
									break;
								}
							}
			}
			?>	
			</div>
		</div>
	</body>
</html>