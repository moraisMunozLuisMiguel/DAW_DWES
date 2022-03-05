<html>
	<head>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
		<!-- <link rel="stylesheet" href="./css/compra.css" /> --> 
		<link rel="stylesheet" href="./css/estilo.css" /> 
	</head>
	<body>
		<main class="contenedorCompra">
			<header>
				<div class="titulo">
					<h1 >TIENDA BIRT - CLIENTE</h1>
				</div>
				<div class="login">
					<form action="principal.php">
						<h2><?php echo $_SESSION['user']?></br><?php
						echo 'Total de Logins realizados: ' . $_COOKIE[$_SESSION['user']] ?></h2>
						<button name="cerrar">Cerrar sesion</button>
					</form>
				</div>
			</header>
			<section2>
				<div class="tipos" >
					<?php 
					$restipo = $bd->seleccionar('Select * From tipoProducto');
					while ($tipo=$restipo->fetch_assoc()){
						?>
						<div class="tipos_item">
							<a href="producto.php?idTipoProducto=<?php echo $tipo['idTipoProducto'] ?>
							&descTipoProd=<?php echo $tipo['descTipoProd'] ?>"><?php echo 
							$tipo['descTipoProd']; ?></a> 
						</div>
						<?php 
					}
					?>
				</div>
				<div class="cesta" >
					<table>
						<tr>
							<th>Nombre</th>
							<th>Precio</th>
							<th>Descuento</th>
							<th>Cantidad</th>
							<th>Importe</th>
						</tr>
						<?php
						if (($_SESSION['idCesta'])!="0"){
							$sql="Select * From cesta a inner join cestaLineas b on a.idCesta=b.idCesta inner join producto c on b.idProducto=c.idProducto where comprado = '0' and a.idCesta='".$_SESSION['idCesta']."'";
							$rescesta = $bd->seleccionar($sql);
							while ($cesta=$rescesta->fetch_assoc()){
								?>
								<form action="principal.php" methog="GET">
									<tr>
										<td> <?php echo $cesta['productoNombre']; ?> </td>
										<td> <?php echo $cesta['pvpUnidad']; ?> </td>
										<td> <?php echo $cesta['descuento']; ?> </td>
										<td> <?php echo $cesta['cantidad']; ?> </td>
										<td> <?php echo calcularPrecio($cesta['cantidad'],$cesta['pvpUnidad'],$cesta['descuento']) ?> </td>
										<td> <button type="submit" name="eliminar" value=<?php echo  $cesta['idCestaLineas']; ?>>Eliminar</button> </td>
									</tr>
								</form>
							<?php
							}
						}
						?>  
					</table>
					<form action="principal.php" methog="GET">
						<input type="submit" name="comprar" value="Comprar">
					</form>
				</div> 
			</section2>
		</main>
	</body>
</html>