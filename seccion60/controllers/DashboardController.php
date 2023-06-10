<?php
namespace Controllers;

use Model\Proyecto;
use MVC\Router;

class DashboardController{
    public static function index(Router $router){
        session_start();
        isAuth();
        $router->render("dashboard/index",[
            "titulo" => "Proyectos"
        ]);
    }

    public static function crearProyecto(Router $router){
        session_start();
        isAuth();
        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $proyecto = new Proyecto($_POST);
            $alertas = $proyecto->validarProyecto();
            if(empty($alertas)){
                //Generar URL única
                $proyecto->url = md5(uniqid());

                //Almacenar el propietario del proyecto
                $proyecto->usuario_id = $_SESSION["id"];

                //Guardar proyecto
                $proyecto->guardar();

                header("Location: /proyecto?id=" . $proyecto->url);
            }
        }

        $router->render("dashboard/crear-proyecto",[
            "titulo" => "Crear proyecto",
            "alertas" => $alertas
        ]);
    }

    public static function perfil(Router $router){
        session_start();
        isAuth();
        $router->render("dashboard/perfil",[
            "titulo" => "Perfil"
        ]);
    }
}