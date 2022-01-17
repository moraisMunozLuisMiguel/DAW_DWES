<?php
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic Realm="Contenido restringido"');
    header('HTTP/1.0 401 Unauthorized');
	echo "Usuario no reconocido!";
    exit;
}/*elseif ($_SERVER['PHP_AUTH_USER'] != 'dwes' ||  $_SERVER['PHP_AUTH_PW'] != 'abc123'){
	header('WWW-Authenticate: Basic Realm="Contenido restringido"');
    header('HTTP/1.0 401 Unauthorized');
	echo "Usuario no reconocido!";
    exit;
}*/
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Autentificación HTTP</title>
</head>
<body>
<?php
echo "Nombre de usuario: ".$_SERVER['PHP_AUTH_USER']."<br />";
echo "Contraseña: ".$_SERVER['PHP_AUTH_PW']."<br />";
/*echo "Método de autentificación: ".$_SERVER['AUTH_TYPE']."<br />";*/
?>
</body>
</html>