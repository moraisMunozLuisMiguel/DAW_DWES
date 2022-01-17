<?php
/*Llama al fichero en el que se se crea la clase BaseDatos y sus funciones*/

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

function eliminar($idTipo_producto){
   global $bd;
   $sql = "DELETE FROM tipo_producto WHERE IdTipo_producto=" . $idTipo_producto;
   $bd->eliminar($sql);
}

function insertar($valores){
   global $bd;
   $sql = "INSERT INTO tipo_producto (DescTipoProd,idFamilia) VALUES ('$valores[0]',
  $valores[1])";
   $bd->insertar($sql);
}

if (isset($_POST['eliminar'])) {
   eliminar($_POST['eliminar']);
}

if (isset($_POST['enviar'])) {
   $DescTipoProd = $_POST['DescTipoProd'];
   $idFamilia = $_POST['idFamilia'];
   $arr = array($DescTipoProd, $idFamilia);
   insertar($arr);
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
		
		<div class="grid-item1">TIPO PRODUCTO</div>
		
		<div class="grid-item">
         <table>
            <thead>
               <tr>
                  <th>idTipo_producto</th>
                  <th>DescTipoProd</th>
                  <th>idFamilia</th>
               </tr>
            </thead>
            <tbody>
               <?php
			   // Selecciona todos los registros de la tabla tipo_producto
               $rtipo_producto = $bd->seleccionar('Select * From tipo_producto');
               while ($tipo_producto = $rtipo_producto->fetch_assoc()) {
               ?>
                  <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
                     <tr>
                        <td> <?php echo $tipo_producto['idTipo_producto']; ?> </td>
                        <td> <?php echo $tipo_producto['DescTipoProd']; ?> </td>
                        <td> <?php echo $tipo_producto['idFamilia']; ?> </td>
                        <td> <button type="submit" name="eliminar" value=
						<?php echo  $tipo_producto['idTipo_producto']; ?>>Eliminar</button> </td>
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
						<label for="DescTipoProd">Descripcion</label>
						<input type="text" name="DescTipoProd">
					</li>
					<li>
						<label for="idFamilia">idFamilia</label>
						<select name = "idFamilia">
								<?php
								// Selecciona todos los registros de la tabla familia
								$rfamilia = $bd->seleccionar('Select * From familia');
								while ($familia = $rfamilia->fetch_assoc()) {
									?>
									<option> <?php echo $familia['idFamilia']; ?> </option>
									<?php
								}
								?>
						</select>
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