<?php
	$valor1="prueba";
	$valor2="prueba2";
	if (!isset($_COOKIE['cookie1'])){
		setcookie("cookie1",$valor1);
	}
	if (!isset($_COOKIE['cookie2'])){
		setcookie("cookie2",$valor2,time()+60);
	}
	if (isset($_GET['eliminar'])){
		setcookie("cookie1",$valor1,time()-2400);
		setcookie("cookie2",$valor1,time()-2400);
	}
?>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Cookies</title>
		<link href="dwes.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<?php
			if (isset($_COOKIE['cookie1'])){
				echo("Cookie 1: ".$_COOKIE['cookie1']);
			}
			if (isset($_COOKIE['cookie2'])){
				echo("Cookie 2: ".$_COOKIE['cookie2']);
			}
		?>
		<form action="cookie.php" method="GET">
			<button name="eliminar">ELIMINAR cookie</button>
		</form>
	</body>
</html>















