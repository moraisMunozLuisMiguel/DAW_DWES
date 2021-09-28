<?php
/* 
Función que comprueba si la actividad existe, en caso afirmativo almacena su índice
*/
function existe($miArray, $miNom)
{
   $posicion = array_search($miNom, $miArray, false);
   return $posicion;
}
