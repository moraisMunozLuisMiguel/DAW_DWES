<?php

include("conexion.php");
$bd = new BaseDatos();
$conexion = $bd->conectar();

session_start();
$timeout_duration=3600;
if (!isset($_SESSION['logeado'])){
  header('Location:login.php');
  exit;
}
else{
  $tiempo_limite=$_SESSION['logeado'] + $timeout_duration;
  $time=time();
  if ($tiempo_limite < $time) {
    session_unset();
    header('Location:login.php');
    exit;
  }
}

function insertar($valores)
{
   global $bd;
   $sql = "INSERT INTO usuario (Nombre,Apellidos,UserName,Pass,Administrador) VALUES ('$valores[0]','$valores[1]','$valores[2]','$valores[3]','$valores[4]')";
   $bd->insertar($sql);
}

if (isset($_POST['enviar'])){
	// hash
	$Pass=$_POST['Pass'];
    $password_hash =password_hash($Pass,PASSWORD_BCRYPT); 
    
	$arr= array($_POST['Nombre'],$_POST['Apellidos'],$_POST['UserName'],
	$password_hash,$_POST['Administrador']);
    insertar($arr);
}

function eliminar($idUsuario)
{
   global $bd;
   $sql = "DELETE FROM usuario WHERE idUsuario=" . $idUsuario;
   $bd->eliminar($sql);
}

if (isset($_POST['eliminar'])) {
   eliminar($_POST['eliminar']);
}

?>

<html>

<head>
   <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="./css/estilo.css" />
</head>

<body>

   <div class="grid-container">

      <div class="grid-container2">
         <a href="principal.php">PRINCIPAL</a>
      </div>

      <div class="grid-item1">USUARIO</div>

      <div class="grid-item">
         <table>
            <thead>
               <tr>
                  <th>idUsuario</th>
                  <th>Nombre</th>
                  <th>Apellidos</th>
                  <th>UserName</th>
                  <th>Pass</th>
                  <th>Administrador</th>
               </tr>
            </thead>
            <tbody>
               <?php
               // Selecciona todos los registros de la tabla usuario
               $rusuario = $bd->seleccionar('Select * From usuario');
               while ($usuario = $rusuario->fetch_assoc()) {
               ?>
                  <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
                     <tr>
                        <td> <?php echo $usuario['idUsuario']; ?> </td>
                        <td> <?php echo $usuario['Nombre']; ?> </td>
                        <td> <?php echo $usuario['Apellidos']; ?> </td>
                        <td> <?php echo $usuario['UserName']; ?> </td>
                        <td> <?php echo $usuario['Pass']; ?> </td>
                        <td> <?php echo $usuario['Administrador']; ?> </td>
                        <td> <button type="submit" name="eliminar" value=<?php echo  $usuario['idUsuario']; ?>>Eliminar</button> </td>
                     </tr>
            </tbody>
            </form>
         <?php
               }
         ?>
         </table>
      </div>

      <div class="grid-item">
         <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
            <ul>
               <li>
                  <label for="Nombre">Nombre</label>
                  <input type="text" name="Nombre">
               </li>
               <li>
                  <label for="Apellidos">Apellidos</label>
                  <input type="text" name="Apellidos">
               </li>
               <li>
                  <label for="UserName">UserName</label>
                  <input type="text" name="UserName" required>
               </li>
               <li>
                  <label for="Pass">Pass</label>
                  <input type="password" id="Pass" name="Pass" required>
               </li>
               <li>
                  <label for="Administrador">Administrador</label>
                  <input type="text" name="Administrador" required>
               </li>
               <li>
                  <input type="submit" name="enviar" value="Enviar">
               </li>
            </ul>
         </form>
      </div>

   </div>

</body>

</html>