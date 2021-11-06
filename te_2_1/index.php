<?php
//llamar al fichero que creo las clases.
include('datos.php');
session_start();
function cantidad($idProducto)
{
   if (isset($_SESSION[$idProducto])) {
      return $_SESSION[$idProducto];
   } else {
      return 0;
   }
}
if (isset($_POST['Añadir'])) { //comprobamos que hemos enviado el formulario.
   $idProducto = $_POST['idProducto']; //obtenemos la matricula
   $cantidad = $_POST['cantidad'][$idProducto]; //obtenemos la cantidad de viajes de un autobus.

   if (isset($_SESSION[$idProducto])) {
      //si la id existe añadir los viajes a esa matricula o autobus.
      // Si la cantidad a añadir es diferente a 0 se  añade
      if ($cantidad != 0) {
         $_SESSION[$idProducto] += $cantidad;
         // Si la cantidad a añadir es 0 la cantidad total es 0
      } else {
         $_SESSION[$idProducto] = $cantidad;
      }
   } else {
      //si no existe creamos la sesión para este autobus
      $_SESSION[$idProducto] = $cantidad;
   }
}
?>

<html>

<head>
   <link rel="stylesheet" href="./css/estilo.css" />
</head>

<body>
   <div class="grid-container">
      <div class="item1">
         <h1>Informacion Productos</h1>
      </div>
      <div class="item4">
         <p class="p">
         <h1>Productos</h1>
         </p>
      </div>
      <div class="item3">
         <p class="p">
         <h1>Cesta</h1>
         </p>
      </div>
      <div class="item4">
         <table>
            <thead>
               <tr>
                  <th>IDProducto</th>
                  <th>Nombre</th>
                  <th>Unidad</th>
                  <th>Descripción</th>
                  <th>PVP</th>
                  <th>Versión</th>
                  <th>Desc</th>
                  <th>Precio con desc</th>
                  <th>Cantidad</th>
               </tr>
            </thead>
            <tbody>
               <?php
               foreach ($arrsw as $sw) { //Recorremos el array de SW
                  $idProducto = $sw->getIDProducto();
               ?>
                  <form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>">
                     <tr>
                        <td><?php echo $sw->getIDProducto(); ?></td>
                        <td><?php echo $sw->getNombre(); ?></td>
                        <td><?php echo $sw->getUnidad(); ?></td>
                        <td><?php echo $sw->getDescripcion(); ?></td>
                        <td><?php echo $sw->getPvpUnidad(); ?></td>
                        <td><?php echo $sw->getVersion(); ?></td>
                        <td><?php echo $sw->getDescuento(); ?></td>
                        <td><?php echo $sw->getPrecioConDescuento(); ?></td>
                        <td><?php echo cantidad($idProducto); ?></td>
                        <td><input type="text" name="cantidad[<?php echo $idProducto ?>]" size=2 value="0"></td>
                        <td><input type="submit" name="Añadir" value="Añadir"></td>
                        <input type="hidden" name="idProducto" value=<?php echo $idProducto ?>>
                     </tr>

                  </form>
               <?php   }

               foreach ($arrhw as $hw) { //Recorremos el array de hw
                  $idProducto = $hw->getIDProducto();
               ?>
                  <form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>">
                     <tr>
                        <td><?php echo $hw->getIDProducto(); ?></td>
                        <td><?php echo $hw->getNombre(); ?></td>
                        <td><?php echo $hw->getUnidad(); ?></td>
                        <td><?php echo $hw->getDescripcion(); ?></td>
                        <td><?php echo $hw->getPvpUnidad(); ?></td>
                        <td><?php echo $hw->getProveedor(); ?></td>
                        <td><?php echo $hw->getDescuento(); ?></td>
                        <td><?php echo $hw->getPrecioConDescuento(); ?></td>
                        <td><?php echo cantidad($idProducto); ?></td>
                        <td><input type="text" name="cantidad[<?php echo $idProducto ?>]" size=2 value="0"></td>
                        <td><input type="submit" name="Añadir" value="Añadir"></td>
                        <input type="hidden" name="idProducto" value=<?php echo $idProducto ?>>
                     </tr>
                  </form>
               <?php   } ?>
            </tbody>
         </table>
      </div>
      <div class="item3">
         <table>
            <thead>
               <tr>
                  <th>Nombre</th>
                  <th>PVP</th>
                  <th>Descuento</th>
                  <th>Cantidad</th>
                  <th>Importe</th>
               </tr>
            </thead>
            <tbody>
               <?php
               foreach ($arrsw as $sw) {
                  $idProducto = $sw->getIDProducto();
                  if (cantidad($idProducto) > 0) {
               ?>
                     <tr>
                        <td><?php echo $sw->getNombre(); ?></td>
                        <td><?php echo $sw->getPvpUnidad(); ?></td>
                        <td><?php echo $sw->getDescuento(); ?></td>
                        <td><?php echo cantidad($idProducto); ?></td>
                        <td><?php echo (cantidad($idProducto)) * ($sw->getPrecioConDescuento()); ?></td>
                     </tr>
               <?php
                  }
               } ?>
               <?php foreach ($arrhw as $hw) {
                  $idProducto = $hw->getIDProducto();
                  if (cantidad($idProducto) > 0) {
               ?>
                     <tr>
                        <td><?php echo $hw->getNombre(); ?></td>
                        <td><?php echo $hw->getPvpUnidad(); ?></td>
                        <td><?php echo $hw->getDescuento(); ?></td>
                        <td><?php echo cantidad($idProducto); ?></td>
                        <td><?php echo (cantidad($idProducto)) * ($hw->getPrecioConDescuento()); ?></td>
                     </tr>
               <?php
                  }
               } ?>
            </tbody>
         </table>
      </div>
   </div>
   <footer>
      <h3>BIRT LH</h3>
   </footer>

</body>

</html>