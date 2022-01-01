<?php

if (!isset($_COOKIE['boton'])){
    $time=60*60*24*365;
    $cant=0;
    setcookie("boton[1]", $cant, $tiempoexp);  // expira en 1 año.
    setcookie("boton[2]", $cant, $tiempoexp);  // expira en 1 año.
    setcookie("boton[3]", $cant, $tiempoexp);  // expira en 1 año.
    setcookie("duracion", $tiempoexp,$tiempoexp);  // expira en 1 año y almaceno el tiempo. 
}

if (isset($_GET['but1'])){
    $cant=$_COOKIE['boton']['1'];
    setcookie("boton[1]", $cant+1, $_COOKIE['duracion']);
}

if (isset($_GET['but2'])){
    $cant=$_COOKIE['boton']['2'];
    setcookie("boton[2]", $cant+1, $_COOKIE['duracion']);
}

if (isset($_GET['but3'])){
    $cant=$_COOKIE['boton']['3'];
    setcookie("boton[3]", $cant+1, $_COOKIE['duracion']);
}

if (isset($_COOKIE['boton'])){
    foreach ($_COOKIE['boton'] as $num=>$bot){
        echo ('Boton '.$num .': ' .$bot).'<br>';
    }
}

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Cookies</title>
<link href="dwes.css" rel="stylesheet" type="text/css">
</head>
<body>
    <form action="ta_4_2.php">
        <button name="but1">Boton 1</button>
        <button name="but2">Boton 2</button>
        <button name="but3">Boton 3</button>
    </form>
</body>
</html>