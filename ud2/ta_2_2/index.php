<?php
    session_start(); //abrimos session
    if (!isset($_SESSION['suma'])){ //comprobamos si existe la variable suma
        $_SESSION['suma']=0; //creamos la variable suma
    }else{

        if (isset($_GET['eliminar'])){
            unset($_SESSION['suma']);
        }
        elseif (isset($_GET['INumero'])){
            $_SESSION['suma']+=$_GET['INumero'];
            echo  $_SESSION['suma'];
        }
        
    }
?>

<form action="<?=$_SERVER['PHP_SELF'];?>" method="get">
    <label for="numero">Numero</label>
    <input type="text" name="INumero">

    <button> Sumar</button>
    <button name="eliminar"> Eliminar session</button>
</form>