<?php
namespace Controllers;

use Model\Usuario;
use MVC\Router;

class LoginController{
    public static function login(Router $router){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            echo "POST";
        }
        $router->render("/auth/login");
    }

    public static function logout(){
        echo "En logout";
    }

    public static function recuperarPassword(){
        echo "En recuperar";
    }

    public static function olvidarPassword(Router $router){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            echo "POST";
        }
        $router->render("auth/olvidar-password");
    }

    public static function crearCuenta(Router $router){
        $usuario = new Usuario($_POST);
        $alertas = [];
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();
            if(empty($alertas)){
               $resultado = $usuario->comprobarExisteUsuario();
               if($resultado->num_rows){
                $alertas = Usuario::getAlertas();
            }
            }
        }
        $router->render("auth/crear-cuenta",[
            "usuario" => $usuario,
            "alertas" => $alertas
        ]);
    }
}