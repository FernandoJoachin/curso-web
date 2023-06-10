<?php
namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{
    public static function login(Router $router){
        $alertas = [];
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();
            if(empty($alertas)){
                $usuario = Usuario::where("email", $auth->email);
                if($usuario){
                    if($usuario->confirmado){
                        if($usuario->comprobarPassword($auth->password)){
                            session_start();
                            $_SESSION["id"] = $usuario->id;
                            $_SESSION["nombre"] = $usuario->nombre;
                            $_SESSION["email"] = $usuario->email;
                            $_SESSION["login"] = true;

                            header("Location: /dashboard");
                        }
                    }else{
                        Usuario::setAlerta("error","Usuario no ha sido confirmado");
                    }
                }else{
                    Usuario::setAlerta("error","Usuario no existe");
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render("auth/login",[
            "titulo" => "Iniciar Sesión",
            "alertas" => $alertas
        ]);
    }

    public static function logout(){
        session_start();
        $_SESSION = [];
        header("Location: /");
      
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
        $alertas = [];
        
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

            if(empty($alertas)){
                //Busca al usuario a través del email proporcionado
                $usuario = Usuario::where("email", $usuario->email);

                if($usuario && $usuario->confirmado === "1"){
                    $usuario->crearToken();
                    unset($usuario->repetirPassword);
                    $usuario->guardar();

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    Usuario::setAlerta("exito", "Hemos enviado las instrucciones a tu email");
                }else{
                    Usuario::setAlerta("error", "El usuario no existe o no esta confirmado");
                }

            }
        }

        $alertas = Usuario::getAlertas();
        $router->render("auth/olvidar",[
            "titulo" => "Olvide mi password",
            "alertas" => $alertas
        ]);
    }

    public static function reestablecerPassword(Router $router){
        $alertas = []; 
        $mostrar = true;
        $token = s($_GET["token"]);
        if(!$token){
            header("Location: /");
        }

        $usuario = Usuario::where("token", $token);
        if(empty($usuario)){
            //El token no es válido
            Usuario::setAlerta("error", "Token no válido");
            $mostrar = false;
        }

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarPassword();
            if(empty($alertas)){
                //Hashear Password
                $usuario->hashearPassword();
                //Eliminar repetirPassword
                unset($usuario->repetirPassword);
                //Eliminar el token
                $usuario->token = null;

                $resultado = $usuario->guardar();
                if($resultado){
                    header("Location: /");
                }

            }
        }

        $alertas = Usuario::getAlertas();
        $router->render("auth/reestablecer",[
            "titulo" => "Reestablecer password",
            "alertas" => $alertas,
            "mostrar" => $mostrar
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