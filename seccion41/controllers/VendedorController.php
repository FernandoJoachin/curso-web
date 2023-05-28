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

    public static function actualizar(Router $router){
        //Validar la URL por un ID válido
        $id = validar_o_Redireccionar("/public/admin");

        //Consultar para obtener los vendedores
        $vendedor = Vendedor::find($id);

        //Arreglo con mensajes de errores
        $errores = Vendedor::getErrores();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            //Asignar los valores
            $args = $_POST["vendedor"];
            //Sincronizar el objeto con los cambios realizados
            $vendedor->sincronizar($args);
            //Validación
            $errores = $vendedor->validar();       
            //Actualizar en la base de datos
            if(empty($errores)){
                $vendedor->guardar();
            }
        }

        $router->render("vendedores/actualizar", [
            "vendedor" => $vendedor,
            "errores" => $errores
        ]);
    }

    public static function eliminar(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if($id){
                $tipo = $_POST["tipo"];
                if(validarTipoContenido($tipo)){
                    $propiedad = Vendedor::find($id);
                    $propiedad->eliminar($tipo);
                }
            }
        }
    }
}