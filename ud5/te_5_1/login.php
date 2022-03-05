<?php

require_once 'conexion.php';

$bd= new BaseDatos();
$conexion= $bd->conectar();

function obtenerCesta($userid){
	global $bd;
    $rescesta = $bd->seleccionar("Select idCesta From cesta where comprado= '0' and idUsuario ='".$userid."'");
    $count = $rescesta->num_rows;
    if ($count>0){
		$cestalinea= $rescesta->fetch_assoc();
		if (is_null($cestalinea['idCesta'])){
			$id= null;
		}else{
			$id= $cestalinea['idCesta'];  
		}
    }else{
		$id=null;
    }
    return $id;
}

function comprobar_usuario($user,$pass,$bd){
	$res=false;
	$query="Select * From usuario where userName like '".$user."'"; 
	$resuser = $bd->seleccionar($query);
	$num_user=$resuser->num_rows;
    if ($num_user>0) {
		$res=$resuser->fetch_assoc();
        $stored=$res['pass']; 
        if (password_verify($pass,$stored)) {
			$timeout_duration = 60;
            $time = $_SERVER['REQUEST_TIME'];
            session_start();
            $_SESSION['logeado'] = time();
            $_SESSION['admin'] = $res['administrador']; 
            $_SESSION['user'] = $res['userName']; 
            $_SESSION['userid'] = $res['idUsuario'];
            $_SESSION['idCesta']= obtenerCesta($res['idUsuario']);
			$usuarioLogeado = $_SESSION['user'];
			if(isset($_COOKIE[$usuarioLogeado])) {
				setcookie($usuarioLogeado, $_COOKIE[$usuarioLogeado]+1, time()+3600);
			}else {
				setcookie($usuarioLogeado, 1, time()+3600);
			}
			if (!isset($_COOKIE['comprar'])){
				$tiempoexp= time() + 3600;
				$cant=0;
				setcookie("comprar", $cant, $tiempoexp);
			}
        }else {
			$res=false;
        }
    }
    return $res;
}

if ($_SERVER['REQUEST_METHOD']=="POST"){
    $usu=comprobar_usuario($_POST['usuario'],$_POST['clave'],$bd);
    if($usu===FALSE){
        $usuario=$_POST['usuario'];
        echo "<p> Revise el usuario y contraseña </p>";
    }else{
        header("Location:principal.php");
    }
}

?>
<html>
    <head>
        <!-- <link rel="stylesheet" href="./css/estiloLogin.css"> -->   
		<link rel="stylesheet" href="./css/estiloLogin.css">  		
    </head>
    <body>  
		<main class="contenedor">
			<header>
				<div class="login">
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">               
						<?php 
						if(isset($_GET['page'])){
							?>
							<input type="hidden"  name="location" value="
							<?php echo htmlspecialchars($_GET['page'])?>">
						<?php 
						}
						?>
						<div class="user">
							<label for="usuario">Usuario</label>
							<input type="text" id="usuario" name="usuario" value="
							<?php if (isset($usuario)) echo $usuario ?>">
						</div>
						<div class="pwd">
							<label for="clave">Clave</label>
							<input type="password" name="clave" id="clave">
						</div>
						<div class="boton">
							<input type="submit" name="enviar" id="enviar"> 
						</div>   
					</form>							
				</div>
			</header>
		</main>
	</body>
</html>