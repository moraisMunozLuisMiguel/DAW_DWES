<?php
require_once 'conexion.php';

$bd= new BaseDatos();
$conexion= $bd->conectar();

function comprobar_usuario($UserName,$Pass,$bd){
   $res=false;
   $query="Select * From usuario where UserName like '".$UserName."'"; 
   $resuser = $bd->seleccionar($query);
   $num_user=$resuser->num_rows;
	if ($num_user>0) {
        $res=$resuser->fetch_assoc();
        $stored=$res['Pass']; 
		if (password_verify($Pass,$stored)) {
            $timeout_duration = 3600;
            $time = $_SERVER['REQUEST_TIME'];
            $nombreUsuario = $_POST['UserName'];
			session_start();
            $_SESSION['logeado'] = time();
			$_SESSION['UserName'] = $nombreUsuario;
            $res=true;
        } else {
            $res=false;
        }
    }
    return $res;
}

if ($_SERVER['REQUEST_METHOD']=="POST"){
    $usu=comprobar_usuario($_POST['UserName'],$_POST['Pass'],$bd);
	$nombreUsuario=$_POST['UserName'];
    if($usu===FALSE){
        $usuario=$_POST['UserName'];
        echo "<p> Revise el usuario y contraseña </p>";
    }
    else{
			$_SESSION['usuario'] = $usu;
			$_SESSION['UserName'] = $nombreUsuario;	
			$usuarioLogeado = $_SESSION['UserName'];
			if(isset($_COOKIE[$usuarioLogeado])) {
				setcookie($usuarioLogeado, $_COOKIE[$usuarioLogeado]+1, time()+3600);
			} else {
				setcookie($usuarioLogeado, 1, time()+3600);
			}
			
			if (!isset($_COOKIE['comprar'])){
				$tiempoexp= time() + 3600;
				$cant=0;
				setcookie("comprar", $cant, $tiempoexp);
			}
			header("Location:principal.php");
    }
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
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">             
                <label for="UserName">UserName</label>
                <input type="text" id="UserName" name="UserName" value="<?php if (isset($UserName)) echo $UserName ?>">
                <label for="Pass">Pass</label>
                <input type="password" name="Pass" id="Pass">
                <input type="submit" name="enviar" id="enviar">     
            </form>
        </div>    
    </body>
</html>