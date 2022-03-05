
<html>
  <head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/compra.css" />
  </head>


  <body>
    <main class="contenedor">
      <header>
      <div class="titulo">
          <h1 >TIENDA BIRT - CLIENTE</h1>
          </div>
          <div class="login">
              <form action="principal.php">
                <h2><?php echo $_SESSION['user']?></h2>
                <button name="cerrar">Cerrar sesion</button>
              </form>
          </div>
      </header>
     
      
      <section>
      <div class="tipos" >
      <?php 
           $restipo = $bd->seleccionar('Select * From tipo_producto');
           while ($tipo=$restipo->fetch_assoc()){
        ?>
          <div class="tipos_item">
            <a href="producto.php?idtipo=<?php echo $tipo['idTipo_producto'] ?>&desctipo=<?php echo $tipo['DescTipoProd'] ?>"><?php echo $tipo['DescTipoProd']; ?></a>
          </div>
          <?php 
           }
           ?>
        </div>
      <div class="cesta" >
        <table>
          <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Descuento</th>
            <th>Cantidad</th>
            <th>Importe</th>
          </tr>
          <?php
         // session_start();
              if (($_SESSION['idcesta'])!="0"){
                $sql="Select * From cesta a inner join cesta_lineas b on a.idcesta=b.idcesta inner join producto c on b.idproducto=c.idproducto where comprado = '0' and a.idcesta='".$_SESSION['idcesta']."'";
                $rescesta = $bd->seleccionar($sql);
                while ($cesta=$rescesta->fetch_assoc()){
                  ?>
                  <form action="principal.php" methog="GET">
                    <tr>
                        <td> <?php echo $cesta['ProductoNombre']; ?> </td>
                        <td> <?php echo $cesta['pvpUnidad']; ?> </td>
                        <td> <?php echo $cesta['Descuento']; ?> </td>
                        <td> <?php echo $cesta['cantidad']; ?> </td>
                        <td> <?php echo calcularprecio($cesta['cantidad'],$cesta['pvpUnidad'],$cesta['Descuento']) ?> </td>
                       
                        
                        <td> <button type="submit" name="eliminar" value=<?php echo  $cesta['idcesta_lineas']; ?>>Eliminar</button> </td>
                    </tr>
                  </form>
                  <?php
                    }
                  }
                  ?>  
        </table>
        <form action="principal.php" methog="GET">
            <input type="submit" name="comprar" value="Comprar">
        </form>
      </div> 
      </section>
    </main>
  </body>
</html>