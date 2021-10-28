<?php
function existe($miArray, $miNombre)
{
   $posicion = array_search($miNombre, $miArray, false);
   return $posicion;
}
