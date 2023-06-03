<?php
namespace Controllers;
use Model\Admin;
use MVC\Router;

class LoginController{
    public static function login(Router $router){
        $errores = [];

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $auth = new Admin($_POST);
            $errores = $auth->validar();

            if(empty($errores)){
                //Comprobar que exista el usuario
                $resultado = $auth->comprobarUsuario();
                if(!$resultado){
                    $errores = Admin::getErrores();
                }else{
                    //Comprobar que el password del usuario sea correcto
                    $autenticado = $auth->comprobarPassWord($resultado);
                    if($autenticado){
                        $auth->autenticar();
                    }else{
                        $errores = Admin::getErrores();
                    }
                }
            }
        }

        $router->render("auth/login",[
            "errores" => $errores
        ]);
    }

    public static function logout(){
        session_start();
        $_SESSION = [];
        header("Location: /");
    }
}
