<?php
/*Llama al fichero en el que se se crea la clase BaseDatos y sus funciones conectar,  
seleccionar, insertar, eliminar*/
include("conectar.php");
$bd = new BaseDatos();
$conexion = $bd->conectar();
?>

<html>

<head>
   <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="./css/estilo.css" />
</head>

<body>
   <div class="grid-container">
   
		<div class="grid-container2">
			<a href="index.php">INDEX</a>
		</div>
		
      <div class="grid-item1">
         <H1>Producto - <?php echo $_GET['nombreTipoProducto']; ?></H1>
      </div>
	  
	  <div class="grid-container2">
	  
      <div class="grid-item">
         <table>
            <thead>
               <tr>
                  <th>Nombre</th>
                  <th>Tipo</th>
                  <th>Unidad</th>
                  <th>Descripcion</th>
                  <th>PVP</th>
                  <th>Descuento</th>
               </tr>
            </thead>
            <tbody>
               <?php
			   /* Selecciona todos los registros de la tabla producto y tipo_producto que coincidan con 
			   el idTipo_producto*/
               $rproducto = $bd->seleccionar('Select * From producto p inner join tipo_producto e
               on p.idTipo_producto = e.idTipo_producto where p.idTipo_producto=
			   ' . $_GET['idTipo_producto']);
               while ($producto = $rproducto->fetch_assoc()) {
               ?>
                  <tr>
                     <td> <?php echo $producto['ProductoNombre']; ?> </td>
                     <td> <?php echo $producto['idTipo_producto']; ?> </td>
                     <td> <?php echo $producto['Unidad']; ?> </td>
                     <td> <?php echo $producto['Descripcion']; ?> </td>
                     <td> <?php echo $producto['pvpUnidad']; ?> </td>
                     <td> <?php echo $producto['Descuento']; ?> </td>
                  </tr>
               <?php
               }
               ?>
            </tbody>
         </table>
      </div>
	  
	  </div>
	  
   </div>
   
</body>

</html>