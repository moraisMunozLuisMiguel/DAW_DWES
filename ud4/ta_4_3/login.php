<?php
require_once 'conexion.php';

$bd= new BaseDatos();
$conexion= $bd->conectar();

function comprobar_usuario($user,$pass,$bd){

    
   $res=false;
   $query="Select * From usuarios where Usuario like '".$user."'"; 
   $resuser = $bd->seleccionar($query);
   $num_user=$resuser->num_rows;
    if ($num_user>0) {
        $res=$resuser->fetch_assoc();
        $stored=$res['Pass']; 
        if (password_verify($pass,$stored)) {
            
            $timeout_duration = 60;
            $time = $_SERVER['REQUEST_TIME'];
            session_start();
            $_SESSION['logeado'] = time();
            $res=true;
        } else {
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
    }
    else{
            header("Location:usuario.php");        
    }
}
?>
<html>
    <head>
           
    </head>
    <body>  
        <div >
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">             
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" value="<?php if (isset($usuario)) echo $usuario ?>">
                <label for="clave">Clave</label>
                <input type="password" name="clave" id="clave">
                <input type="submit" name="enviar" id="enviar">     
            </form>
        </div>    
    </body>
</html>