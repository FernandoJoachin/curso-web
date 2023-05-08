<?php 
declare(strict_types = 1);
include "includes/header.php";

/*Métodos Estaticos */
class Producto{
    public $img;
    public static $imgPlaceholder = "Imagen.jpg";

    public function __construct(protected String $nombre, protected int $precio, protected bool $disponible, String $img){
        if($img) {
            self::$imgPlaceholder = $img;
        }
    }

    public static function obtenerImgProducto(){
        return self::$imgPlaceholder;
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
}

$producto1 = new Producto("Tablet", 200, true, "");
echo "<br>";
echo $producto1->obtenerImgProducto();
echo "</br>";

echo "<pre>";
var_dump($producto1);
echo "</pre>";

$producto2 = new Producto("Laptop", 300, false, "MacOS.jpg");
echo "<br>";
echo $producto2->obtenerImgProducto();
echo "</br>";

echo "<pre>";
var_dump($producto2);
echo "</pre>";
include "includes/footer.php";