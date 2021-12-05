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
   
      <div class="grid-item1">TIENDA BIRT</div>

      <div class="grid-item">
         <a href="fichaFamilias.php"><button type="button" class="btn">FAMILIA</button></a>
         <a href="fichaTipos.php"><button type="button" class="btn">TIPO</button></a>
         <a href="fichaProductos.php"><button type="button" class="btn">PRODUCTO</button></a>
         <a href="fichaUsuarios.php"><button type="button" class="btn">USUARIO</button></a>
      </div>
	  
      <div class="grid-container2">
	  
         <div class="grid-container2">
            <?php
			// Selecciona todos los registros de la tabla tipo_producto
            $rtipo_producto = $bd->seleccionar('Select * From tipo_producto');
            while ($tipo_producto = $rtipo_producto->fetch_assoc()) { ?>
               
			   <div class="grid-item2">
                     <a href="producto.php?nombreTipoProducto=<?php echo 
					 $tipo_producto['DescTipoProd']; ?>&idTipo_producto=
					 <?php echo $tipo_producto['idTipo_producto']; ?>">
					 <?php echo $tipo_producto['DescTipoProd']; ?></a>
               </div>
			   
            <?php
            }
            ?>
         </div>
		 
      </div>
	  
   </div>
   
</body>

</html>