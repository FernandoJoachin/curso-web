<?php
namespace Controllers;

use Model\Proyecto;
use Model\Usuario;
use MVC\Router;

class DashboardController{
    public static function index(Router $router){
        session_start();
        isAuth();

        $id = $_SESSION["id"];
        $proyectos = Proyecto::belongsTo("usuario_id", $id);

        $router->render("dashboard/index",[
            "titulo" => "Proyectos",
            "proyectos" => $proyectos
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

    public static function proyecto(Router $router){
        session_start();
        isAuth();

        $token = $_GET["id"];
        if(!$token){
            header("Location: /dashboard");
        }

        $proyecto = Proyecto::where("url",$token);
        if($proyecto->usuario_id !== $_SESSION["id"]){
            header("Location: /dashboard");
        }

        $router->render("dashboard/proyecto",[
            "titulo" => $proyecto->proyecto
        ]);
    }

    public static function perfil(Router $router){
        session_start();
        isAuth();
        $alertas = [];
        $usuario = Usuario::find($_SESSION["id"]);
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarPerfil();
            if(empty($alertas)){
                $existeUsuario = Usuario::where("email",$usuario->email);
                if($existeUsuario && $existeUsuario->id !== $usuario->id){
                    Usuario::setAlerta("error", "Email no válido, ya existente");
                }else{
                    //Guardar el registro
                    $usuario->guardar();

                    Usuario::setAlerta("exito", "Los cambios se guardaron correctamente");

                    //Asignar el nombre nuevo a la sesion
                    $_SESSION["nombre"] = $usuario->nombre;
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render("dashboard/perfil",[
            "titulo" => "Perfil",
            "alertas" => $alertas,
            "usuario" => $usuario
        ]);
    }
}