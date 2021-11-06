 <?php

   include_once('./Class/Producto.php');
   $producto = array(
      "codigo" => "P0",
      "nombre" => "Alimentacion",
      "nombre_corto" => "ALI",
   );
   $prod1 = new Producto($producto);

   $subprodA = new SubProducto($producto, 'P0-1', 'Manzanas', '12.5');
   $subprodB = new SubProducto($producto, 'P0-2', 'Tomates', '6');
   $subprodC = new SubProducto($producto, 'P0-3', 'Arroz', '1.5');

   $subprodA->muestra();
   $subprodA->muestraSubProducto();
   $subprodB->muestraSubProducto();
   $subprodC->muestraSubProducto();
