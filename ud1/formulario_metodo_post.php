<?php
//echo "Usuario introducido: ". $_POST['usuario']."<br>";
//echo "Clave introducida: ". $_POST['clave'];

if ($_POST['usuario'] == "luis" and $_POST['clave'] == "1234") {
   header("Location:formulario_login_correcto.html");
} else {
   header("Location:formulario_login_post.php");
}
