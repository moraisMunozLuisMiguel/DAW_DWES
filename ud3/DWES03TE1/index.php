<?php  
//llamar al fichero en lso que creo las clases.

include ("conexion.php");
$bd= new BaseDatos();
$conexion= $bd->conectar();

function eliminar($id){
  global $bd;
  $sql = "DELETE FROM cesta_lineas WHERE idcesta=95 and idcesta_lineas =".$id;
  $bd->eliminar($sql);
}
function calcularprecio($cantidad, $precio, $desc){
  $importe= $cantidad *  $precio * ((100-$desc)/100);
  return $importe;
}
if (isset($_GET['eliminar'])){
  eliminar($_GET['eliminar']);
}

?>

<html>
  <head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href=".\css\estilo.css" />
  </head>

  <body>
    <main class="contenedor">
      <header>
          <h1>TIENDA BIRT</h1>
      </header>
      <nav class="menu">
        <ul>
          <li><a href='#'>Familia</a></li>
          <li><a href='#'>Tipo</a></li>
          <li><a href='fichaproducto.php'>Producto</a></li>
          <li><a href='#'>Usuario</a></li>
        </ul>
      </nav> 
      
      <section>
      <div class="tipos" >
      <?php 
           $restipo = $bd->seleccionar('Select * From tipo_producto');
           while ($tipo=$restipo->fetch_assoc()){
        ?>
          <div class="tipos_item">
            <a href="#" ?><?php echo $tipo['DescTipoProd']; ?></a>
          </div>
          <?php 
           }
           ?>
        </div>
      </section>
    </main>
  </body>
</html>




