<?php

namespace Controllers;

use Model\Ponente;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class PonentesController{
    public static function index(Router $router){
        session_start();
        esAdmin();
        $ponentes = Ponente::all();
        $router->render("admin/ponentes/index",[
            "titulo" => "Ponentes / Conferencias",
            "ponentes" => $ponentes
        ]);
    }

    public static function crear(Router $router){
        session_start();
        esAdmin();

        $alertas = [];
        $ponente = new Ponente();
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            //Leer imagen
            if(!empty($_FILES["imagen"]["tmp_name"])){
                $carpeta_imagenes = "../public/img/speakers";
                //Crea la carpeta si no existe
                if(!is_dir($carpeta_imagenes)){
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES["imagen"]["tmp_name"])->fit(800,800)->encode("png",80);
                $imagen_webp = Image::make($_FILES["imagen"]["tmp_name"])->fit(800,800)->encode("webp",80);
                $nombre_imagen = md5(uniqid(rand(),true));
                $_POST["imagen"] = $nombre_imagen;
            }

            $_POST["redes"] = json_encode($_POST["redes"], JSON_UNESCAPED_SLASHES);
            $ponente->sincronizar($_POST);
            $alertas = $ponente->validar();
            if(empty($alertas)){
                //Guardar imagen
                $imagen_png->save($carpeta_imagenes . "/" . $nombre_imagen . ".png");
                $imagen_webp->save($carpeta_imagenes . "/" . $nombre_imagen . ".webp");

                //Guardar en la BD
                $resultado = $ponente->guardar();
                if($resultado){
                    header("Location: /admin/ponentes");
                }
            }
        }
        $router->render("admin/ponentes/crear",[
            "titulo" => "Registrar Ponente",
            "alertas" => $alertas, 
            "ponente" => $ponente,
            "redes" => json_decode($ponente->redes)
        ]);
    }

    public static function editar(Router $router){
        session_start();
        esAdmin();

        $alertas = [];
        //Validar ID
        $id = $_GET["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if(!$id){
            header("Location: /admin/ponentes");
        }

        $ponente = Ponente::find($id);
        if(!$ponente){
            header("Location: /admin/ponentes");
        }

        $ponente->imagen_actual = $ponente->imagen;

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            if(!empty($_FILES["imagen"]["tmp_name"])){
                $carpeta_imagenes = "../public/img/speakers";
                //Crea la carpeta si no existe
                if(!is_dir($carpeta_imagenes)){
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $imagen_png = Image::make($_FILES["imagen"]["tmp_name"])->fit(800,800)->encode("png",80);
                $imagen_webp = Image::make($_FILES["imagen"]["tmp_name"])->fit(800,800)->encode("webp",80);
                $nombre_imagen = md5(uniqid(rand(),true));
                $_POST["imagen"] = $nombre_imagen;
            }else{
                $_POST["imagen"] = $ponente->imagen_actual;
            }

            $_POST["redes"] = json_encode($_POST["redes"], JSON_UNESCAPED_SLASHES);
            $ponente->sincronizar($_POST);
            $alertas = $ponente->validar();
            if(empty($alertas)){
                if(isset($nombre_imagen)){
                    unlink($carpeta_imagenes . "/" . $ponente->imagen_actual . ".png");
                    unlink($carpeta_imagenes . "/" . $ponente->imagen_actual . ".webp");
                    //Guardar imagen
                    $imagen_png->save($carpeta_imagenes . "/" . $nombre_imagen . ".png");
                    $imagen_webp->save($carpeta_imagenes . "/" . $nombre_imagen . ".webp");
                }

                //Guardar en la BD
                $resultado = $ponente->guardar();
                if($resultado){
                    header("Location: /admin/ponentes");
                }
            }
        }

        $router->render("admin/ponentes/editar",[
            "titulo" => "Actualizar Ponente",
            "alertas" => $alertas, 
            "ponente" => $ponente,
            "redes" => json_decode($ponente->redes)
        ]);
    }

    public static function eliminar(){
        session_start();
        esAdmin();
        if($_SERVER["REQUEST_METHOD"] === "POST") {

            $id = $_POST["id"];
            $ponente = Ponente::find($id);
            if(!isset($ponente)){
                header("Location: /admin/ponentes");
            }

            $carpeta_imagenes = "../public/img/speakers";
            //Crea la carpeta si no existe
            if(!is_dir($carpeta_imagenes)){
                mkdir($carpeta_imagenes, 0755, true);
            }
            unlink($carpeta_imagenes . "/" . $ponente->imagen . ".png");
            unlink($carpeta_imagenes . "/" . $ponente->imagen . ".webp");

            $resultado = $ponente->eliminar();
            if($resultado){
                header("Location: /admin/ponentes");
            }
        }
    }
}