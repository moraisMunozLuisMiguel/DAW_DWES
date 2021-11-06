<?php
//llamar al fichero en lso que creo las clases.
include('clases.php');

$sw01 = new SW('SW001', 'Visual_Studio', "Edición de código", 67.4, "11");
$sw02 = new SW('SW002', 'Office', "Paquete Office completo", 125, "9");
$sw03 = new SW('SW003', 'Adobe_PDF', "Edición PDF", 50, "12.4");
$sw04 = new SW('SW004', 'CodePen', "Edición de código", 10, "1.9");
$arrsw = [$sw01, $sw02, $sw03, $sw04];

$hw01 = new HW('HW001', "Benq_24", "Pantallas", 100.4, "");
$hw02 = new HW('HW002', "Benq_26", "Pantallas", 120.6, "");
$hw03 = new HW('HW003', "Dell_Vostro15", "PC", 675, "");
$hw04 = new HW('HW004', "Dell_Insipron13", "PC", 1230, "");

$arrhw = [$hw01, $hw02, $hw03, $hw04];
