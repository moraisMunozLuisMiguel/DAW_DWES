<?php
    //funcion que comprueba el dNi introducido

    function comprobarDNI($a){
        if (strlen($a)==9) { //9 caracteres el dni
            $numeros = substr($a, 0, -1);  // devuelve "solo numeros"
            $letra = substr($a, -1);    // devuelve letra"

            $arrdni=[
                0=>"T",
                1=>"R",
                2=>"W",
                3=>"A",
                4=>"G",
                5=>"M",
                6=>"Y",
                7=>"F",
                8=>"P",
                9=>"D",
                10=>"X",
                11=>"B",
                12=>"N",
                13=>"J",
                14=>"Z",
                15=>"S",
                16=>"Q",
                17=>"V",
                18=>"H",
                19=>"L",
                20=>"C",
                21=>"K",
                22=>"E"          
            ];
            if (is_numeric($numeros)){
                $m=$numeros % 23;
                $letracorrecta = $arrdni[$m];
                if ($letra==$letracorrecta) {
                    echo "DNI correcto";
                }
                else {
                    echo "DNI correcto: $numeros$letracorrecta";
                }
            }
            else{
                echo "DNI formato incorrecto";
            }
        }
        else{
            echo "DNI formato incorrecto";
        }
    }
        if (isset($_GET['enviar'])){
		echo '<div class="form2">';
            //valor del nombre 
            $nombre=$_GET['nombre'];
			$apellidos=$_GET['apellidos'];
			$libro=$_GET['libro'];
            //comprobar si el mail tiene caracter @. Pdriamos especificar el tipo mail en el input también.
            if (isset($_GET['email'])){ 
                $email=$_GET['email'];
                if (($email)==""){ //si el mail esta vacio
                    echo " Completa el campo Email.";
                }
                else{
                    $pos=strpos($email,"@"); //buscar caracter @
                    if ($pos===false){
                        echo " Mail incorrecto.";
                    }
                    else {
                        echo " Mail correcto.";       
                    }
                }
                echo "<br>";
            }
            if (isset($_GET['fechaalquiler'])){
                $fecha= $_GET['fechaalquiler'];
                if (($fecha)==""){ //fecha vacia
                    echo " Completa el campo Fecha";
                }
                else {				
					echo "Fecha de vuelta:".date("d-m-Y",strtotime($fecha."+ 10 days")); 
                }
                echo "<br>";
            } 
            //comprobación del DNI.
            if (isset($_GET['dni'])){
                $dni=$_GET['dni'];
                comprobarDNI($_GET['dni']);
            }
       // }
	  echo "</div>";
    }
?>   
<html>    
    <head>
    <!-- Incluyo formato. -->
        <style type="text/css">          
            h1, h2 {
                text-align:center
            }
            body {
                    font: 10px;
                    text-align: left;
                    background-color: #ffffff;
            }
            
			form{
                    width:400px;
                    border:2px solid  rgb(18, 27, 156); 
                    background-color: rgb(92, 102, 241);
                    padding:14px;
                    margin: auto;
                }
			.form2{
                    width:400px;
                    border:2px solid  rgb(18, 27, 156); 
                    background-color: rgb(92, 102, 241);
                    padding:14px;
                    margin: auto;
					color:white;
                }
            label
            {
                display: block;
                margin: .5em 0 0 0;   
                color:white; 
                font-weight: bold;
            }
            
            input{   
                display: block;
                width: 200px;
                margin-bottom: 10px;
            }
        </style>
        <title>FORMULARIO BILBIOTECA</title>
        <h1>TAREA EVALUATIVA UD1- BIBLIOTECA</h1>
    </head>
    <body>       
    <?php      
    ?>      
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
        <label for="nombre">Nombre</label>
        <input value= "<?php if (isset($nombre)) echo $nombre;?>" name = "nombre" type="text"><br />
		<label for="apellidos">Apellidos</label>
        <input value= "<?php if (isset($apellidos)) echo $apellidos;?>" name = "apellidos" type="text"><br />
		<label for="nombre">Libro</label>
        <input value= "<?php if (isset($libro)) echo $libro;?>" name = "libro" type="text"><br />	
        <label for="email">Email</label>
        <input value= "<?php if (isset($email)) echo $email;?>" name = "email" type="text"><br />
        <label for="fechaalquiler">Fecha Alquiler</label>
        <input value= "<?php if (isset($fecha)) echo $fecha;?>"name = "fechaalquiler" type="date" id="start"> <br />
        <label for="dni">DNI</label>
        <input value= "<?php if (isset($dni)) echo $dni;?>"name = "dni" type="text"><br />   
        <input type="submit" name="enviar">
    </form>        
    </body>
</html>