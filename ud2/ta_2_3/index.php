<?php
//llamar al fichero en lso que creo las clases.
include('datos.php');
session_start();
function viajestotatales($matricula)
{
   if (isset($_SESSION[$matricula])) {
      return $_SESSION[$matricula];
   } else {
      return 0;
   }
}

if (isset($_POST['enviar'])) { //comprobamos que hemos enviado el formulario.
   $matricula = $_POST['matricula']; //obtenemos la matricula
   $cantidad = $_POST['cantidad'][$matricula]; //obtenemos la cantidad de viajes de un autobus.

   if (isset($_SESSION[$matricula])) {
      //si la id existe añadir los viajes a esa matricula o autobus.
      $_SESSION[$matricula] += $cantidad;
   } else {
      //si no existe creamos la sesión para este autobus
      $_SESSION[$matricula] = $cantidad;
   }
}
?>

<html>

<head>
   <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="./css/estilo.css" />
</head>

<body>
   <main class="contenedor">
      <header>
         <h1>Informacion vehiculos</h1>
      </header>
      <section class="cont2">
         <p class="p">TAXI</p>
         <p class="p">BUS</p>
         <table>
            <thead>
               <tr>
                  <th>Matricula</th>
                  <th>Modelo</th>
                  <th>Potencia</th>
                  <th>Licencia</th>
                  <th>Info</th>
               </tr>
            </thead>
            <tbody>
               <?php
               foreach ($arrtaxi as $taxi) { //Recorremos el array de taxis
               ?>
                  <tr>
                     <td><?php echo $taxi->getMatricula(); ?></td>
                     <td><?php echo $taxi->getModelo(); ?></td>
                     <td><?php echo $taxi->getPotencia(); ?></td>
                     <td><?php echo $taxi->getLicencia(); ?></td>
                     <td><?php $taxi->ImprimirInfoVehiculo(); ?></td>
                  </tr>
               <?php   } ?>
            </tbody>
         </table>

         <table>
            <thead>
               <tr>
                  <th>Matricula</th>
                  <th>Modelo</th>
                  <th>Potencia</th>
                  <th>Plazas</th>
                  <th>ViajesMes</th>
               </tr>
            </thead>
            <tbody>
               <?php
               foreach ($arrbus as $bus) { //Recorremos el array de buses
                  $matricula = $bus->getMatricula();
               ?>
                  <form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>">
                     <tr>
                        <td><?php echo $bus->getMatricula(); ?></td>
                        <td><?php echo $bus->getModelo(); ?></td>
                        <td><?php echo $bus->getPotencia(); ?></td>
                        <td><?php echo $bus->getPlazas(); ?></td>
                        <td><?php echo viajestotatales($matricula); ?></td>
                        <td><input type="text" name="cantidad[<?php echo $matricula ?>]" size=2 value="0"></td>
                        <td><input type="submit" name="enviar"></td>
                        <input type="hidden" name="matricula" value=<?php echo $matricula ?>>
                     </tr>
                  </form>
               <?php   } ?>
            </tbody>
         </table>
      </section>
      <footer>
         <p>BIRT LH</p>
      </footer>
   </main>
</body>

</html>