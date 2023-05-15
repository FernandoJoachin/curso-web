<?php
namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController{
    public static function index(Router $router){
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        //Muestra mensaje condicional
        $resultado = $_GET["resultado"] ?? null;
        $router->render("propiedades/admin", [
            "propiedades" => $propiedades,
            "resultado" => $resultado,
            "vendedores" => $vendedores
        ]);
    }

    public static function crear(Router $router){
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
    
            //Crea una nueva instancia
            $propiedad = new  Propiedad($_POST["propiedad"]);
    
            /*Subida de archvios */
            //Generar un nombre único
            $nombreImg = md5(uniqid(rand(), true)) . ".jpg";
    
            //Realiza un resize a la imagen con Intervention - Código sacado de Intervention
            if($_FILES["propiedad"]["tmp_name"]["img"]){
                $img = Image::make($_FILES["propiedad"]["tmp_name"]["img"])->fit(800, 600);
                $propiedad->setImagen($nombreImg);
            }
    
            //Validar
            $errores = $propiedad->validar();
    
            //Insertar en la base de datos
            if(empty($errores)){
                //Crear carpeta
                $carpetaImg = "../../imagenes/";
                if(!is_dir(CARPETA_IMG)){
                    mkdir(CARPETA_IMG);
                }
                //Guardar imagen en el servidor
                $img->save(CARPETA_IMG . $nombreImg);
    
                //Guardar en la DB
                $propiedad->guardar();
            }
        }

        $router->render("propiedades/crear", [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
            "errores" => $errores
        ]);
    }

    public static function actualizar( Router $router){
        //Validar la URL por un ID válido
        $id = validar_o_Redireccionar("/public/admin");

        //Consultar para obtener los propiedades
        $propiedad = Propiedad::find($id);
        
        //Consultar para obtener los vendedores
        $vendedores = Vendedor::all();

        //Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        if($_SERVER["REQUEST_METHOD"] === "POST"){    
            $args = $_POST["propiedad"];
            $propiedad->sincronizar($args);
    
            /*Subida de archvios */
            //Generar un nombre único
            $nombreImg = md5(uniqid(rand(), true)) . ".jpg";
    
            //Realiza un resize a la imagen con Intervention - Código sacado de Intervention
            if($_FILES["propiedad"]["tmp_name"]["img"]){
                $img = Image::make($_FILES["propiedad"]["tmp_name"]["img"])->fit(800, 600);
                $propiedad->setImagen($nombreImg);
            }
    
            $errores = $propiedad->validar();       
            //Actualizar en la base de datos
            if(empty($errores)){
                if($_FILES["propiedad"]["tmp_name"]["img"]){
                    $img->save(CARPETA_IMG . $nombreImg);
                }
                $propiedad->guardar();
            }
        }
        
        $router->render("propiedades/actualizar", [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
            "errores" => $errores
        ]);
    }

    public static function eliminar(Router $router){
        //Hacer DELETE
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if($id){
                $tipo = $_POST["tipo"];
                if(validarTipoContenido($tipo)){
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar($tipo);
                }
            }
        }
    }
}