<?php

include("conexion.php");

$bd = new BaseDatos();
$conexion = $bd->conectar();

function anadir($idProd,$cant){
	global $bd;
	$sql="Select * From cestaLineas where idCesta='". $_SESSION['idCesta']."' and idProducto ='".$idProd."'";
	$rescesta = $bd->seleccionar($sql);
	$count = $rescesta->num_rows;
	if ($count>0) {
		$sql = "UPDATE cestaLineas SET cantidad=".$cant ."  WHERE idProducto =".$idProd ." and idCesta='". $_SESSION['idCesta']."'";
		$bd->update($sql);
	}else{
		if (is_null($_SESSION['idCesta'])){
			$userid=$_SESSION['userid'];
			$sql = "INSERT INTO cesta (idUsuario,comprado) VALUES ('$userid','0')";
			$bd->insertar($sql);
			$_SESSION['idCesta']=obtenerCesta($userid);
		}
		$sql = "INSERT INTO cestaLineas (idCesta,idProducto,cantidad)
		VALUES (".$_SESSION['idCesta'].",".$idProd.",".$cant.")";
		$bd->insertar($sql);
	}
}

function obtenerCesta($userid){
  global $bd;
  $rescesta = $bd->seleccionar("Select idCesta From cesta where comprado= '0' and idUsuario ='".$userid."'");
  $count = $rescesta->num_rows;
  if ($count>0){
    $cestaLinea= $rescesta->fetch_assoc();
    if (is_null($cestaLinea['idCesta'])){
      $id= null;
    }
    else{
      $id= $cestaLinea['idCesta'];  
    }
  }else{
    $id=null;
  }
  return $id;
}

function eliminar($id){
  global $bd;
  $sql = "DELETE FROM cestaLineas WHERE idCesta='".$_SESSION['idCesta']. "'and idCestaLineas =".$id;
  $bd->eliminar($sql);
}

function eliminarProd($id){
  global $bd;
  $sql = "DELETE FROM cestaLineas WHERE idCesta='".$_SESSION['idCesta']. "'and idProducto =".$id;
  $bd->eliminar($sql);
}

function cantidad($id){
  global $bd;
  $cant=0;
  $rescesta = $bd->seleccionar("Select * From cestaLineas where idCesta='".$_SESSION['idCesta']. "' and idProducto=".$id);
  $count= $rescesta->num_rows;
  if ($count>0){
    $cesta=$rescesta->fetch_assoc();
    $cant=$cesta['cantidad'];
  }
  return $cant;
}

function calcularPrecio($cantidad, $precio, $desc){
  $importe= $cantidad *  $precio * ((100-$desc)/100);
  return $importe;
}

$timeout_duration = 3600;
session_start();
$tiempo_limite=$_SESSION['logeado'] + $timeout_duration;
$time=time();

if ($tiempo_limite < $time) {
  session_unset();
  header('Location: login.php');
} 

if (isset($_GET['eliminar'])){
  eliminar($_GET['eliminar']);
}

if (isset($_GET['anadir'])){
  anadir($_GET['anadir'],$_GET['cant']);
}

if (isset($_GET['eliminarProd'])){
  eliminarProd($_GET['eliminarProd']);
}

?>

<html>
	<head>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="./css/estiloProd.css" />
	</head>
	<body>
		<main class="contenedor">
			<header>
				<div class="logo">
					<a href="principal.php"> <img src="./img/birt1.png" alt="" width="60%" height="70%"></a>
				</div>
				<h1 class="titulo">PRODUCTO - <?php echo $_GET['descTipoProd'];?></h1>
			</header>
			<section>
				<div class="prod">
					<table>
						<tr>
							<th>Nombre</th>
							<th>Tipo</th>
							<th>Unidad</th>
							<th>Descripcion</th>
							<th>PVP</th>
							<th>Descuento</th>
							<th>Cantidad</th>
						</tr>
						<?php
						$resprod = $bd->seleccionar('Select * From producto where idTipoProducto ='.$_GET['idTipoProducto']);
						while ($producto=$resprod->fetch_assoc()){
							?>
							<form action="producto.php" methog="GET">
								<tr>
									<td> <?php echo $producto['productoNombre']; ?> </td>
									<td> <?php echo $producto['idTipoProducto']; ?> </td>
									<td> <?php echo $producto['unidad']; ?> </td>
									<td> <?php echo $producto['descripcion']; ?> </td>
									<td> <?php echo $producto['pvpUnidad']; ?> </td>
									<td> <?php echo $producto['descuento']; ?> </td>
									<td><input type="text" name=cant value=<?php echo cantidad($producto['idProducto']) ?>></td>
										<input type="hidden" name="idTipoProducto" value=<?php echo $_GET['idTipoProducto']?>>
										<input type="hidden" name="descTipoProd" value=<?php echo $_GET['descTipoProd']?>>
									<td> <button type="submit" name="anadir" value=<?php echo  $producto['idProducto']; ?>>Anadir</button> </td>
									<td> <button type="submit" name="eliminarprod" value=<?php echo  $producto['idProducto']; ?>>Eliminar</button> </td>
								</tr>
							</form>
							<?php
							}
							?> 
					</table>
				</div>
				<div class= "cesta">
					<table>
						<tr>
							<th>Nombre</th>
							<th>Precio</th>
							<th>Descuento</th>
							<th>Cantidad</th>
							<th>Importe</th>
						</tr>
						<?php
						$sql="Select * From cesta a inner join cestaLineas b on a.idCesta=b.idCesta inner join producto c on b.idProducto=c.idProducto where comprado='0' and a.idCesta='".$_SESSION['idCesta']."'";
						$rescesta = $bd->seleccionar($sql);
						while ($cesta=$rescesta->fetch_assoc()){
							?>
							<form action="producto.php" methog="GET">
								<tr>
									<td> <?php echo $cesta['productoNombre']; ?> </td>
									<td> <?php echo $cesta['pvpUnidad']; ?> </td>
									<td> <?php echo $cesta['descuento']; ?> </td>
									<td> <?php echo $cesta['cantidad']; ?> </td>
									<td> <?php echo calcularprecio($cesta['cantidad'],$cesta['pvpUnidad'],$cesta['descuento']) ?> </td>
										<input type="hidden" name="idTipoProducto" value=<?php echo $_GET['idTipoProducto']?>>
										<input type="hidden" name="descTipoProd" value=<?php echo $_GET['descTipoProd']?>>
									<td> <button type="submit" name="eliminar" value=<?php echo  $cesta['idCestaLineas']; ?>>Eliminar</button> </td>
								</tr>
							</form>
						<?php
						}
						?>    
					</table>
				</div>
			</section>
		</main>
	</body>
</html>