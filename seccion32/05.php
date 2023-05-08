<?php 
declare(strict_types = 1);
include "includes/header.php";

/*Clases abstractas*/
abstract class Transporte{
    public function __construct(protected int $ruedas, protected int $capacidad){

    }

    public function getInfo() : string{
        return "El transporte tiene " . $this->ruedas . " ruedas y una capacidad de " . $this->capacidad . " personas ";
    }

    public function getRuedas() : int{
        return $this->ruedas;
    }
}

class Barco extends Transporte{
    public function __construct(protected int $capacidad){

    }

    public function getInfo() : string{
        return "El transporte anda por el agua y tiene una capacidad de " . $this->capacidad . " personas ";
    }
}

class Bicicleta extends Transporte{
    public function getInfo() : string{
        return "El transporte tiene " . $this->ruedas . " ruedas y una capacidad de " . $this->capacidad . " personas. Este transporte no gasta gasolina";
    }
}
class Automovil extends Transporte{
    public function __construct(protected int $ruedas, protected int $capacidad, protected string $transmision){
        
    }

    public function getTransmision() : string{
        return $this->transmision;
    }
}

$barco = new Barco(10);
echo "<br>";
echo $barco->getInfo();
echo "</br>";

echo "<hr>";

$bicicleta = new Bicicleta(2, 1);
echo "<br>";
echo $bicicleta->getInfo();
echo "</br>";
echo "<br>";
echo $bicicleta->getRuedas();
echo "</br>";

echo "<hr>";

$auto = new Automovil(4, 4, "Manual");
echo "<br>";
echo $auto->getInfo();
echo "</br>";
echo "<br>";
echo $auto->getTransmision();
echo "</br>";
include "includes/footer.php";