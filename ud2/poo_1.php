<?php

include('./Class/ClasesPoo_1.php');
$primeraPersona = new Persona("Luis Miguel", "Morais Muñoz", "1970-12-06");
$primerProfesor = new Profesor("123", "Iker", "Martinez", "1950-12-01");
$primerAlumno = new Alumno("8.5", "Ane", "Zabala", "1997-12-01");

$nombreCompleto = ($primeraPersona->nombrecompleto($primeraPersona->getNombre(), $primeraPersona->getApellidos()));
$edad = ($primeraPersona->edad($primeraPersona->getFechaNacimiento()));
$edadProfesor = ($primerProfesor->edad($primerProfesor->getFechaNacimiento()));
$edadAlumno = ($primerAlumno->edad($primerAlumno->getFechaNacimiento()));

echo "<br>";
echo "Hola soy $nombreCompleto y tengo $edad";
echo "<br>";
echo $primerProfesor->printID($primerProfesor->getnombre(), $primerProfesor->getApellidos());
echo " y tiene $edadProfesor";
echo "<br>";
echo $primerAlumno->printnotamedia($primerAlumno->getnombre(), $primerAlumno->getApellidos());
echo " y tiene $edadAlumno";
