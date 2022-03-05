<?php  
include_once 'lib/nusoap.php';
$cliente= new nusoap_client("http://localhost/DAW_DWES/ud5/te_5_1/servicio.php", false);
include ("conexion.php");

$bd= new BaseDatos();
$conexion= $bd->conectar();

function eliminar($id){
	global $bd;
	$sql = "DELETE FROM cestaLineas WHERE idCesta='".$_SESSION['idCesta']. "'and idCestaLineas =".$id;
	$bd->eliminar($sql);
}

function calcularPrecio($cantidad, $precio, $desc){
	$importe= $cantidad *  $precio * ((100-$desc)/100);
	return $importe;
}

function marcarComprado($idcesta){
	global $bd;
	$sql = "UPDATE cesta SET comprado='1' WHERE idCesta='". $_SESSION['idCesta']."'";
	$bd->update($sql);
}

function obtenerCesta($userid){
	global $bd;
	$rescesta = $bd->seleccionar("Select idCesta From cesta where comprado= '0' and idUsuario ='".$userid."'");
	$count = $rescesta->num_rows;
	if ($count>0){
		$cestaLinea= $rescesta->fetch_assoc();
		if (is_null($cestaLinea['idCesta'])){
			$id= null;
		}else{
			$id= $cestaLinea['idCesta'];  
		}
	}else{
		$id=null;
	}
	return $id;
}

$timeout_duration = 3600;
session_start();
$tiempo_limite=$_SESSION['logeado'] + $timeout_duration;
$time=time();

if ($tiempo_limite < $time) {
	session_unset();
	header('Location: login.php');
} 

if (isset($_GET['cerrar'])){
	session_unset();
	header('Location: login.php');
	session_destroy();
	exit;
}
  
if (isset($_GET['eliminar'])){
	eliminar($_GET['eliminar']);
}

if (isset($_GET['comprar'])){
	marcarComprado($_SESSION['idCesta']);
	$_SESSION['idCesta']=obtenerCesta($_SESSION['userid']);
	$cant=$_COOKIE['comprar'];
	setcookie("comprar", $cant+1);
}

?>

<?php 
if ($_SESSION['admin']=='1'){ 
	?>
	<html>
		<head>
			<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
			<link rel="stylesheet" href="./css/estilo.css" /> 
		</head>
		<body>
			<main class="contenedor">
				<header>
					<div class="titulo">
						<h1 >TIENDA BIRT - ADMIN</h1>
					</div>
					<div class="login">
						<h3><?php echo $_SESSION['user']?>
						</br>VENTAS realizadas:  <?php echo $_COOKIE['comprar']; ?></h3>   
						<form action="principal.php">
							<button name="cerrar">Cerrar sesion</button>
						</form>
					</div>
				</header>
				<nav class="menu">
					<ul>
						<li><a href="fichaFamilias.php"><button type="button" class="btn">FAMILIA</button></a></li>
						<li><a href="fichaTipos.php"><button type="button" class="btn">TIPO</button></a></li>
						<li><a href="fichaProductos.php"><button type="button" class="btn">PRODUCTO</button></a></li>
						<li><a href="fichaUsuarios.php"><button type="button" class="btn">USUARIO</button></a></li>
					</ul>
				</nav>
				<section>
				<div	class="serv">
					<table>
						<tr>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Fecha Llegada</th>
						</tr>
						<?php
						$cantidad = 4;
						$parametros = array("stock"=>$cantidad);
						$respuesta= $cliente->call("cargarDatosStock", $parametros);
						$stocks= json_decode($respuesta);
								foreach($stocks as $stck){
									echo "<tr><td>".$stck->Producto."</td>
									<td>".$stck->Cantidad. "</td>
									<td>" .$stck->fechaLlegada."</td></tr>";
								}
						?>
					</table>
					</div>
					</section>
			</main>
		</body>
	</html>
<?php 
} else{ 
	include('compra.php');
}
?>






