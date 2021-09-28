<?php
// He utilizado el filtro FILTER_VALIDATE_EMAIL fpara validar la dirección de correo electrónico
function comprobar_email($email)
{
   return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? 1 : 0;
}

// Función algoritmo módulo 23 para saber si el DNI es correcto
function validar_dni($dni)
{
   $letra = substr($dni, -1);
   $numeros = substr($dni, 0, -1);
   if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros % 23, 1) == $letra && strlen($letra) == 1 && strlen($numeros) == 8) {
      $dni_c = 'DNI correcto: ' . $dni . '<br />';
   } elseif (strlen($numeros) == 8) {
      $ln = @letra_nif($dni);
      $dni_c = 'DNI no valido, letra equivocada, el DNI  correcto es ' . $numeros  . $ln . '<br>';
   }
   return $dni_c;
}
// Función que obtiene la fecha y se le añaden 10 dias
function fechaAlquiler($dia, $interval)
{
   $date = new DateTime($dia);
   date_add($date, date_interval_create_from_date_string("10 days"));
   $fecha_10 = "Fecha de vuelta: " . $date->format('d-m-Y');
   return $fecha_10;
}

function letra_nif($dni)
{
   return  substr("TRWAGMYFPDXBNJZSQVHLCKE", strtr($dni, "XYZ", "012") % 23, 1);
}
