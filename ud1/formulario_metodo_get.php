<?php
echo "Hola " . $_GET['usuario'] . "<br>";
echo "Tu contraseña es: " . $_GET['clave'];

if ($_GET['usuario'] == "luis" and $_GET['clave'] == "1234") {
   header("Location:formulario_login_correcto.html");
} else {
   header("Location:formulario_login_get.html");
}
