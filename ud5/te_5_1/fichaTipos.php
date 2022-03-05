<?php

include("conexion.php");

$bd = new BaseDatos();
$conexion = $bd->conectar();

function eliminar($idTipoProducto){
	global $bd;
	$sql = "DELETE FROM tipoProducto WHERE idTipoProducto=" . $idTipoProducto;
	$bd->eliminar($sql);
}

function anadir($valores){
	global $bd;
	$sql = "INSERT INTO tipoProducto (descTipoProd,idFamilia) VALUES ('$valores[0]',
	$valores[1])";
	$bd->insertar($sql);
}

$timeout_duration = 3600;
session_start();

if (!isset($_SESSION['logeado'])){
	header('Location: login.php?page='. urlencode($_SERVER['REQUEST_URI']));
	exit;
}else{
	$tiempo_limite=$_SESSION['logeado'] + $timeout_duration;
	$time=time();
	if ($tiempo_limite < $time) {
		session_unset();
		header('Location: login.php?page='. urlencode($_SERVER['REQUEST_URI']));
		exit;
	}
}



if (isset($_GET['eliminar'])) {
	eliminar($_GET['eliminar']);
}

if (isset($_GET['enviar'])) {
	$DescTipoProd = $_GET['descTipoProd'];
	$idFamilia = $_GET['idFamilia'];
	$arr = array($DescTipoProd,$idFamilia);
	anadir($arr);
}

?>

<html>
	<head>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="./css/estiloFicha.css" />
	</head>
	<body>
		<main class="contenedor">
			<header>
				<a href="principal.php"> <img src="./img/birt1.png" alt="" width="100" height="70"></a>
				<h1>Tipo de Producto</h1>
			</header>
			<section class="mostrar">
				<div class="table-scroll">  
					<table>
						<tr>
							<th>IdTipoProducto</th>
							<th>DescTipoProducto</th>
							<th>idFamilia</th>
							<th>Eliminar</th>
						</tr>
						<?php
						$rtipoProducto = $bd->seleccionar('Select * From tipoProducto');
						while ($tipoProducto=$rtipoProducto->fetch_assoc()){
							?>
							<form action="fichaTipos.php" method="GET">
								<tr>
									<td> <?php echo $tipoProducto['idTipoProducto']; ?> </td>
									<td> <?php echo $tipoProducto['descTipoProd']; ?> </td>
									<td> <?php echo $tipoProducto['idFamilia']; ?> </td>
									<td> <button type="submit" name="eliminar" 
									value=<?php echo  $tipoProducto['idTipoProducto']; ?>>Eliminar</button> </td>
								</tr>
							</form>
						<?php
						}
						?> 
					</table>
				</div>
			</section>
			<section class="anadir">
				<div class="formulario">
					<form action="fichaTipos.php">
						<fieldset>
							<legend>Tipo de Producto:</legend>
							<label for="descTipoProducto">Nombre</label>
							<input type="text" id="descTipoProducto" name="descTipoProd"><br><br>
							<label for="idFamilia">idFamilia</label>
							<select name = "idFamilia">
								<?php
								$rfamilia = $bd->seleccionar('Select * From familia');
								while ($familia = $rfamilia->fetch_assoc()) {
									?>
									<option> <?php echo $familia['idFamilia']; ?> </option>
									<?php
								}
								?>
							</select>
							<input type="submit" value="Enviar" name="enviar">
						</fieldset>  
					</form>
				</div>
			</section>
		</main>
	</body>
</html>