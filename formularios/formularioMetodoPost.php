<?php
//echo "Usuario introducido: ". $_POST['usuario']."<br>";
//echo "Clave introducida: ". $_POST['clave'];

if ($_POST['usuario'] == "luis" and $_POST['clave'] == "1234") {
   header("Location:formularioLoginCorrecto.html");
} else {
   header("Location:formularioLoginPost.php");
}
