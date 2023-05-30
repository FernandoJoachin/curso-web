<?php
namespace Controllers;

use MVC\Router;

class LoginController{
    public static function login(Router $router){
        $router->render("/auth/login");
    }

    public static function logout(){
        echo "En logout";
    }

    public static function recuperarPassword(){
        echo "En recuperar";
    }

    public static function olvidarPassword(){
        echo "En olvidar";
    }

    public static function crearCuenta(){
        echo "En crear cuenta";
    }
}