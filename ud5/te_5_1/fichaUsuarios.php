<?php

include("conexion.php");

$bd = new BaseDatos();
$conexion = $bd->conectar();

function eliminar($id){
	global $bd;
	$sql = "DELETE FROM usuario WHERE idUsuario=" . $id;
	$bd->eliminar($sql);
}

function anadir($arr){
	global $bd;
	$sql = "INSERT INTO usuario (nombre,apellidos,userName,pass,administrador)
    VALUES ('$arr[0]','$arr[1]','$arr[2]','$arr[3]',$arr[4])";
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

if (isset($_GET['enviar'])){
    $pass=$_GET['pass'];
    $password_hash =password_hash($pass,PASSWORD_BCRYPT);
    $admin=0;
    if (isset($_GET['admin'])){
		$admin=1;
    }
    $arr= array($_GET['nombre'],$_GET['apellidos'],$_GET['userName'],$password_hash,$admin);
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
				<h1>USUARIOS</h1>
			</header>
			<section class="mostrar">
				<div class="table-scroll">  
					<table>
						<tr>
							<th>Nombre</th>
							<th>Apellidos</th>
							<th>UserName</th>
							<th>Password</th>
							<th>Admin</th>
						</tr>
						<?php
						$resusuario = $bd->seleccionar('Select * From usuario');
						while ($usuario=$resusuario->fetch_assoc()){
							?>
							<form action="fichaUsuarios.php" methog="GET">
								<tr>
									<td> <?php echo $usuario['nombre']; ?> </td>
									<td> <?php echo $usuario['apellidos']; ?> </td>
									<td> <?php echo $usuario['userName']; ?> </td>
									<td> <?php echo $usuario['pass']; ?> </td>
									<td> <?php echo $usuario['administrador']; ?> </td>
									<td> <button type="submit" name="eliminar" value=<?php echo $usuario['idUsuario']; ?>>Eliminar</button> </td>
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
					<form action="fichaUsuarios.php">
						<fieldset>
							<legend>Usuario:</legend>
							<label for="nombre">Nombre</label>
							<input type="text" id="nombre" name="nombre"><br><br>
							<label for="apellidos">Apellidos</label>
							<input type="text" id="apellidos" name="apellidos"><br><br>
							<label for="userName">UserName</label>
							<input type="text" id="userName" name="userName"><br><br>
							<label for="Password">Password</label>
							<input type="password" id="pass" name="pass"><br><br>
							<label for="Admin">Admin</label>
							<input type="checkbox" id="admin" name="admin">
							<input type="submit" value="Submit" name="enviar">
						</fieldset>  
					</form>
				</div>
			</section>
		</main>
	</body>
</html>