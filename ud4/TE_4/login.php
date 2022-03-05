<?php
require_once 'conexion.php';

$bd= new BaseDatos();
$conexion= $bd->conectar();



function obtenerCesta($userid){
    global $bd;
    $rescesta = $bd->seleccionar("Select idcesta From cesta where comprado= '0' and idusuario ='".$userid."'");
    $count = $rescesta->num_rows;
    if ($count>0){
      $cestalinea= $rescesta->fetch_assoc();
      if (is_null($cestalinea['idcesta'])){
        $id= null;
      }
      else{
        $id= $cestalinea['idcesta'];  
      }
      
    }else{
      $id=null;
    }
    return $id;
  }

  
function comprobar_usuario($user,$pass,$bd){

    $res=false;

   $query="Select * From Usuario where UserName like '".$user."'"; 
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
            $_SESSION['admin'] = $res['Administrador']; 
            $_SESSION['user'] = $res['UserName']; 
            $_SESSION['userid'] = $res['idusuario'];
            $_SESSION['idcesta']= obtenerCesta($res['idusuario']);
            
        } else {
            $res=false;
        }
        //$res=$usuario['Email'];
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
        
        if (isset($_POST['location'])){
            header("Location:usuarios.php");
            //$url .= '&location=' . urlencode($redirect);
            //header("Location:" . $url);
        }else{
            header("Location:principal.php");
            //header("Location: " . $url);
        }
        
    }
}
?>
<html>
    <head>
        <link rel="stylesheet" href="/css/estiloslogin.css"> 
             
    </head>
    <body>  
        <div class="container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">               
                <?php if(isset($_GET['page'])){?>
                <input type="hidden"  name="location" value="<?php echo htmlspecialchars($_GET['page'])?>">
                <?php }?>
                <div class="user">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario" name="usuario" value="<?php if (isset($usuario)) echo $usuario ?>">
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
    </body>
</html>