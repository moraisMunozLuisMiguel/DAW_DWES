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
            $timeout_duration = 60;
            $time = $_SERVER['REQUEST_TIME'];
			$nombreUsuario = $_POST['UserName'];
            session_start();
            $_SESSION['logeado'] = time();
			$_SESSION['usuario'] = $usuario;
			id($UserName);
			/*$_SESSION['IdUsuario'] = $nombreUsuario;*/
            $res=true;
        } else {
            $res=false;
        }
    }
    return $res;
}
function id($UserName){
	$query="Select idUsuario From usuario where UserName like '".$UserName."'"; 
	$resuser = $bd->seleccionar($query);
	$res=$resuser->fetch_row();
	echo $res;
}

if ($_SERVER['REQUEST_METHOD']=="POST"){
    $usu=comprobar_usuario($_POST['UserName'],$_POST['Pass'],$bd);
	$nombreUsuario=$_POST['UserName'];
    if($usu===FALSE){
        $usuario=$_POST['UserName'];
        echo "<p> Revise el usuario y contraseña </p>";
    }
    else{
            header("Location:usuario.php"); 
			$_SESSION['usuario'] = $usu;
			/*$_SESSION['UserName'] = $nombreUsuario;*/
    }
}
?>
<html>
    <head>
           
    </head>
    <body>  
        <div >
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