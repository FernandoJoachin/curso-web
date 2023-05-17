<?php
namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController{
    public static function crear(Router $router){
        $vendedor = new Vendedor();
        $errores = Vendedor::getErrores();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            //Crear una nueva instancia de vendedor
            $vendedor = new Vendedor($_POST["vendedor"]);
            $errores = $vendedor->validar();
            if(empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render("vendedores/crear", [
            "vendedor" => $vendedor,
            "errores" => $errores
        ]);
    }

    public static function actualizar(){
        echo "Actualizar vendedor";
    }

    public static function eliminar(){
        echo "Eliminar vendedor";
    }
}