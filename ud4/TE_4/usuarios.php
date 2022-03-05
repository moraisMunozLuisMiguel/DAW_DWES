<?php  
//llamar al fichero en lso que creo las clases.

include ("conexion.php");
$bd= new BaseDatos();
$conexion= $bd->conectar();
function eliminar($id){
  global $bd;
  $sql = "DELETE FROM usuario WHERE idusuario =".$id;
  $bd->eliminar($sql);
}
function anadir($arr){
  global $bd;
  $sql = "INSERT INTO usuario (Nombre,Apellidos,UserName,Pass,Administrador)
          VALUES ('$arr[0]','$arr[1]','$arr[2]','$arr[3]',$arr[4])";
  $bd->insertar($sql);
}

$timeout_duration = 3600;
session_start();

if (!isset($_SESSION['logeado'])){
  header('Location: login.php?page='. urlencode($_SERVER['REQUEST_URI']));
  exit;
}
else{
  $tiempo_limite=$_SESSION['logeado'] + $timeout_duration;
  $time=time();
  if ($tiempo_limite < $time) {
    // session timed out
    session_unset();
    //unset ($_SESSION['logeado']);
    header('Location: login.php?page='. urlencode($_SERVER['REQUEST_URI']));
    exit;
}
}

if (isset($_GET['eliminar'])){
    eliminar($_GET['eliminar']);
}

if (isset($_GET['enviar'])){
    //hash
    $pass=$_GET['Password'];
    $password_hash =password_hash($pass,PASSWORD_BCRYPT);
    $admin=0;
    if (isset($_GET['Admin'])){
      $admin=1;
    }
    $arr= array($_GET['Nombre'],$_GET['Apellidos'],$_GET['UserName'],$password_hash,$admin);
    anadir($arr);
}



?>

<html>
  <head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="\css\estiloficha.css" />
  </head>

  <body>
    <main class="contenedor">
      <header>
          <a href="principal.php"> <img src="/img/birt1.png" alt="" width="100" height="70"></a>
          <h1>Producto</h1>
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
            $resprod = $bd->seleccionar('Select * From usuario');
            while ($producto=$resprod->fetch_assoc()){
          ?>
          <form action="usuarios.php" methog="GET">
            <tr>
                
                <td> <?php echo $producto['Nombre']; ?> </td>
                <td> <?php echo $producto['Apellidos']; ?> </td>
                <td> <?php echo $producto['UserName']; ?> </td>
                <td> <?php echo $producto['Pass']; ?> </td>
                <td> <?php echo $producto['Administrador']; ?> </td>
                <td> <button type="submit" name="eliminar" value=<?php echo $producto['idusuario']; ?>>Eliminar</button> </td>
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
          <form action="usuarios.php">
            <fieldset>
                <legend>Usuario:</legend>
                <label for="Nombre">Nombre</label>
                <input type="text" id="Nombre" name="Nombre"><br><br>
                <label for="Apellidos">Apellidos</label>
                <input type="text" id="Apellidos" name="Apellidos"><br><br>
                <label for="UserName">UserName</label>
                <input type="text" id="UserName" name="UserName"><br><br>
                <label for="Password">Password</label>
                <input type="password" id="Password" name="Password"><br><br>
                <label for="Admin">Admin</label>
                <input type="checkbox" id="Admin" name="Admin">
                <input type="submit" value="Submit" name="enviar">
            </fieldset>  
          </form>
        </div>
      </section>
    </main>
  </body>

</html>




