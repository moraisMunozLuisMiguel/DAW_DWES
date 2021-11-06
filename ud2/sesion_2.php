<?php

session_start();

if (isset($_GET['enviar'])){

    if (isset($_GET['horasDWES'])&&!empty($_GET['horasDWES'])){
        if (isset($_SESSION['asignatura']['DWES'])){
            $_SESSION['asignatura']['DWES']=$_SESSION['asignatura']['DWES']+ $_GET['horasDWES'];
        }
        else{
            $_SESSION['asignatura']['DWES']=$_GET['horasDWES'];
        }      
    }
    if (isset($_GET['horasLMSGI'])&&!empty($_GET['horasLMSGI'])){
        if (isset($_SESSION['asignatura']['LMSGI'])){
            $_SESSION['asignatura']['LMSGI']= $_SESSION['asignatura']['LMSGI']+ $_GET['horasLMSGI'];
        }else{
            $_SESSION['asignatura']['LMSGI']=$_GET['horasLMSGI'];
        }     
    }  
}   

if (isset($_SESSION['asignatura']['DWES'])){
   echo "Horas DWES: ".$_SESSION['asignatura']['DWES']."<br>";
}
if (isset($_SESSION['asignatura']['LMSGI'])){
    echo "Horas LMSGI: ".$_SESSION['asignatura']['LMSGI']; 
}

?>

<form method="GET" action="<?=$_SERVER['PHP_SELF'];?>">
    <label for="asignatura">DWES</label>
    <input type="text" name="horasDWES">

    <label for="asignatura2">LMSGI</label>
    <input type="text" name="horasLMSGI">

    <input type="submit" name='enviar'>
</form>
