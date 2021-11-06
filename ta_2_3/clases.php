<?php
class Vehiculo {
    public $matricula;
    public $modelo;
    public $potencia;

    public function __construct($matricula,$modelo,$potencia){
        $this->matricula=$matricula;
        $this->modelo=$modelo;
        $this->potencia=$potencia;
        
    }
     //Funciones get y set de los atributos de la clase.
     public function getMatricula(){ return $this->matricula;} 
     public function setMatricula($familia) {$this->matricula=$matricula; }
     public function getModelo(){ return $this->modelo;} 
     public function setModelo($modelo) {$this->modelo=$modelo; }
     public function getPotencia(){ return $this->potencia;} 
     public function setPotencia($potencia) {$this->potencia=$potencia; }
     public function ImprimirInfoVehiculo()
     {
         echo "Modelo: ".$this->getPotencia()." Matricula: ".$this->getMatricula()." Potencia:".$this->getPotencia();
     }

}

class Taxi extends Vehiculo{
    private $licencia;

    //El constructor de la Clase Vehiculo
    public function __construct($matricula,$modelo,$potencia,$licencia){
        
        parent::__construct($matricula,$modelo,$potencia,$licencia); //El constructor Padre
        $this->licencia=$licencia;        
    }
    
    //Funciones get y set de los atributos de la clase.
    function getLicencia(){ return $this->licencia;} 
    function setLicencia($licencia) {$this->licencia=$licencia; }
    public function ImprimirLicencia()
    {
        echo "Licencia: ".$this->getLicencia();
    }
   
}

class Autobus extends Vehiculo{
    private $plazas;

    //El constructor de la Clase Vehiculo
    public function __construct($matricula,$modelo,$potencia,$plazas){
        
        parent::__construct($matricula,$modelo,$potencia,$plazas); //El constructor Padre
        $this->plazas=$plazas;        
    }
    
    //Funciones get y set de los atributos de la clase.
    function getPlazas(){ return $this->plazas;} 
    function setPlazas($plazas) {$this->plazas=$plazas; }
    public function ImprimirPlazas()
    {
        echo "Nº plazas: ".$this->getPlazas();
    }
   
}
