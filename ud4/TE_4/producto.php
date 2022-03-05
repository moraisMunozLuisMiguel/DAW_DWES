<?php  
include ("conexion.php");
$bd= new BaseDatos();
$conexion= $bd->conectar();
session_start();

function anadir($idprod,$cant){
  //buscar si existe en la cesta
  // si existe sumar; si no existe añadir
  global $bd;
  $sql="Select * From cesta_lineas where idcesta='". $_SESSION['idcesta']."' and idproducto ='".$idprod."'";
  $rescesta = $bd->seleccionar($sql);
  $count = $rescesta->num_rows;
  if ($count>0) {
      $sql = "UPDATE cesta_lineas SET cantidad=".$cant ."  WHERE idProducto =".$idprod ." and idcesta='". $_SESSION['idcesta']."'";
      $bd->update($sql);
  }
  else{
    if (is_null($_SESSION['idcesta'])){
      //no esta definida, por lo tanto no existe la cesta ni el producto en la cesta. Los añadimos.
       // $sesid=$_SESSION['id'];
        $userid=$_SESSION['userid'];
        $sql = "INSERT INTO cesta (idusuario,comprado)
                VALUES ('$userid','0')";
        $bd->insertar($sql);
        //obtener la cesta
        $_SESSION['idcesta']=obtenerCesta($userid);
       
      }
    $sql = "INSERT INTO cesta_lineas (idcesta,idproducto,cantidad)
            VALUES (".$_SESSION['idcesta'].",".$idprod.",".$cant.")";
    $bd->insertar($sql);
  }

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



function eliminar($id){
  global $bd;
  $sql = "DELETE FROM cesta_lineas WHERE idcesta='".$_SESSION['idcesta']. "'and idcesta_lineas =".$id;
  $bd->eliminar($sql);
}

function eliminarprod($id){
  global $bd;
  $sql = "DELETE FROM cesta_lineas WHERE idcesta='".$_SESSION['idcesta']. "'and idproducto =".$id;
  $bd->eliminar($sql);
}


function cantidad($id){
  global $bd;
  $cant=0;
 // if (!isset($_SESSION['idcesta'])) $_SESSION['idcesta']= obtenerCesta($_SESSION['id']);
  $rescesta = $bd->seleccionar("Select * From cesta_lineas where idcesta='".$_SESSION['idcesta']. "' and idproducto=".$id);
  $count= $rescesta->num_rows;
  if ($count>0){
    $cesta=$rescesta->fetch_assoc();
    $cant=$cesta['cantidad'];
  }

  return $cant;
}

function calcularprecio($cantidad, $precio, $desc){
  $importe= $cantidad *  $precio * ((100-$desc)/100);
  return $importe;
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

if (isset($_GET['eliminar'])){
  eliminar($_GET['eliminar']);
}

if (isset($_GET['anadir'])){
  anadir($_GET['anadir'],$_GET['cant']);
}
if (isset($_GET['eliminarprod'])){
  eliminarprod($_GET['eliminarprod']);
}


?>
<html>
  <head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/estiloprod.css" />
  </head>

  <body>
    <main class="contenedor">
        <header>
        <div class="logo">
          <a href="principal.php"> <img src="/img/birt1.png" alt="" width="60%" height="70%"></a>
        </div>
        
        <h1 class="titulo">PRODUCTO - <?php echo $_GET['desctipo'] ?></h1>
        </header>
        <section>
          <div class="prod">
          <table>
            <tr>
              <th>Nombre</th>
              <th>Tipo</th>
              <th>Unidad</th>
              <th>Descripcion</th>
              <th>PVP</th>
              <th>Descuento</th>
              <th>Cantidad</th>
            </tr>
            <?php
              $resprod = $bd->seleccionar('Select * From Producto where idTipoProducto ='.$_GET['idtipo']);
              while ($producto=$resprod->fetch_assoc()){
            ?>
            <form action="producto.php" methog="GET">
              <tr>
                  <td> <?php echo $producto['ProductoNombre']; ?> </td>
                  <td> <?php echo $producto['idTipoProducto']; ?> </td>
                  <td> <?php echo $producto['Unidad']; ?> </td>
                  <td> <?php echo $producto['Descripcion']; ?> </td>
                  <td> <?php echo $producto['pvpUnidad']; ?> </td>
                  <td> <?php echo $producto['Descuento']; ?> </td>
                  <td><input type="text" name=cant value=<?php echo cantidad($producto['idProducto']) ?>></td>
                  <input type="hidden" name="idtipo" value=<?php echo $_GET['idtipo']?>>
                  <input type="hidden" name="desctipo" value=<?php echo $_GET['desctipo']?>>
                  <td> <button type="submit" name="anadir" value=<?php echo  $producto['idProducto']; ?>>Anadir</button> </td>
                  <td> <button type="submit" name="eliminarprod" value=<?php echo  $producto['idProducto']; ?>>Eliminar</button> </td>
              </tr>
            </form>
            <?php
              }
            ?> 
    
          </table>
          </div>
          <div class= "cesta">
            <table>
            <tr>
              <th>Nombre</th>
              <th>Precio</th>
              <th>Descuento</th>
              <th>Cantidad</th>
              <th>Importe</th>
            </tr>
            <?php
             // if (isset($_SESSION['idcesta'])){
             // if (($_SESSION['idcesta'])!="0"){
                $sql="Select * From cesta a inner join cesta_lineas b on a.idcesta=b.idcesta inner join producto c on b.idproducto=c.idproducto where comprado='0' and a.idcesta='".$_SESSION['idcesta']."'";
                $rescesta = $bd->seleccionar($sql);
                while ($cesta=$rescesta->fetch_assoc()){
                  ?>
                  <form action="producto.php" methog="GET">
                    <tr>
                        <td> <?php echo $cesta['ProductoNombre']; ?> </td>
                        <td> <?php echo $cesta['pvpUnidad']; ?> </td>
                        <td> <?php echo $cesta['Descuento']; ?> </td>
                        <td> <?php echo $cesta['cantidad']; ?> </td>
                        <td> <?php echo calcularprecio($cesta['cantidad'],$cesta['pvpUnidad'],$cesta['Descuento']) ?> </td>
                        <input type="hidden" name="idtipo" value=<?php echo $_GET['idtipo']?>>
                        <input type="hidden" name="desctipo" value=<?php echo $_GET['desctipo']?>>
                        <td> <button type="submit" name="eliminar" value=<?php echo  $cesta['idcesta_lineas']; ?>>Eliminar</button> </td>
                    </tr>
                  </form>
                  <?php
                    }
               //   }
                  ?>    
           

          </table>
          </div>
        </section>

    </main>
  </body>
</html>