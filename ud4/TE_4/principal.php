<?php  

//cookie
/*
$valor="PRUEBA";
setcookie("Anuncio", $valor);
setcookie("TestCookie", $valor, time()+60);  /* expira en 1 minuto */

//llamar al fichero en los que creo las clases.

include ("conexion.php");
$bd= new BaseDatos();
$conexion= $bd->conectar();

function eliminar($id){
  global $bd;
  $sql = "DELETE FROM cesta_lineas WHERE idcesta='".$_SESSION['idcesta']. "'and idcesta_lineas =".$id;
  $bd->eliminar($sql);
}
function calcularprecio($cantidad, $precio, $desc){
  $importe= $cantidad *  $precio * ((100-$desc)/100);
  return $importe;
}

function marcarComprado($idcesta){
  global $bd;
  $sql = "UPDATE cesta SET comprado='1' WHERE idcesta='". $_SESSION['idcesta']."'";
  $bd->update($sql);

}

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




$timeout_duration = 3600;
session_start();
$tiempo_limite=$_SESSION['logeado'] + $timeout_duration;
$time=time();
if ($tiempo_limite < $time) {
  // session timed out
  session_unset();
  //unset ($_SESSION['logeado']);
  header('Location: login.php');
} 

if (isset($_GET['cerrar'])){
  session_unset();
  header('Location: login.php');
  session_destroy();
  exit;
}
  
if (isset($_GET['eliminar'])){
  eliminar($_GET['eliminar']);
}

if (isset($_GET['comprar'])){
  marcarComprado($_SESSION['idcesta']);
  $_SESSION['idcesta']=obtenerCesta($_SESSION['userid']);
}

?>
<?php if ($_SESSION['admin']=='1'){ ?>
<html>
  <head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css" />
  </head>


  <body>
    <main class="contenedor">
      <header>
      <div class="titulo">
          <h1 >TIENDA BIRT - ADMIN</h1>
          </div>
          <div class="login">
              <form action="principal.php">
                <h2><?php echo $_SESSION['user']?></h2>
                <button name="cerrar">Cerrar sesion</button>
              </form>
          </div>
      </header>
      <nav class="menu">
        <ul>
          <li><a href='#'>Familia</a></li>
          <li><a href='#'>Tipo</a></li>
          <li><a href='fichaproducto.php'>Producto</a></li>
          <li><a href='usuarios.php'>Usuario</a></li>
        </ul>
      </nav> 
      
      
    </main>
  </body>
</html>
<?php } else
{ 
  // NORMAL -->

  include('compra.php');

  }?>





