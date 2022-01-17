<?php
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic Realm="Contenido restringido"');
    header('HTTP/1.0 401 Unauthorized');
	echo "Usuario no reconocido!";
    exit;
}
?>
<html>
	<head>
		<meta hhtp-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Función header para autentificación</title>
	</head>
	<body>
		<?php
		echo "NOMBRE DE USUARIO: ".$_SERVER['PHP_AUTH_USER']."<br/>" ;
		echo "CONTRASEÑA: ".$_SERVER['PHP_AUTH_PW']."<br/>" ;
		?>
	</body>
</html>