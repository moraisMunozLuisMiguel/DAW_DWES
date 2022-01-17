<?php

if (!isset($_COOKIE['visitas'])){
    $time=60*60*24;
    $tiempoexp= time()+$time;
    $visitas=01;
    setcookie("visitas", $visitas, $tiempoexp);  // expira en 2 días.
    setcookie("duracion", $tiempoexp,$tiempoexp);  // expira en 2 días y almaceno el tiempo. 
}
else{
    setcookie("visitas", $_COOKIE['visitas']+1,$_COOKIE['duracion']); 
}

if ((isset($_GET['eliminar']))&&(isset($_COOKIE['visitas']))){
    setcookie("visitas", $_COOKIE['visitas'], time()-2400); 
	echo("Cookie eliminada <br>");
  
}

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Ejercicio: Función header para autentificación HTTP</title>
<link href="dwes.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php



if (isset($_COOKIE['visitas'])){
    echo("Número de visitas:".$_COOKIE['visitas']);
}

?>

<form action="ta_4_1.php" method="GET">
    <button name="eliminar">Eliminar cookies</button>
</form>
</body>
</html>