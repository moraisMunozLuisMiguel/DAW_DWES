<?php

session_start();
$_SESSION['prueba']= "1";
$_SESSION['nombre']= "Iñigo";


echo "Mi nombre es: ".$_SESSION['nombre'];


?>
