<?php
echo "Hola " . $_GET['usuario'] . "<br>";
echo "Tu contraseña es: " . $_GET['clave'];

if ($_GET['usuario'] == "luis" and $_GET['clave'] == "1234") {
   header("Location:formularioLoginCorrecto.html");
} else {
   header("Location:formularioLoginGet.html");
}
