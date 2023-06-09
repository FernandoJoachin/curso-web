<?php
namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{
    public static function login(Router $router){
        if($_SERVER["REQUEST_METHOD"] === "POST"){}

        $router->render("auth/login",[
            "titulo" => "Iniciar Sesión"
        ]);
    }

    public static function logout(){
        echo "logout";
      
    }

    public static function crear(Router $router){
        $usuario = new Usuario();
        $alertas = [];
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();
            if(empty($alertas)){
                $existeUsuario = $usuario->where("email", $usuario->email);
                if($existeUsuario){
                    Usuario::setAlerta("error","El usuario ya esta registrado");
                    $alertas = Usuario::getAlertas();
                }else{
                    //Hashear Password
                    $usuario->hashearPassword();
                    //Eliminar repetirPassword
                    unset($usuario->repetirPassword);
                    //Crear token
                    $usuario->crearToken();

                    //Crear usuario
                    $resultado = $usuario->guardar();
                    //Enviar email de confirmacion
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    if($resultado){
                        header("Location: /mensaje");
                    }
                }
            }
        }

        $router->render("auth/crear",[
            "titulo" => "Crea tu cuenta en UpTask",
            "usuario" => $usuario,
            "alertas" => $alertas
        ]);
    }

    public static function olvidarPassword(Router $router){
        
        if($_SERVER["REQUEST_METHOD"] === "POST"){}

        $router->render("auth/olvidar",[
            "titulo" => "Olvide mi password"
        ]);
    }

    public static function reestablecerPassword(Router $router){
        if($_SERVER["REQUEST_METHOD"] === "POST"){}

        $router->render("auth/reestablecer",[
            "titulo" => "Reestablecer password"
        ]);
    }

    public static function mensaje(Router $router){
        $router->render("auth/mensaje",[
            "titulo" => "Cuenta creada exitosamente"
        ]);
    }

    public static function confirmar(Router $router){
        $alertas = [];
        $token = s($_GET["token"]);
        if(!$token){
            header("Location: /");
        }
        $usuario = Usuario::where("token", $token);
        if(empty($usuario)){
            //El token no es válido
            Usuario::setAlerta("error", "Token no válido");
        }else{
            //Confirmar cuenta
            $usuario->confirmado = 1;
            $usuario->token = null;
            unset($usuario->repetirPassword);

            $usuario->guardar();
            Usuario::setAlerta("exito", "Cuenta comprobada correctamente");
        }

        $alertas = Usuario::getAlertas();
        $router->render("auth/confirmar",[
            "titulo" => "Confirmar tu cuenta UpTask",
            "alertas" => $alertas
        ]);
    }
}