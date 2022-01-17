<?php  
//llamar al fichero en que se crearon las clases.

include ("conexion.php");
$bd= new BaseDatos();
$conexion= $bd->conectar();

function anadir($arr){
  global $bd;
  $sql = "INSERT INTO usuario (Nombre,Apellidos,UserName,Pass,Administrador)
          VALUES ('$arr[0]','$arr[1]','$arr[2]','$arr[3]','$arr[4]')";
  $bd->insertar($sql);
}

/*function comprobarUsuario($nombre){
  global $bd;
    $res=true;
    $query="Select * From usuario where UserName like '".$UserName."'"; 
    $resuser = $bd->seleccionar($query);
    $num_user=$resuser->num_rows;
    if ($num_user>0) {
      $res=false;
    }
}*/

session_start();
$timeout_duration=60;
if (!isset($_SESSION['logeado'])){
  header('Location: login.php');
  exit;
}
else{
  $tiempo_limite=$_SESSION['logeado'] + $timeout_duration;
  $time=time();
  if ($tiempo_limite < $time) {
    session_unset();
    header('Location: login.php');
    exit;
  }
}

/*if (isset($_GET['enviar'])){
    if (comprobarUsuario($_GET['Usuario'])){
      $pass=$_GET['Password'];
      $password_hash =password_hash($pass,PASSWORD_BCRYPT); 
      $arr= array($_GET['Usuario'],$password_hash,$_GET['Password']);
      anadir($arr);
    }
    else{
      echo("El usuario ya existe");
    }

}*/
if (isset($_GET['enviar'])){
	// hash
	$Pass=$_GET['Pass'];
    $password_hash =password_hash($Pass,PASSWORD_BCRYPT); 
    
	$arr= array($_GET['Nombre'],$_GET['Apellidos'],$_GET['UserName'],
	$password_hash,$_GET['Administrador']);
    anadir($arr);
}
?>

<html>
  <head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estiloficha.css" />
  </head>

  <body>
    <main class="contenedor">
      <header>

          <h1>USUARIO</h1>
		  USUARIO:  <?php echo $_SESSION['usuario']; ?><br/>
		 
      </header>
      <section class="anadir">
        <div class="formulario">
          <form action="usuario.php">
            <fieldset>
                <legend>Usuario:</legend>
				<label for="Nombre">Nombre</label>
                <input type="text" id="Nombre" name="Nombre" required><br><br>
				<label for="Apellidos">Apellidos</label>
                <input type="text" id="Apellidos" name="Apellidos" required><br><br>				
				<label for="UserName">UserName</label>
				<input type="text" id="UserName" name="UserName" required><br><br>
                <label for="Pass">Pass</label>
                <input type="password" id="Pass" name="Pass" required><br><br>
                <label for="Administrador">Administrador</label>
				<input type="text" id="Administrador" name="Administrador" required><br><br>
                <input type="submit" value="Submit" name="enviar">
            </fieldset>  
          </form>
        </div>
      </section>
    </main>
  </body>
</html>




