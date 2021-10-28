<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if ($_POST['usuario'] == "luis" and $_POST['clave'] == "1234") {
      header("Location: formulario_login_correcto.html");
   } else {
      // header("Location:Form1.html");
      $err = true;
   }
   $usuario = $_POST['usuario'];
}


?>


<html>

<head>
   <title>FORMULARIO LOGIN POST</title>

</head>

<body>
   <?php if (isset($err)) {
      echo "<p> Revise usuario y contraseña introducido</p>";
   }
   ?>
   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
      <label for="Usuario">Usuario</label>
      <input value="<?php if (isset($usuario)) echo $usuario; ?>" name="usuario" type="text">
      <label for="clave">Clave</label>
      <input name="clave" type="password">
      <input type="submit">
   </form>
</body>

</html>