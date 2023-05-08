<?php 
declare(strict_types = 1);
include "includes/header.php";

/*Encapsulacion */
class Producto{
    //public - Se puede acceder y modificar en cualquier lugar (clase y objeto)
    //private - Solo miembros de la misma clase pueden acceder a el
    //protected - Se puede acceder / modificar unicamente en la clase

    public function __construct(protected String $nombre, protected int $precio, protected bool $disponible){
    }

    public function mostrarProducto() : void{
        echo "El producto es: " . $this->nombre . " y su precio es de: " . $this->precio;
    }

    public function getNombre() : string{
        return $this->nombre;
    }

    public function setNombre(string $nombre){
        $this->nombre = $nombre;
    }

    public function getPrecio() : int{
        return $this->precio;
    }

    public function setPrecio(int $precio){
        $this->precio = $precio;
    }

    public function getDisponible() : bool{
        return $this->disponible;
    }

    public function setDisponible(bool $disponible){
        $this->disponible = $disponible;
    }
}

$producto1 = new Producto("Tablet", 200, true);
$producto1->mostrarProducto();
echo "<br>";
echo $producto1->getNombre();
echo "</br>";
echo "<br>";
echo $producto1->getPrecio();
echo "</br>";
$producto1->setNombre("Nuevo nombre");
$producto1->setPrecio(1000);

echo "<pre>";
var_dump($producto1);
echo "</pre>";
include "includes/footer.php";