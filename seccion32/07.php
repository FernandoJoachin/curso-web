<?php
declare(strict_types = 1);

include "includes/header.php";
/*Polimorfismo*/
interface TransporteInterfaz {
    public function getInfo() : string;
    public function getRuedas() : int;
}

class Transporte implements TransporteInterfaz{
    public function __construct(protected int $ruedas, protected int $capacidad){

    }

    public function getInfo() : string{
        return "El transporte tiene " . $this->ruedas . " ruedas y una capacidad de " . $this->capacidad . " personas ";
    }

    public function getRuedas() : int{
        return $this->ruedas;
    }

    public function setRuedas(int $ruedas) : void{
        $this->ruedas = $ruedas;
    }
}

class Avion extends Transporte implements TransporteInterfaz{
    public function __construct(protected int $ruedas, protected int $capacidad, protected int $turbinas){

    }

    public function getInfo() : string{
        return "El Avion tiene " . $this->ruedas . " ruedas, una capacidad de " . $this->capacidad . " personas, y tiene " . $this->turbinas . "turbinas";
    }

    public function getRuedas() : int{
        return $this->ruedas;
    }

    public function getTurbinas() : int{
        return $this->turbinas;
    }
}
echo "<pre>";
var_dump($transporteGenerico = new Transporte(2,4));
var_dump($avion = new Avion(0,50, 4));
echo $avion->getTurbinas();
echo "</pre>";

include 'includes/footer.php';