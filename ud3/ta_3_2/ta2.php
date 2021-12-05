<?php
//llamar al fichero en lso que creo las clases.

include("conexion.php");
$bd = new BaseDatos();
$conexion = $bd->conectar();

function eliminar($id)
{
   global $bd;
   $sql = "DELETE FROM equipo WHERE IDEquipo =" . $id;
   $bd->eliminar($sql);
}

if (isset($_GET['eliminar'])) {
   eliminar($_GET['eliminar']);
}

?>

<html>

<head>
   <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="./css/estilo.css" />
</head>

<body>
   <table>
      <tr>
         <th>IDEQUIPO</th>
         <th>NOMBRE</th>
         <th>PUNTOS</th>
      </tr>
      <?php
      $resequipo = $bd->seleccionar('Select * From equipo');
      while ($equipo = $resequipo->fetch_assoc()) {
      ?>
         <form action="<?= $_SERVER['PHP_SELF']; ?>" methog="GET">
            <tr>
               <td> <?php echo $equipo['IDEquipo']; ?> </td>
               <td> <?php echo $equipo['Nombre']; ?> </td>
               <td> <?php echo $equipo['Puntos']; ?> </td>
               <td> <button type="submit" name="eliminar" value=<?php echo  $equipo['IDEquipo']; ?>>Eliminar</button> </td>
            </tr>
         </form>
      <?php
      }
      ?>
   </table>
</body>

</html>