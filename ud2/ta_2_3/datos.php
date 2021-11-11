<?php  
//llamar al fichero en lso que creo las clases.
include('clases.php');

$taxi1= new Taxi('1234GHB',"TOYOTA AURIS","125","LIC001");
$taxi2= new Taxi('1444HHB',"SKODA OCTAVIA","132","LIC004");
$taxi3= new Taxi('0000BBB',"TOYOTA AURIS","125","LIC007");
$taxi4= new Taxi('6754TGD',"SKODA OCTAVIA","132","LIC014");

$arrtaxi= [$taxi1,$taxi2,$taxi3,$taxi4];

$bus1= new Autobus('0101CCC',"MAN","270","48");
$bus2= new Autobus('0907GTT',"VOLVO","320","52");
$bus3= new Autobus('6643FRT',"MERCEDES","267","52");
$bus4= new Autobus('5333HTH',"MAN","270","28");

$arrbus= [$bus1,$bus2,$bus3,$bus4];