<?php
// Llamada a session_start.
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
    <title>Sesión - Página 2</title>
  </head>
  <body>
    <div>

    <?php
    // Ver.
    echo '$_SESSION[\'apellidos\'] =',
         isset($_SESSION['apellidos' ])?$_SESSION['apellidos' ]:'',
         '<br />';
    echo '$_SESSION[\'informacion\'][\'nombre\'] =',
         isset($_SESSION['informacion']['nombre'])?
                     $_SESSION['informacion']['nombre']:'',
         '<br />';
    ?>

    </div>
  </body>
</html>