<?php  
//llamar al fichero en lso que creo las clases.

include ("conexion.php");
$bd= new BaseDatos();
$conexion= $bd->conectar();
function eliminar($id){
  global $bd;
  $sql = "DELETE FROM cesta_lineas WHERE idProducto =".$id;
  $bd->eliminar($sql);
}
function anadir($arr){
  global $bd;
  $sql = "INSERT INTO producto (ProductoNombre,idTipoProducto,Unidad,Descripcion,pvpUnidad,Descuento)
          VALUES ('$arr[0]',$arr[1],'$arr[2]','$arr[3]',$arr[4],$arr[5])";
  $bd->insertar($sql);
}


$timeout_duration = 3600;
session_start();
$tiempo_limite=$_SESSION['logeado'] + $timeout_duration;
$time=time();
if ($tiempo_limite < $time) {
  // session timed out
  session_unset();
  header('Location: login.php');
} 

if (isset($_GET['eliminar'])){
    eliminar($_GET['eliminar']);
}

if (isset($_GET['enviar'])){
  $arr= array($_GET['nombre'],$_GET['tipo'],$_GET['unidad'],$_GET['desc'],$_GET['pvp'],$_GET['descu']);
  anadir($arr);
}



?>

<html>
  <head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/estiloficha.css" />
  </head>

  <body>
    <main class="contenedor">
      <header>
          <a href="principal.php"> <img src="birt1.png" alt="" width="100" height="70"></a>
          <h1>Producto</h1>
      </header>
      
      <section class="mostrar">
      <div class="table-scroll">  
        <table>
          <tr>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Unidad</th>
            <th>Descripcion</th>
            <th>PVP</th>
            <th>Descuento</th>
            <th>Eliminar</th>
          </tr>
          <?php
            $resprod = $bd->seleccionar('Select * From Producto');
            while ($producto=$resprod->fetch_assoc()){
          ?>
          <form action="fichaproducto.php" methog="GET">
            <tr>
                <td> <?php echo $producto['ProductoNombre']; ?> </td>
                <td> <?php echo $producto['idTipoProducto']; ?> </td>
                <td> <?php echo $producto['Unidad']; ?> </td>
                <td> <?php echo $producto['Descripcion']; ?> </td>
                <td> <?php echo $producto['pvpUnidad']; ?> </td>
                <td> <?php echo $producto['Descuento']; ?> </td>
                <td> <button type="submit" name="eliminar" value=<?php echo  $producto['idProducto']; ?>>Eliminar</button> </td>
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
          <form action="fichaproducto.php">
            <fieldset>
                <legend>Producto:</legend>
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre"><br><br>
                <label for="tipo">Tipo</label>
                <!--<input type="text" id="tipo" name="tipo"><br><br>-->
                <select name="tipo">
                  <?php
                    global $bd;
                    $sql = "SELECT idTipo_producto,DescTipoProd FROM tipo_producto";
                    $res = $bd->seleccionar($sql);
                    while ($row = $res->fetch_assoc()){
                      echo '<option value="'.$row['idTipo_producto'].'">'.$row['DescTipoProd'].'</option>';
                    }
                  ?>
                </select>
                <label for="unidad">Unidad</label>
                <input type="text" id="unidad" name="unidad"><br><br>
                <label for="desc">Descripcion</label>
                <input type="text" id="desc" name="desc"><br><br>
                <label for="pvp">pvp</label>
                <input type="text" id="pvp" name="pvp"><br><br>
                <label for="descu">Descuento</label>
                <input type="text" id="descu" name="descu"><br><br>
                <input type="submit" value="Submit" name="enviar">
            </fieldset>  
          </form>
        </div>
      </section>
      



    </main>


  </body>
</html>




