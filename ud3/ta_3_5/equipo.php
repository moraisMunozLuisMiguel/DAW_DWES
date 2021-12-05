<?php  
//llamar al fichero en lso que creo las clases.

include ("conexion.php");
$bd= new BaseDatos();
$conexion= $bd->conectar();

?>

<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/estiloequipo.css" />
</head>
<body>
    <main>
        <header>
            <H1>EQUIPO - <?php echo $_GET['nombreequipo']; ?></H1>
        </header>
        <div class="cont">
            <table>
            <tr>
                <th>IDPARTICIPANTE</th>
                <th>IDEQUIPO</th>
                <th>NOMBRE</th>
                <th>EDAD</th>
            </tr>
            <?php
                $resparti = $bd->seleccionar('Select * From participante p inner join equipo e
                 on p.idequipo = e.IDEquipo where p.idequipo='.$_GET['idequipo']);
                while ($parti=$resparti->fetch_assoc()){
                ?>
               
                <tr>
                    <td> <?php echo $parti['idparticipante']; ?> </td>
                    <td> <?php echo $parti['IDEquipo']; ?> </td>
                    <td> <?php echo $parti['nombre']; ?> </td>
                    <td> <?php echo $parti['edad']; ?> </td>
                    
                </tr>
               
                <?php
                }
                ?> 
            </table>
        </div>
    </main>
      
</body>

</html>