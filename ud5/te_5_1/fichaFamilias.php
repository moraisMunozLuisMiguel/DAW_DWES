<?php

include("conexion.php");

$bd = new BaseDatos();
$conexion = $bd->conectar();

function eliminar($idFamilia){
	global $bd;
	$sql = "DELETE FROM familia WHERE idFamilia=" . $idFamilia;
	$bd->eliminar($sql);
}

function anadir($valores){
	global $bd;
	$sql = "INSERT INTO familia (familia) VALUES ('$valores[0]')";
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
	$Familia = $_GET['familia'];
	$arr = array($Familia);
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
				<h1>Familia</h1>
			</header>
			<section class="mostrar">
				<div class="table-scroll">  
					<table>
						<tr>
							<th>IdFamilia</th>
							<th>FAMILIA</th>
							<th>Eliminar</th>
						</tr>
						<?php
						$resfamilia = $bd->seleccionar('Select * From familia');
						while ($familia=$resfamilia->fetch_assoc()){
							?>
							<form action="fichaFamilias.php" methog="GET">
								<tr>
									<td> <?php echo $familia['idFamilia']; ?> </td>
									<td> <?php echo $familia['familia']; ?> </td>
									<td> <button type="submit" name="eliminar" value=<?php echo  $familia['idFamilia']; ?>>Eliminar</button> </td>
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
					<form action="fichaFamilias.php">
						<fieldset>
							<legend>Familia:</legend>
							<label for="familia">Nombre</label>
							<input type="text" id="familia" name="familia"><br><br>
							<input type="submit" value="Submit" name="enviar">
						</fieldset>  
					</form>
				</div>
			</section>
		</main>
	</body>
</html>