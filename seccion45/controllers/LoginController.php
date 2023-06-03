<?php
namespace Controllers;

use Model\Usuario;
use MVC\Router;
use Classes\Email;

class LoginController{
    public static function login(Router $router){
        $alertas = [];
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();
            if(empty($alertas)){
                $usuario = Usuario::where("email",$auth->email);
                if($usuario){
                    if($usuario->comprobarPassword_Y_Verificado($auth->password)){
                        $_SESSION["id"] = $usuario->id;
                        $_SESSION["nombre"] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION["email"] = $usuario->email;
                        $_SESSION["login"] = true;
                        
                        if($usuario->admin === "1"){
                            $_SESSION["admin"] = $usuario->admin ?? null;
                            header("Location: /admin");
                        }else{
                            header("Location: /cita");
                        }
                    }
                    
                }else{
                    Usuario::setAlerta("error","Usuario no encontrado");
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render("/auth/login",[
            "alertas" => $alertas
        ]);
    }

    public static function logout(){
        echo "En logout";

    }

    public static function reestablecerPassword(Router $router){
        $alertas = [];
        $bandera = false; //No muestra el formulario si el token es incorrecto
        $token = s($_GET["token"]); //Obtenes el token de la url
        $usuario = Usuario::where("token",$token); //Buscamos si existe el token en la DB

        if(empty($usuario)){
            Usuario::setAlerta("error", "Token no valido");
            $bandera = true;
        }

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();

            if(empty($alertas)){
                $usuario->password = $password->password;
                $usuario->hashearPassword();
                $usuario->token = null;
                $resultado = $usuario->guardar();
                if($resultado){
                    header("Location: /");
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render("/auth/reestablecer-password",[
            "alertas" => $alertas,
            "bandera" => $bandera
        ]);
    }

    public static function olvidarPassword(Router $router){
        $alertas = [];
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();
            if(empty($alertas)){
                $usuario = Usuario::where("email",$auth->email);
                if($usuario && $usuario->confirmado === "1"){
                    //Crea un nuevo token
                    $usuario->crearToken();
                    $usuario->guardar();

                    $email = new Email($usuario->email,$usuario->nombre,$usuario->token);
                    $email->enviarInstrucciones();

                    Usuario::setAlerta("exito","Revisa tu enail");
                }else{
                    Usuario::setAlerta("error","El usuario no existe o no esta confirmado");
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render("auth/olvidar-password",[
            "alertas" => $alertas
        ]);
    }

    public static function crearCuenta(Router $router){
        $usuario = new Usuario($_POST);
        $alertas = [];
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();
            if(empty($alertas)){
                //Revisar si el usuario no existe
                $resultado = $usuario->comprobarExisteUsuario();
                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                }else{
                    $usuario->hashearPassword();
                    $usuario->crearToken();
                    $email = new Email($usuario->email,$usuario->nombre,$usuario->token);
                    $email->enviarEmailConfirmacion();
                    //Crear el usuario
                    $resultado = $usuario->guardar();
                    if($resultado){
                        header("Location: /mensaje");
                    }
                }
            }
            
        }
        $router->render("auth/crear-cuenta",[
            "usuario" => $usuario,
            "alertas" => $alertas
        ]);
    }

    public static function mensaje(Router $router){
        $router->render("auth/mensaje");
    }

    public static function confirmarCuenta(Router $router){
        $alertas = [];
        $token = s($_GET["token"]); //Obtenes el token de la url
        $usuario = Usuario::where("token",$token); //Buscamos si existe el token en la DB

        if(empty($usuario)){
            Usuario::setAlerta("error", "Token no valido");
        }else{
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta("exito","Cuenta comprobada correctamente");
        }

        $alertas = Usuario::getAlertas();
        $router->render("auth/confirmar-cuenta",[
            "alertas" => $alertas
        ]);
    }
}