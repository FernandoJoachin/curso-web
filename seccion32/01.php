<?php 
declare(strict_types = 1);
include "includes/header.php";

class Producto{
    /*Forma antigua de hacerlo */
    // public $nombre;
    // public $precio;
    // public $disponible;

    // public function __construct(String $nombre,int $precio, bool $disponible){
    //     $this->nombre = $nombre;
    //     $this->precio = $precio;
    //     $this->disponible = $disponible;
    // }
    
    /*Forma actual de hacerlo */
    public function __construct(public String $nombre, public int $precio, public bool $disponible){
    }

    public function mostrarProducto(){
        echo "El producto es: " . $this->nombre . " y su precio es de: " . $this->precio;
    }
}

/* Crear un objeto sin constructor*/
// $producto2 = new Producto();
// $producto2->nombre = "Laptop";
// $producto2->precio = 300;
// $producto2->disponible = false;

$producto1 = new Producto("Tablet", 200, true);
$producto1->mostrarProducto();

echo "<pre>";
var_dump($producto1);
echo "</pre>";
include "includes/footer.php";